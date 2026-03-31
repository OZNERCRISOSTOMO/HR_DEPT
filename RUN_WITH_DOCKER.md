# Run This Project With Docker

## What This Setup Does
- Runs PHP app on `http://localhost:8080`
- Runs MariaDB on an internal Docker network
- Runs phpMyAdmin on `http://localhost:8081`
- Creates DB schema (tables only) on first startup from:
  - `Functions/backup1.sql` (primary)
  - `config/sbit3g.sql` (fallback for missing table definitions)
- No row inserts are imported by default

## Start
```bash
docker compose up -d --build
```

## Stop
```bash
docker compose down
```

## Reinitialize DB (Fresh Import)
Use this only if want to wipe current container DB data and recreate schema:
```bash
docker compose down -v
docker compose up -d --build
```

## Open
- App: `http://localhost:8080/index.php`
- phpMyAdmin: `http://localhost:8081`
  - Server: `db`
  - Username: `root`
  - Password: `root`

## Create Admin Login (phpMyAdmin)
1. Generate a bcrypt hash from the running app container:
```bash
docker compose exec app php -r 'echo password_hash("YourStrongPass123!", PASSWORD_DEFAULT), PHP_EOL;'
```
2. Copy the output hash and run this SQL in phpMyAdmin (`u839345553_SBIT3G` database):
```sql
START TRANSACTION;

INSERT INTO employees
(first_name,last_name,email,gender,address,contact,schedule_id,status,date_resign)
VALUES
('Admin','Admin','admin@gmail.com','male','N/A','09170000000',1,'1','0000-00-00');

SET @emp_id = LAST_INSERT_ID();

INSERT INTO employee_details
(resume_name,resume_path,picture_path,sss,pagibig,philhealth,salary,rate_per_hour,overtime_hours,department,date_applied,date_hired,employee_id,position,department_position,employee_type,branch,num_hr,over_time,vacation_leave,sick_leave,maternity_leave,paternity_leave,health_insurance,christmas_bonus,food_allowance,transpo_allowance)
VALUES
('N/A','N/A.pdf','default.png','0','0','0',0.00,0,0,'human-resource',NOW(),NOW(),@emp_id,'admin','Admin Admin','regular','HQ',0,0,15,60,90,7,'0','0','0','0');

INSERT INTO employee_login
(login_id,login_password,employee_id,serial_id,position)
VALUES
('Admin','<PASTE_BCRYPT_HASH_HERE>',@emp_id,NULL,'admin');

-- Required by current login flow (admin must have attendance today)
INSERT INTO attendance
(Name,employee_id,`date`,time_in,status,time_out,num_hr,over_time,schedule_id)
VALUES
('Admin Admin',@emp_id,CURDATE(),CURTIME(),'ONTIME','00:00:00',0,0,1);

COMMIT;
```
3. Replace `<PASTE_BCRYPT_HASH_HERE>` with the hash from step 1.
4. Log in with:
   - Username: `Admin`
   - Password: `Password123`

## Important Notes
- PHP code has hardcoded DB host/user/password/database values.
- Compose is configured to match those old values:
  - host alias: `sql985.main-hosting.eu` -> Docker `db` service
  - database: `u839345553_SBIT3G`
  - username: `u839345553_sbit3g`
  - password: `sbit3gQCU`
- This avoids mass editing old PHP files just for local revival.

