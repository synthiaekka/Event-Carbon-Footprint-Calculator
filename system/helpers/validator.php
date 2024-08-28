<?php

trait Validator {

    // array to store all errors 
    public $errors = [];

    // function to validate the form
    public function validate($request, $fields_rules) {

        // show error if csrf token not present, or not validated
        if(!isset($request['csrf_token'])) {
            showCsrfTokenValidationError();
        }
        else if($request['csrf_token'] !== $_SESSION['csrf_token']) {
            showCsrfTokenValidationError();
        } 

        else {
            // csrf token validation successful
            // check for other validation rules
            /**
             * this foreach loop will run for each field of the $request
             */
            foreach ($fields_rules as $field => $rules) {
                
                $allRules = explode('|', $rules);

                // validation for 'required' rule
                if (in_array("required", $allRules)){
                    if (empty($request[$field])){
                        $this->errors[$field] = $field . " is required";
                    }
                }

                // validation for 'minLength:3' rule
                foreach($allRules as $rule) {
                    if (preg_match('/minLength:[0-9][0-9]?/', $rule)) {
                        $minLength = explode(':', $rule)[1];

                        if (strlen($request[$field]) < $minLength){
                            $this->errors[$field] = $field . " is too short. minimum length allowed is " . $minLength;
                        }
                    }
                }

                // validation for 'maxLength:3' rule
                foreach($allRules as $rule) {
                    if (preg_match('/maxLength:[0-9][0-9]?/', $rule)) {
                        $maxLength = explode(':', $rule)[1];

                        if (strlen($request[$field]) > $maxLength){
                            $this->errors[$field] = $field . " is too long. maximum length allowed is " . $maxLength;
                        }
                    }
                }

                // validation for 'email' rule
                if(in_array("email", $allRules)){
                    if (!filter_var($request[$field], FILTER_VALIDATE_EMAIL)) {
                        $this->errors[$field] = $field . " should be in proper email format";
                    }
                }

                // validation for 'alphabets' rule
                if (in_array('alphabets', $allRules)) {
                    if (!preg_match('/[a-zA-Z]*/', $request[$field])) {
                        $this->errors[$field] = "Only alphabets are allowed";
                    }
                }

                // valudation for 'username' rule
                if (in_array('username', $allRules)) {
                    if (!preg_match('/[a-zA-Z0-9\_]*/', $request[$field])) {
                        $this->errors[$field] = "Only alphabets, numbers and underscore(_) are allowed for ";
                    }
                }

                // validation for 'numeric' rule
                if (in_array('numeric', $allRules)) {
                    if (!preg_match('/[0-9]/', $request[$field])) {
                        $this->errors[$field] = "Only numbers are allowed";
                    }
                }

                
            }

            // if form is validated return true
            if(empty($this->errors)) {
                return true;
            }

            // the form is not validated, return false
            return false;
        }
    }

    public function getValidationErrors () {
        return $this->errors;
    }
}