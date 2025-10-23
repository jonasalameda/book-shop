# Tables

- Categories
- Products
- Product Images

# Admin Panel (“backstage”)

Special, protected area of your website that only administrators can access.

- Protect sensitive data: Only admins can access it.

- Manage content: Admins can add, update, or remove products and categories.

- Monitor orders: Admins can view and manage customer orders.

- Control the site: Admins have special permissions regular users don’t have.

## Implementation

### 1. Create Admin Authentication Middleware

(NEXT WEEK)


### 2. Create a Set of Controllers

Create **(In Class):**
- DashBoard controller
- Prodcuts controller

Create **(At home):**

- CategoriesController
- OrdersController
- UsersController


**Each controller must have these standard callback methods:**

index() → Display a list of items.

show() → Show details of a single item.

create() → Display a form to create a new item.

store() → Save a new item to the database.

edit() → Display a form to edit an item.

update() → Save changes to an item.

delete() → Remove an item.

#### Controller Constructor and Callback Methods Signatures

https://frostybee.github.io/web-dev/php/slim/crud-routes/#controller-constructor-and-callback-methods-signatures

The following folders should look like this:

    Views/:
        admin/:
            Products/:
                ProductsIndexView/

**After that create the route**

### 3. Set Up an Admin Routes Group

In routes panel we will split it in 2 groups:

https://frostybee.github.io/web-dev/php/assignment-2/admin-panel/#3-set-up-an-admin-routes-group

- All admin routes share the same prefix (/admin)
### 4. Create Admin Views

#### File Structure:

https://frostybee.github.io/web-dev/php/assignment-2/admin-panel/#expected-file-structure


# Routing

https://frostybee.github.io/web-dev/php/slim/routing-concept/#what-is-routing


Three parts:
- HTTP method (GET or POST)
- URI pattern
- Code that executes to handle the request(callback method)
## URIs

URI Patterns:

**Static**: Exact paths, e.g., /about, /contact

**Dynamic (with parameters)**: Paths like /users/{id}, where {id} is a placeholder for a variable value.


Working with MVC it's essential to have:

- Controller
- Action to be performed (CRUD)
- callback
- View (interface to interact with the )
- Route

# Session Middleware

Class that will function as middleware that will automatically start PHP sessions for your entire application.

- Instead of calling **session_start()** in every route, the middleware does it for you once

## Creating Session Middleware

- SessionManager: Handles session configuration and security.
- SessionMiddleware: Triggers SessionManager for every request

## Register Middleware

https://frostybee.github.io/web-dev/php/middleware/session/#step-3-register-the-middleware

# Standard Web Routes

to associate a name with a route we call **setName()**.