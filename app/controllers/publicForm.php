<?php

class publicForm extends Controller {


    // function to signup new users
    public function signup ($data) {
        /**
         * - validate csrf token
         * - validate the user inputs
         * - check password and repassword match
         * - enter details of the user into database
         */

        // validate csrf token

        // validate the user inputs
        if (!validateFullName($data['fullname'])) { // validate the fullname
            header('location: /signup?error=Only letters and space allowed in fullname');
            die;
        }
        if (!validateEmail($data['email'])) { // validate the email
            header('location: /signup?error=Email in not in valid format');
            die;
        }
        if (!validateContactNumber($data['contact'])) { // validaet the contact number
            header('location: /signup?error=Only 10 digits are allowed in contact number');
            die;
        }
        if (!validatePassword($data['password'])) { // validate the password
            header('location: /signup?error=Password should have atleast one uppercase letter, atleast one lowercase letter, atleast one digit, atleast one special character, and should have minimun 8 character of length');
            die;
        }
        $validated = $data; // the user inpus have been validated

        // check password and repassword match
        if ($validated['password'] !== $validated['repassword']) {
            header('location: /signup?error=The password and Repeat Passwords do not match');
            die;
        }

        // enter details of the user into database
        $user = $this->model('users');
        $user->insert([
            'fullname' => $validated['fullname'],
            'email' => $validated['email'],
            'contact' => $validated['contact'],
            'password' => $validated['password'],
            'usertype' => $validated['usertype'],
        ]);
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