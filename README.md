# ProyectoBD: Registration System

## Link
https://ada.uprrp.edu/~jose.plaud1/proyectoBD/client/index.php

## Overview

ProyectoBD is a web-based registration system designed to handle user registrations for various events. The system allows users to create accounts, log in, and register for events. Administrators can view, modify, and delete registrations. This README file provides an overview of the project's structure, handling functions, forms, and the overall workflow from the user's perspective.

## Project Structure

```
proyectoBD/
├── client/
│   ├── index.php
│   ├── login.php
│   ├── form.php
│   ├── table.php
│   ├── modify_appointment.php
│   ├── style.css
│   └── components/
│       ├── nav.php
│       
├── server/
│   ├── db_connect.php
│   ├── form_handler.php
│   ├── login_handler.php
│   ├── delete_handler.php
├── images/
│   └── logo.png
├── README.md
```

## Handling Functions

1. **db_connect.php**: Establishes a connection to the MySQL database.
2. **form_handler.php**: Handles form submissions for creating and updating user registrations.
3. **login_handler.php**: Handles user login by verifying email and phone number.
4. **delete_handler.php**: Handles the deletion of registrations.

## Forms

1. **login.php**: Contains the login form where users enter their email and phone number to access their registrations.
2. **form.php**: Contains the registration form for users to create or update their account and registration details.
3. **modify_appointment.php**: Displays a form to modify an existing registration.

## Workflow

### User Perspective

1. **Account Creation**:
   - The user navigates to `form.php` to create a new account.
   - The user fills in their first name, last name, email, phone number, number of adults, number of children, event name, and the day of the event.
   - Upon submission, `form_handler.php` processes the data. If the user ID is present, it updates the existing user and registration. Otherwise, it creates a new user and registration in the database.

2. **Login**:
   - The user navigates to `login.php` to log in.
   - The user enters their email and phone number.
   - Upon submission, `login_handler.php` verifies the credentials and redirects the user to `table.php`, displaying their registrations.

3. **Viewing Registrations**:
   - On `table.php`, the user can see a table of their registrations.
   - Each registration row is clickable and routes to `modify_appointment.php` with the corresponding registration ID.

4. **Modifying Registrations**:
   - The user can update their registration details and submit the form.
   - `form_handler.php` processes the updates.

5. **Deleting Registrations**:
   - The user can delete a registration by clicking the "Delete" button on `modify_appointment.php`.
   - The deletion is handled by `delete_handler.php`, which removes the registration from the database and redirects back to `table.php`.

## Handling Functions and Forms

- **form_handler.php**:
  - **Insert**: If a user ID is not provided, the script inserts a new user into the `Users` table and their registration into the `Registrations` table. It also checks if the event exists in the `Events` table and adds it if not.
  - **Update**: If a user ID is provided, the script updates the user's details and their registration information.

- **login_handler.php**:
  - Validates the user's email and phone number.
  - Fetches the user ID and registration details.
  - Redirects to `table.php` with the user ID.

- **delete_handler.php**:
  - Deletes the registration based on the registration ID.
  - Redirects to `table.php` with the user ID.

## Conclusion

ProyectoBD provides a streamlined registration system for managing event registrations. Users can create accounts, log in, view their registrations, modify them, and delete them as needed. The handling functions ensure data integrity and proper flow of information between the client and server.