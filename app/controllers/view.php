<?php

class view extends Controller {



    public function home ($data) {
        $info = [];

        $this->view('home', $info);
    }
}