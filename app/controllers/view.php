<?php

class view extends Controller {



    public function home ($data) {

        $info = ['information' => 'this data is generated'];

        $user = $this->model('user');

        $data = $user->query("SELECT * FROM doctors WHERE 1");

        echo "<pre>";

        var_dump($data);

        $this->view('home', $info);
    }
}