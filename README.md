Student Certificate Management System
Project Overview
The Student Certificate Management System is a PHP and MySQL-based
application for students to submit details of their academic and
extracurricular achievements. The studentadd.php page displays the
student's existing profile information and provides forms for submitting
achievement details.
Features
- Displays the student's name, roll number, year, counsellor, and
  class incharge.
- Displays the existing profile photo stored in the
  studentdetails.pic database field.
- Provides submission categories for Workshop, Internship, Project,
  Certificates, Extra-Circular, and Co-circular achievements.
- Displays the relevant form when a category is selected.
- Supports file attachments for forms that request uploads.
- Uses the logged-in student's session to retrieve their details. etc...
Technologies Used
- PHP
- MySQL
- HTML, CSS, and JavaScript
- XAMPP (Apache and MySQL)
Requirements
- XAMPP or another PHP/MySQL server
- A web browser
- Project database configured in db_conn.php
Installation and Setup
1. Install XAMPP and start Apache and MySQL.
2. Copy the project folder into the XAMPP htdocs directory. Example:
   C:\xampp\htdocs\cms\.
3. Open phpMyAdmin at http://localhost/phpmyadmin/.
4. Import the project's database SQL file, if available.
5. Configure db_conn.php with the correct database host, name,
   username, and password.
6. Confirm that the studentdetails table contains student records and
   the pic column.
7. Keep profile images in the project's images folder or its
   subfolders.
8. Open the application at http://localhost/cms/.
How to Submit an Achievement
1. Log in using a student account.
2. Open http://localhost/cms/studentadd.php.
3. Select an achievement category.
4. Fill in the displayed form.
5. Attach a file if the selected form requests one.
6. Click Submit.
Important Files
  File                                Purpose
  studentadd.php                    Displays student details and
achievement submission forms.

  studentdat.php                    Student dashboard; contains
profile-photo display logic used as
a reference.

  db_conn.php                       Connects the application to the
MySQL database.

  sworkshop.php                     Handles workshop submissions.

  sinternship.php                   Handles internship submissions.

  sproject.php                      Handles project submissions.

  scourse.php                       Handles certificate/course
submissions.

  sextracircular.php                Handles extra-circular submissions.

  scocircular.php                   Handles co-circular submissions.
logout.php                        Logs the student out.
Profile Photo
The profile photo is read from the existing studentdetails.pic field.
The page checks the stored path and common locations under the images
directory. If the image cannot be found, a default user icon is shown.
This page does not include a profile-photo upload or change option.
Notes
- The form action filenames and input field names must match the
  corresponding submission-handler PHP files.
- Keep the database connection, image folders, and submission-handler
  files correctly configured.
- Update this README if your actual project uses different filenames,
  folders, or database settings.
