# Book Shop
assignment 2 for eCommerce
This is a web application that allows users to browse a catalog of books, reserve titles, and manage their account. All of this while providing administrators with a complete dashboard for managing the system. The project includes **role‑based access control**, **Two‑Factor Authentication (2FA)**, and a full **CRUD admin panel**.
The project draws inspiration from the atmosphere of Library of Ruina, where knowledge, stories, and destinies intertwine within an ever-shifting library. This theme adds a sense of depth, elegance to the library system.

## Features

### User Features
- Browse a catalog of available books  
- Reserve books directly from the catalog  
- Secure login system  
- Optional **Two‑Factor Authentication (2FA)**  
- Personalized dashboard depending on user role  
- Multi‑language support  

### Admin Features
- Full admin dashboard  
- Create, Read, Update, Delete (CRUD) operations for:
  - Books  
  - Categories  
  - Users  
- View real‑time database data    
- Role‑based access (Admin vs Customer)  
- Admin‑only routes protected by middleware 

## Authentication & Security

### Role‑Based Access Control (RBAC)
Users are assigned roles:
- **Admin:** Full access to admin panel, CRUD operations, and system management  
- **Customer:** Can browse and reserve books, access user dashboard  

Each role sees a **different dashboard** and has access to different routes.

### Two‑Factor Authentication (2FA)
Users can enable 2FA for extra security.  
Once enabled:
- Login requires both password and verification code  
- 2FA status is displayed on the dashboard

### Flash Messaging System
Provides instant feedback to users and admins (success, error, warnings).
Used for login errors, reservation confirmations, CRUD actions, and more.

### Shopping Cart for Book Reservations
Users can add books to a cart before confirming their reservation.
The cart persists through the session and allows:
- Adding/removing books
- Viewing selected items

## Project

### Backend
- PHP (MVC structure)
- Slim Framework (PSR‑7 routing)
- Custom Models & Controllers
- MySQL database

### Frontend
- HTML5, CSS3, JavaScript
- Bootstrap 5
- Responsive UI components

### Other
- Session‑based authentication
- Flash messaging system
- Translation system
- Composer for dependency management

---

##  Installation Guide

### 1. Clone the repository

git clone https://github.com/jonasalameda/book-shop.git

### 2. Install composer

This project uses Composer for dependency management.

Do *composer install* in terminal from the root of the project

### 3. Create env.php file in project root

Environment-specific application configuration.

You should store all secret information (usernames, passwords, tokens,
private keys) here.

TODO:

 * 1) Within this folder, create a new PHP file called env.php.
 * 2) Copy the contents of this file into env.php.
 * 3) Make sure the env.php file is added to your .gitignore
 *    so it is not checked into version control.
 *
 * NOTE:
 * -----
 * This approach ensures that no sensitive passwords or API keys
 * will ever be included in version control history, reducing the
 * risk of a security breach. It also ensures that production values
 * never have to be shared with all project collaborators.
 */


return function (array $settings): array {
    // Database credentials
    $settings['db']['username'] = 'root';
    $settings['db']['database'] = 'book_shop';
    $settings['db']['password'] = '';
};

### 4. Import Database file

Import the .SQL file located in the /data folder into MySQL

### 5. Start your server
Host/deploy it in your preferred software and visit visit: http://localhost/book-shop/

### 6. Create an account

Go to Sign in then **Register here**. Once you go through the registration process you will have an account and you are good to go.




