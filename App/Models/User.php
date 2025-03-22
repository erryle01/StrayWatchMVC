<?php 

/**
 * User class
 */
class User
{
    use Model;

    protected $table = 'users';

    protected $allowedColumns = [
        'email',
        'password',
    ];

    public function validate($data)
    {
        $this->errors = [];

        // Email validation
        if(empty($data['email']))
        {
            $this->errors['email'] = "Email is required";
        } else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            $this->errors['email'] = "Email is not valid";
        }
        
        // Password validation
        if(empty($data['password']))
        {
            $this->errors['password'] = "Password is required";
        }
        
        // Confirm password validation
        if(empty($data['confirm_password']))
        {
            $this->errors['confirm_password'] = "Confirm password is required";
        } else if($data['password'] !== $data['confirm_password'])
        {
            $this->errors['confirm_password'] = "Password and confirm password do not match";
        }
        
        // Terms and conditions validation
        if(empty($data['terms']))
        {
            $this->errors['terms'] = "Please accept the terms and conditions";
        }

        // If no errors, return true
        if(empty($this->errors))
        {
            return true;
        }

        return false;
    }
}
