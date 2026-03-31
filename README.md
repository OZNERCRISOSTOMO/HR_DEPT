# HR_DEPT

## Overview
Legacy native PHP HR management system for 3G Clothing.  
Main flow is admin login -> dashboard -> employee/attendance/leave/payroll operations.

## Core Features
- Admin login and session-based access control
- Applicant hiring flow and employee onboarding
- Attendance tracking (manual/RFID flows in codebase)
- Leave filing and leave approval management
- Payroll periods and payslip generation workflow
- Holiday and HR yearly leave-balance management

## Table Schema (High-Level)
Core HR/auth tables:
- `employees`: employee master profile and status
- `employee_details`: HR metadata, role details, leave balances, rates
- `employee_login`: login credentials (`login_id`, hashed `login_password`, role)
- `RFID_card`: RFID mapping to employees

Time/leave tables:
- `attendance`: daily time-in/time-out and status
- `overTime`: overtime/undertime records
- `leave_p`: leave requests
- `holiday`: holiday calendar with pay multipliers
- `hr_year`: leave reset year marker

Payroll tables:
- `prlist`: payroll run periods/types
- `employee_payslip`: payslip files per payroll run
- `employee_payslip_form`: payslip form inputs per employee

Other legacy/operations tables in dump:
- `backup_itemlist`, `customer`, `defect`, `defect_log`, `guest`, `hr_dept`, `item_list`, `manual_attendance`, `notifications`, `order_items`, `payment`, `payment_history`, `po_list`, `product`, `products`, `receipt`, `receipts`, `request`, `request_log`, `schedule`, `supplier_list`, `system_info`

## Run Using Docker
Reference guide: [RUN_WITH_DOCKER.md](./RUN_WITH_DOCKER.md)

1. Start stack:
```bash
docker compose up -d --build
```
2. Open app:
- `http://localhost:8080/index.php`
3. Open phpMyAdmin:
- `http://localhost:8081`
- Server: `db`
- User: `root`
- Password: `root`

For detailed Docker steps and troubleshooting:
- Start/stop/reset: [RUN_WITH_DOCKER.md](./RUN_WITH_DOCKER.md)
- Insert admin/login seed data: [RUN_WITH_DOCKER.md#create-admin-login-phpmyadmin](./RUN_WITH_DOCKER.md#create-admin-login-phpmyadmin)

## Docker DB Bootstrap Behavior
- Schema is created automatically on first DB volume initialization.
- Source files used by init script:
  - `Functions/backup1.sql` (primary)
  - `config/sbit3g.sql` (fallback)
- Schema-only bootstrap: table structure is created, row inserts are not imported by default.

## Useful Commands
Stop services:
```bash
docker compose down
```

Reset DB volume and recreate schema:
```bash
docker compose down -v
docker compose up -d --build
```

Check DB init logs:
```bash
docker compose logs db --tail=300
```

Detailed Docker account/bootstrap notes are in [RUN_WITH_DOCKER.md](./RUN_WITH_DOCKER.md).
