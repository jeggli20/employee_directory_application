# Employee Directory Application Template

## What is it?

This is a PHP and SQL driven Employee Directory Application Template.

## Why use it?

This application template can help you get a head start on an employee directory application for your company. This PHP and SQL driven application makes finding employee information (such as contact information) easy to find and well organized. Included in this is a login interface for employees to keep their information safe from those outside the company. Authorization to CRUD features to the database are only given to specified employee positions to maintain least privileges.

## Getting started

### Database

1. Create an SQL driven database
2. Import the SQL file to your database (The .sql file is written in MySQL, make adjustments where necessary)
3. Create a db_credentials.php file with the following defined variables in the 'private' folder:
   - DB_HOST
   - DB_USER
   - DB_PASS
   - DB_NAME
4. If you plan to use employee images, you may add that column to the employees table as necessary

### Styling

Make sure to update the color scheme to fit your company. Each stylesheet has color variables that you can change according to your needs.

### Images

- Add logo image in the root of the images folder
- Name employee photos as such [first_name].ext
- Name employee thumbnails as such thumb\_[first_name].ext
- Add employee images in the images/employees folder
- Add employee thumbnails in the images/employees/thumb folder
- Adjust links as necessary
