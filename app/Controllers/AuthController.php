<?php

namespace App\Controllers;

use App\Domain\Models\UserModel;
use App\Helpers\FlashMessage;
use App\Helpers\SessionManager;
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController extends BaseController
{
    public function __construct(Container $container, private UserModel $userModel)
    {
        parent::__construct($container);
    }

    /**
     * Display the registration form (GET request).
     */
    public function register(Request $request, Response $response, array $args): Response
    {
        // TODO: Create a $data array with 'title' => 'Register'
        $data = [
            "title" => 'Register'
        ];
        // TODO: Render 'auth/register.php' view and pass $data
        return $this->render($response, 'auth/register.php', $data);
    }

    /**
     * Process registration form submission (POST request).
     */
    public function store(Request $request, Response $response, array $args): Response
    {
        // TODO: Get form data using getParsedBody()
        //       Store in $formData variable

        $formData = $request->getParsedBody();

        // TODO: Extract individual fields from $formData:
        //       $firstName, $lastName, $username, $email, $password, $confirmPassword, $role

        // Start validation
        $errors = [];

        $firstName = $formData['first_name'];
        $lastName = $formData['last_name'];
        $username = $formData['username'];
        $email = $formData['email'];
        $password = $formData['password'];
        $confirmPassword = $formData['confirm_password'];
        $role = $formData['role'];



        // TODO: Validate required fields (first_name, last_name, username, email, password, confirm_password)
        //       If any field is empty, add error: "All fields are required."
        //       Hint: if (empty($firstName) || empty($lastName) || ...) { $errors[] = "..."; }

        foreach ($formData as $form => $value) {
            if (empty($value)) {
                $errors[] = "All fields are required.";
            }
        }

        // TODO: Validate email format using filter_var()
        //       If invalid, add error: "Invalid email format."
        //       Hint: if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { ... }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }

        // TODO: Check if email already exists using $this->userModel->emailExists($email)
        //       If exists, add error: "Email already registered."

        if ($this->userModel->emailExists($email)) {
            $errors[] = "Email already registered";
        }

        // TODO: Check if username already exists using $this->userModel->usernameExists($username)
        //       If exists, add error: "Username already taken."

        if ($this->userModel->usernameExists($username)) {
            $errors[] = "Username already taken.";
        }

        // TODO: Validate password length (minimum 8 characters)
        //       If too short, add error: "Password must be at least 8 characters long."

        if (strlen($password) < 8) {
            $errors[] = "Password must be 8 characters long";
        }

        // TODO: Validate password contains at least one number
        //       If no number, add error: "Password must contain at least one number."
        //       Hint: if (!preg_match('/[0-9]/', $password)) { ... }

        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Password must contain at least one number.";
        }

        // TODO: Check if password matches confirm_password
        //       If not match, add error: "Passwords do not match."

        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match.";
        }

        // If validation errors exist, redirect back with error message
        // TODO: Check if $errors array is not empty
        //       If errors exist:
        //         - Use FlashMessage::error() with the first error message
        //         - Redirect back to 'auth.register' route

        if (!empty($errors)) {
            FlashMessage::error("Error authenticating user");

            foreach ($errors as $key => $msg) {
                FlashMessage::error($msg);
            }

            return $this->redirect($request, $response, 'auth.register');
        }

        // If validation passes, create the user
        try {
            // TODO: Create $userData array with keys:
            //       'first_name', 'last_name', 'username', 'email', 'password', 'role'

            $userData = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => $role
            ];

            // TODO: Call $this->userModel->createUser($userData)
            //       Store the returned user ID in $userId
            $userId = $this->userModel->createUser($userData);

            // TODO: Display success message using FlashMessage::success()
            //       Message: "Registration successful! Please log in."

            // TODO: Redirect to 'auth.login' route

            FlashMessage::success("Registration successful! Please log in.");
            return $this->redirect($request, $response, 'auth.login');
        } catch (\Exception $e) {
            // TODO: Display error message using FlashMessage::error()
            //       Message: "Registration failed. Please try again."

            // TODO: Redirect back to 'auth.register' route
            dd($e);
            FlashMessage::error("Registration failed. Please try again.");
            return $this->redirect($request, $response, 'auth.register');
        }
    }

    /**
     * Display the login form (GET request).
     */
    public function login(Request $request, Response $response, array $args): Response
    {
        // TODO: Create a $data array with 'title' => 'Login'
        $data = [
            'title' => 'Login'
        ];

        // TODO: Render 'auth/login.php' view and pass $data
        return $this->render($response, 'auth/login.php', $data);
    }

    /**
     * Process login form submission (POST request).
     */
    public function authenticate(Request $request, Response $response, array $args): Response
    {
        // TODO: Get form data using getParsedBody()

        // TODO: Extract 'identifier' and 'password' from form data

        $formData = $request->getParsedBody();

        $identifier = $formData['identifier'];

        $password = $formData['password'];


        // Start validation
        $errors = [];

        // TODO: Validate required fields (identifier and password)
        //       If either is empty, add error: "Email/username and password are required."

        if (empty($password) || empty($identifier)) {
            $errors[] = "Email/username and password are required.";
        }

        // If validation errors exist, redirect back
        // TODO: Check if $errors array is not empty
        //       If errors exist, use FlashMessage::error() and redirect to 'auth.login'
        if (!empty($errors)) {
            FlashMessage::error("An error occurred.");

            return $this->redirect($request, $response, 'auth.login');
        }

        // Attempt to verify user credentials
        // TODO: Call $this->userModel->verifyCredentials($identifier, $password)
        //       Store the result in $user variable
        $user = $this->userModel->verifyCredentials($identifier, $password);

        // Check if authentication was successful
        // TODO: If $user is null (authentication failed):
        //       - Display error message: "Invalid credentials. Please try again."
        //       - Redirect back to 'auth.login'

        if ($user === null) {
            $errors[] = "Invalid credentials. Please Try again.";

            foreach ($errors as $key => $msg) {
                FlashMessage::error($msg);
            }

            return $this->redirect($request, $response, 'auth.login');
        }

        // Authentication successful - create session
        // TODO: Store user data in session using SessionManager:
        SessionManager::set('user_id', $user['id']);
        SessionManager::set('user_email', $user['email']);
        SessionManager::set('user_name', $user['first_name'] . ' ' . $user['last_name']);
        SessionManager::set('user_role', $user['role']);
        SessionManager::set('is_authenticated', true);

        // TODO: Display success message using FlashMessage::success()
        //       Message: "Welcome back, {$user['first_name']}!"
        FlashMessage::success("Welcome back, {$user['first_name']}!");

        // TODO: Redirect based on role:
        //       If role is 'admin', redirect to 'admin.dashboard'
        //       If role is 'customer', redirect to 'user.dashboard'
        //       Hint: if ($user['role'] === 'admin') { ... } else { ... }

        if ($user['role'] === 'admin') {
            return $this->redirect($request, $response, 'dashboard.index');
        } else {
            return $this->redirect($request, $response, 'user.dashboard');
        }
    }

    /**
     * Logout the current user (GET request).
     */
    public function logout(Request $request, Response $response, array $args): Response
    {
        // TODO: Destroy the session using SessionManager::destroy()

        SessionManager::destroy();

        // TODO: Display success message: "You have been logged out successfully."
        FlashMessage::success("You have been logged out successfully.");

        // TODO: Redirect to 'auth.login' route

        return $this->redirect($request, $response, 'auth.login');
    }

    /**
     * Display user dashboard (protected route).
     */
    public function dashboard(Request $request, Response $response, array $args): Response
    {
        // TODO: Create a $data array with 'title' => 'Dashboard'

        $data = [
            'title' => 'Dashboard'
        ];

        // TODO: Render 'user/dashboard.php' view and pass $data
        return $this->render($response, 'user/dashboard.php', $data);
    }
}
