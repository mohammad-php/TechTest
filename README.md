# TechTest Laravel Application

## Overview
This project is a Laravel application designed to demonstrate various technical aspects, including RESTful API creation, frontend integration with Vue.js, AWS services utilization, and algorithm implementation. It covers backend and frontend development, AWS integration, and PL/SQL procedures.

## Prerequisites

1. **PHP & Laravel**:
    - PHP version: 8.2
    - Laravel version: 11.x

2. **Database**:
    - MySQL (RDS on AWS)

3. **Frontend**:
    - Vue.js (Latest Version)
    - Node.js & npm

4. **Server**:
    - AWS EC2 Instance with Ubuntu
    - Nginx

5. **AWS Services**:
    - S3 for image storage
    - Lambda for serverless functions
    - IAM roles and permissions

6. **Other Tools**:
    - Composer
    - scribe
    - PHPUnit
    - Git
    - Supervisor for queue worker management

## Installation & Setup

### 1. Clone the Repository
```bash
git clone git@github.com:mohammad-php/TechTest.git
cd TechTest
git checkout develop
```

### 2. Install Dependencies
```bash
composer install
npm install
npm run build
```

### 3. Environment Configuration
#### Database Configuration:
- DB_CONNECTION=mysql
- DB_HOST=<rds-endpoint>
- DB_PORT=3306
- DB_DATABASE=<database-name>
- DB_USERNAME=<username>
- DB_PASSWORD=<password>

#### AWS S3 Configuration:
- AWS_ACCESS_KEY_ID=<your-access-key-id>
- AWS_SECRET_ACCESS_KEY=<your-secret-access-key>
- AWS_DEFAULT_REGION=<your-region>
- AWS_BUCKET=<your-s3-bucket-name>


### 4. Set Up Nginx
```nginx
server {
    listen 80;
    server_name ec2-<your-public-ip>.compute.amazonaws.com;
    root /var/www/html/TechTest/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```
- Reload Nginx: sudo systemctl reload nginx

### 5. Set Up Supervisor for Queue Workers
```supervisor
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/html/TechTest/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=ubuntu
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/html/TechTest/worker.log
```
#### Start Supervisor: 
- sudo supervisorctl reread
- sudo supervisorctl update
- sudo supervisorctl start laravel-worker:*




### 6. Database Migration & Seeding
- php artisan migrate --force --seed

### 7. AWS Lambda Setup
````lambda
- Create Lambda Function:
Name: NotifyOnArticleCreation
Runtime: Node.js 20.x
Handler: index.handler

- IAM Role Configuration:
Ensure the Lambda function has permissions to execute necessary AWS services.


````


### 8. PL/SQL Stored Procedure
- Execute the following in MySQL Workbench:
````sql
DELIMITER $$

CREATE PROCEDURE GetArticleById(
    IN p_id INT,
    OUT p_title VARCHAR(255),
    OUT p_content TEXT,
    OUT p_created_at DATETIME
)
BEGIN
    SELECT title, content, created_at
    INTO p_title, p_content, p_created_at
    FROM articles
    WHERE id = p_id;

    IF p_title IS NULL THEN
        SET p_title = 'No Title';
        SET p_content = 'No Content';
        SET p_created_at = NOW();
    END IF;
END$$

DELIMITER ;

CALL GetArticleById(1, @title, @content, @created_at);
SELECT @title, @content, @created_at;

````

### 9. Generate Scribe API Documentation
```bash
php artisan scribe:generate
```

### 10. Run PHPUnit Tests
```bash
php artisan test
```

### 11. Browse API Documentation
```api
Visit http://ec2-13-60-58-112.eu-north-1.compute.amazonaws.com/docs
```

### 12. Browse Web Pages
##### Visit: 
- Articles Web Page: http://ec2-13-60-58-112.eu-north-1.compute.amazonaws.com/articles
- fibonacci: http://ec2-13-60-58-112.eu-north-1.compute.amazonaws.com/fibonacci/basic-recursive/3
- http://ec2-13-60-58-112.eu-north-1.compute.amazonaws.com/fibonacci/optimized-memoization/33
