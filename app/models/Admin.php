<?php


class Admin extends User
{
    use Model;

    protected $table = 'admin';

    protected $allowedColumns = ['id', 'username', 'email', 'password', 'token', 'token_expiry'];


    // Validation method
    public function validation($data)
    {
        $this->errors = []; // Reset errors

        // Validate username
        if (empty($data['username'])) {
            $this->errors['username'] = "User name is required.";
        }

        // Validate email
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format.";
        }

        // Validate password
        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required.";
        }

        return empty($this->errors); // Pass if no errors
    }

    // Method to register an admin
    public function registerAdmin($username, $email, $password)
    {
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash password for security
            'token' => bin2hex(random_bytes(16)), // Generate a random 32-character token
        ];

        return $this->insert($data); // Save to database
    }

    public function emailExists($email)
    {
        $user = $this->first(['email' => $email]);
        return $user != null;
    }
    public function getUserByEmail($email)
    {
        $data = ['email' => $email];
        return $this->first($data);
    }

    public function updateToken($email, $token)
    {
        $data = ['token' => $token];
        $this->update($email, $data, 'email');
    }

    public function updateFcmToken($email, $fcmToken)
    {
        $data = ['fcmToken' => $fcmToken];
        $this->update($email, $data, 'email');
    }
    public function get_admin()
    {
        $sql = "Select * FROM $this->table LIMIT 1";
        $res = $this->query($sql);
        if (is_array($res) && count($res)) {
            return $res[0];
        }
        return false;
    }
    //  public function getAdminById($id)
    // {
    //     $data = ['id' => $id];
    //     return $this->first($data, []);
    // }
    // public function saveResetToken($userId, $token, $expires)
    // {
    //     $data = [
    //         'token' => $token,
    //         'token_expiry' => $expires
    //     ];
    //     return $this->update($userId, $data, 'id');
    // }

    // public function isValidResetToken($token)
    // {
    //     $sql = "SELECT * FROM $this->table WHERE token = :token AND token_expiry > NOW() LIMIT 1";
    //     $res = $this->query($sql, ['token' => $token]);

    //     return is_array($res) && count($res) > 0;
    // }
    // public function findByResetToken($token)
    // {
    //     $sql = "SELECT * FROM $this->table WHERE token = :token AND token_expiry > NOW() LIMIT 1";
    //     $res = $this->query($sql, ['token' => $token]);

    //     return is_array($res) && count($res) ? $res[0] : false;
    // }
    // public function updatePassword($userId, $hashedPassword)
    // {
    //     $data = [
    //         'password' => $hashedPassword,
    //         'token' => null,
    //         'token_expiry' => null
    //     ];
    //     return $this->update($userId, $data); // assuming update by ID
    // }
    // public function clearResetToken($userId)
    // {
    //     $data = ['token' => null, 'token_expiry' => null];
    //     return $this->update($userId, $data);
    // }


}