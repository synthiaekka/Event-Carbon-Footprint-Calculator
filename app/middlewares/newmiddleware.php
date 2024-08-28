<?php


class newmiddleware {

    public function run () {

        return true;
    }

    public function failed () {

        echo "the middleware failed, hence execution stopped";
    }

}