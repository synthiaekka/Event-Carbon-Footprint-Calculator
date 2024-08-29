<?php

class view extends Controller {



    public function home ($data) {
        $info = [];

        $this->view('home', $info);
    }

    // function to show the signin page
    public function signin () {
        $this->view('signin');
    }

    // function to show the signup page
    public function signup () {
        $this->view('Register');
    }

    // function to show the calculator page
    public function calculator () {
        $this->view('calculator');
    }
}