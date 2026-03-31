#!/bin/sh
set -eu

PRIMARY_SQL="/seed/backup1.sql"
FALLBACK_SQL="/seed/config_sbit3g.sql"
SCHEMA_SQL="/tmp/hr_dept_schema.sql"

if [ ! -f "$PRIMARY_SQL" ]; then
  echo "Missing SQL dump: $PRIMARY_SQL"
  exit 1
fi

extract_create_block() {
  table_name="$1"
  source_file="$2"
  awk -v t="$table_name" '
    $0 ~ ("^CREATE TABLE `" t "`") { in_block=1 }
    in_block { print }
    in_block && /;$/ { exit }
  ' "$source_file"
}

# Order is dependency-aware for foreign keys:
# - employees before employee_details and employee_login
# - prlist before employee_payslip
# - supplier_list before po_list
TABLE_ORDER="
RFID_card
employees
prlist
supplier_list
attendance
backup_itemlist
customer
defect
defect_log
employee_details
employee_login
employee_payslip
employee_payslip_form
guest
holiday
hr_dept
hr_year
item_list
leave_p
manual_attendance
notifications
order_items
overTime
payment
payment_history
po_list
product
products
receipt
receipts
request
request_log
schedule
system_info
"

echo "Building schema-only bootstrap SQL (no INSERT rows)..."
{
  echo "SET FOREIGN_KEY_CHECKS=0;"

  for table_name in $TABLE_ORDER; do
    echo "DROP TABLE IF EXISTS \`$table_name\`;"
  done
  echo

  for table_name in $TABLE_ORDER; do
    create_block="$(extract_create_block "$table_name" "$PRIMARY_SQL" || true)"
    if [ -z "$create_block" ] && [ -f "$FALLBACK_SQL" ]; then
      create_block="$(extract_create_block "$table_name" "$FALLBACK_SQL" || true)"
    fi

    if [ -z "$create_block" ]; then
      echo "Missing CREATE TABLE definition for: $table_name" >&2
      exit 1
    fi

    printf "%s\n\n" "$create_block"
  done

  echo "SET FOREIGN_KEY_CHECKS=1;"
} > "$SCHEMA_SQL"

# Some dumps contain invalid/huge AUTO_INCREMENT values.
sed -i -E 's/AUTO_INCREMENT=[0-9]+/AUTO_INCREMENT=1/g' "$SCHEMA_SQL"

echo "Importing schema into ${MARIADB_DATABASE}..."
mysql -uroot -p"${MARIADB_ROOT_PASSWORD}" "${MARIADB_DATABASE}" < "$SCHEMA_SQL"
echo "Schema import finished."
