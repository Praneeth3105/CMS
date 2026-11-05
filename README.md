Certificate Management System (CMS)
A web-based Certificate Management System developed using PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap. The application provides a centralized platform for students, faculty members, and administrators to maintain, review, and manage academic and professional records.
Overview
The Certificate Management System helps organize student and faculty information and maintain records of certificates, achievements, publications, workshops, projects, internships, and other academic activities. Role-based login pages provide separate entry points for students, faculty members, and administrators.
User Roles
Student
- Log in to access the student dashboard.
- View and maintain academic details.
- Manage records such as workshops, internships, projects, courses, and extracurricular activities.
- View personal profile information and related records.
Faculty
- Log in to access faculty features.
- Add and update professional and academic information.
- Maintain achievements, certificates, conference participation, publications, patents, books, consultancy work, funded projects, workshops, FDPs, NPTEL courses, Ph.D. details, and professional memberships.
- Review and manage relevant student records, subject to assigned access.
Administrator
- Access the administration dashboard.
- View student and faculty information.
- Manage user records and oversee system information.
- Access summary information and reporting features.
Key Features
- Separate login interfaces for Students, Faculty, and Admin.
- Student and faculty profile management.
- Academic and professional record management.
- Certificate and achievement tracking.
- Support for workshops, internships, projects, courses, and extracurricular activities.
- Faculty publications, patents, books, conferences, FDPs, consultancy, and research-related records.
- Search, edit, and update functions for supported records.
- CSV-based data export and upload utilities in supported modules.
- Dashboard summaries and graphical reports.
- Profile image and document handling.
- Password update and account-related features.
Technology Stack
Layer	Technology
Frontend	HTML5, CSS3, JavaScript
UI Framework	Bootstrap 5
Backend	PHP
Database	MySQL
Database Connectivity	PHP MySQLi
JavaScript Libraries	jQuery
Icons and Fonts	Font Awesome, Google Fonts, Material Icons
Local Development Server	XAMPP / WAMP / LAMP


Project Structure
cms-main/
├── index.php                 # Main page with role-based login links
├── login1.php                # Student login
├── login2.php                # Faculty login
├── login3.php                # Admin login
├── admin.php                 # Admin dashboard
├── studentdat.php            # Student dashboard / data page
├── facultydat.php            # Faculty dashboard / data page
├── db_conn.php               # MySQL database connection
├── faculty*.php              # Faculty-related modules
├── student*.php              # Student-related modules
├── add_*.php                 # Add academic/professional records
├── e*.php                    # Edit/update record modules
├── csv*.php                  # CSV import/export utilities
├── graph*.php                # Reporting and graph pages
├── images/                   # Images and project assets
├── file/                     # Uploaded document files
├── uploads/                  # Uploaded files
└── README.md
The structure above highlights the main groups of files; the repository contains additional PHP pages for individual modules.
Requirements
Install the following before running the project:
- PHP 7.4 or later (PHP 8.x is recommended; verify compatibility with your local environment).
- MySQL 5.7+ or a compatible MariaDB version.
- Apache web server.
- XAMPP, WAMP, or a similar PHP/MySQL environment.
- A modern web browser.
Installation and Setup
1. Clone the repository
git clone <YOUR_REPOSITORY_URL>
2. Move the project into the web server directory
For XAMPP, copy the project folder into:
C:\xampp\htdocs\cms-main
3. Create the database
1. Start Apache and MySQL from the XAMPP Control Panel.
2. Open phpMyAdmin at http://localhost/phpmyadmin.
3. Create a database named:
CREATE DATABASE cms;
4. Import the database schema and required tables into cms.
Database note: The uploaded project archive does not include a database .sql export. The application expects multiple tables, including studentdetails, faculty, login, academic, and tables for certificates, achievements, publications, workshops, projects, and other records. A matching database schema must be prepared or obtained from the project owner before the application can run correctly.

4. Configure the database connection
Open db_conn.php and update the connection values to match your local MySQL configuration:
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
For a production deployment, store database credentials outside the public repository and use environment-based configuration. Do not commit passwords or other secrets.
5. Run the application
Open the following URL in your browser:
http://localhost/cms-main/
Choose the appropriate login option for Student, Faculty, or Admin.
Security and Deployment Notes
- Do not upload real student identity documents, certificates, personal photographs, or other private records to a public GitHub repository.
- Do not commit database credentials, passwords, session secrets, or production configuration files.
- Use password hashing (password_hash() and password_verify()) rather than storing or comparing plain-text passwords.
- Use prepared statements for database queries to reduce SQL injection risks.
- Validate uploaded files, restrict file types and sizes, and store sensitive uploads outside the publicly accessible web directory where possible.
- Enable HTTPS and configure appropriate access controls before deploying the application publicly.
- Review authentication, authorization, and file-access rules before using the system with real student or faculty data.
Current Limitations
- A database export/schema is not included in the supplied project archive; the database must be configured separately.
- The project is a PHP/MySQL application and requires a PHP-compatible hosting environment. Static hosting such as GitHub Pages cannot execute its PHP backend.
- Some external frontend resources are loaded through CDNs and require an internet connection in the browser.
Contributing
Contributions and suggestions are welcome. To contribute:
1. Fork the repository.
2. Create a feature branch.
3. Make and test your changes locally.
4. Commit your changes with a descriptive message.
5. Open a pull request describing the update.
License
See the LICENSE file for the applicable license terms.
Certificate Management System — Centralizing academic and professional records in one place.
