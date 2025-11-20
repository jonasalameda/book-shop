<?php

namespace App\Domain\Models;

use App\Helpers\Core\PDOService;


class UserModel extends BaseModel {

    private $users_table = "users";


    /**
     * Create a new user account.
     *
     * @param array $data User data (first_name, last_name, username, email, password, role)
     * @return int The ID of the newly created user
     */
    public function createUser(array $data): int {
        // TODO: Hash the password using password_hash() with PASSWORD_BCRYPT
        //       Store the result in $hashedPassword variable
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        // TODO: Write an INSERT SQL query to insert a new user into the users table
        //       Insert: first_name, last_name, username, email, password_hash, role
        //       Use named parameters (e.g., :first_name, :last_name, etc.)
        $this->execute(
            'INSERT INTO `users` (first_name, last_name, username, email, password_hash, role) VALUES (:first_name, :last_name, :username, :email, :password_hash, :role)',
            [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password_hash' => $hashedPassword,
                'role' => $data['role'],
            ]
        );

        return (int) $this->lastInsertId();

        // TODO: Execute the query with appropriate parameters
        //       Use $hashedPassword for the password_hash field

        // TODO: Return the last inserted ID
    }

    /**
     * Find a user by email address.
     *
     * @param string $email The email address to search for
     * @return array|null User data array or null if not found
     */
    public function findByEmail(string $email): ?array
    {
        // TODO: Write a SELECT SQL query to find a user by email
        //       Select all columns from the users table where email matches
        //       Use named parameter :email and LIMIT 1

        // TODO: Execute the query and return the result

        $sql = "SELECT * FROM {$this->users_table} WHERE email = :email LIMIT 1";
        $user = $this->selectOne($sql, ["email" => $email]);
        return $user;
    }

    /**
     * Find a user by username.
     *
     * @param string $username The username to search for
     * @return array|null User data array or null if not found
     */
    public function findByUsername(string $username): ?array
    {
        // TODO: Write a SELECT SQL query to find a user by username
        //       Select all columns from the users table where username matches
        //       Use named parameter :username and LIMIT 1

        // TODO: Execute the query and return the result

        $sql = "SELECT * FROM {$this->users_table} WHERE username = :username LIMIT 1";
        $user = $this->selectOne($sql, ["username" => $username]);
        return $user;
    }

    /**
     * Check if an email address already exists in the database.
     *
     * @param string $email The email address to check
     * @return bool True if email exists, false otherwise
     */
    public function emailExists(string $email): bool
    {
        // TODO: Write a SELECT COUNT(*) query to count users with the given email
        //       Alias the count as 'count'
        //       Use named parameter :email

        // TODO: Execute the query and return true if count > 0, false otherwise

        $sql = "SELECT COUNT(*) AS count FROM {$this->users_table} WHERE email = :email";
        $result = $this->selectOne($sql, ["email" => $email]);

        return $result['count'] > 0;
    }

    /**
     * Check if a username already exists in the database.
     *
     * @param string $username The username to check
     * @return bool True if username exists, false otherwise
     */
    public function usernameExists(string $username): bool
    {
        // TODO: Write a SELECT COUNT(*) query to count users with the given username
        //       Alias the count as 'count'
        //       Use named parameter :username

        // TODO: Execute the query and return true if count > 0, false otherwise

        $sql = "SELECT COUNT(*) AS count FROM {$this->users_table} WHERE username = :username GROUP BY username";
        $user = $this->selectOne($sql, ["username" => $username]);
        return $user > 0;
    }

    /**
     * Verify user credentials by email/username and password.
     *
     * @param string $identifier Email or username
     * @param string $password Plain-text password to verify
     * @return array|null User data if credentials are valid, null otherwise
     */
    public function verifyCredentials(string $identifier, string $password): ?array
    {
        // TODO: Try to find user by email first
        $user = $this->findByEmail($identifier);

        // TODO: If user not found by email, try finding by username
        if (!$user) {
            $user = $this->findByUsername($identifier);
        }

        // TODO: If user still not found, return null (invalid credentials)

        // TODO: Verify the password using password_verify($password, $user['password_hash'])
        //       If password is valid, return $user
        //       If password is invalid, return null

        // Hint: Structure should be:
        if (password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return null;
    }


}

