<?php

class publicForm extends Controller {


    // function to signup new users
    public function signup ($data) {
        /**
         * - validate csrf token
         * - validate the user inputs
         * - check password and repassword match
         * - check if the email and contact already exists in the users list
         * - enter details of the user into database
         */

        // validate csrf token

        // validate the user inputs
        if (!$this->validateFullName($data['fullname'])) { // validate the fullname
            header('location: /Register?error=Only letters and space allowed in fullname');
            die;
        }
        if (!$this->validateEmail($data['email'])) { // validate the email
            header('location: /Register?error=Email in not in valid format');
            die;
        }
        if (!$this->validateContactNumber($data['contact'])) { // validaet the contact number
            header('location: /Register?error=Only 10 digits are allowed in contact number');
            die;
        }
        if (!$this->validatePassword($data['password'])) { // validate the password
            header('location: /Register?error=Password should have atleast one uppercase letter, atleast one lowercase letter, atleast one digit, atleast one special character, and should have minimun 8 character of length');
            die;
        }
        $validated = $data; // the user inpus have been validated

        // check password and repassword match
        if ($validated['password'] !== $validated['repassword']) {
            header('location: /Register?error=The password and Repeat Passwords do not match');
            die;
        }

        // check if the user email and contact number already exists in the database
        $user = $this->model('users');
        $email = $user->fetch_where('email = ?', [$validated['email']]);

        if (count($email) > 0) {
            // user email already exists
            header('location: /Register?error=The user already exists');
            die;
        }

        // enter details of the user into database
        $user->insert([
            'fullname' => $validated['fullname'],
            'email' => $validated['email'],
            'contact' => $validated['contact'],
            'password' => $validated['password'],
            'usertype' => $validated['usertype'],
        ]);
    }


    // function to signin  user
    public function signin ($data) {
         /**
         * - validate csrf token
         * - validate the user inputs
         * - check if the email and contact already exists in the users list
         * - start user sign in session
         */ 

        //  validate csrf token

        // validate the user inputs
        if (!$this->validateEmail($data['email'])) { // validate the email
            header('location: /signin?error=Email in not in valid format');
            die;
        }
        if (!$this->validatePassword($data['password'])) { // validate the password
            header('location: /signin?error=Password is not in valid format');
            die;
        }
        $validated = $data;

        //  check if the user data already exists
        $user = $this->model('users');
        $email = $user->fetch_where('email = ?', [$validated['email']]);

        if (count($email) == 0) {
            // user not found
            // return back to sign in page with errors
            header('location: /signin?error="Incorrect User email"');

            die;
        }


        // check if the password matches the actual password
        if ($validated['password'] !== $email[0]['password']) {
            // return back to sign in page with errors
            header('location: /signin?error="Incorrect Password"');

            die;
        }

        
        
        // user email already exists
        $_SESSION['email'] = $email[0]['email'];
        $_SESSION['id'] = $email[0]['id'];

        // re direct to home page
        header('location: /');
        
    }













    // necessary function for form actions

    // function to validate full name
    private function validateFullName($fullName) {
        // This regex allows letters (both uppercase and lowercase), spaces, hyphens, and apostrophes
        $pattern = "/^[a-zA-Z\s'-]+$/";
    
        // Trim the full name to remove extra spaces
        $fullName = trim($fullName);
    
        // Check if the full name matches the pattern
        if (preg_match($pattern, $fullName)) {
            return true; // Valid full name
        } else {
            return false; // Invalid full name
        }
    }

    // function to valiate email
    function validateEmail($email) {
        // Use filter_var to validate the email address
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true; // Valid email
        } else {
            return false; // Invalid email
        }
    }

    // function to validate contact number
    function validateContactNumber($contactNumber) {
        // Regular expression for a simple 10-digit contact number
        $pattern = "/^\d{10}$/";
    
        if (preg_match($pattern, $contactNumber)) {
            return true; // Valid contact number
        } else {
            return false; // Invalid contact number
        }
    }


    // function to validate password
    /**
     * - atleart one uppercasae letter should exist 
     * - atleaste one lowercase letter should exist
     * - atleast one digit should exist
     * - atleast one special character should exist
     * - the password should be atleast 8 characters long
     */
    function validatePassword($password) {
        // Minimum eight characters, at least one uppercase letter, one lowercase letter, one number, and one special character
        $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    
        if (preg_match($pattern, $password)) {
            return true; // Valid password
        } else {
            return false; // Invalid password
        }
    }
}