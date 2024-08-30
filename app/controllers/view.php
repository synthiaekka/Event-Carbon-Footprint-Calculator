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

        // get all the event categories and show them to the user
        $eventCategories = $this->model('event_groups');

        $all_event_categories = $eventCategories->fetch_where(' 1');

        $view_data = [
            'event_cat' => $all_event_categories,
        ];
        
        $this->view('events', $view_data);
    }


    // function to show sub events page
    public function subevents ($data) {

        // get all the event categories and show them to the user
        $eventCategories = $this->model('events');

        $event_cat = $data['id'];

        $all_event_categories = $eventCategories->fetch_where('event_group_id = ?', [$event_cat]);

        // echo "<pre>";
        // print_r($all_event_categories); die;

        $view_data = [
            'event_cat' => $all_event_categories,
        ];
        
        $this->view('sub-events', $view_data);
    }

    // function to show the calculator
    public function calc ($data) {

        // get all the question types and question of the event

        // get the event id
        $event_id = $data['id'];

        // get all the question group of that event
        $question_groups = $this->model('questions_group')->fetch_where('event_id = ?', [$event_id]);

       

        for ($i = 0; $i < count($question_groups); $i++) {
            // get all question in this group
            $group = $question_groups[$i];
            $questions = $this->model('questions')->fetch_where('question_group_id = ?', [$group['id']]);
            $question_groups[$i]['questions'] = $questions;

            // for each question fetch the answers
            for ($j = 0; $j < count($question_groups[$i]['questions']); $j++) {
                // get all the answers of the question
                $question = $question_groups[$i]['questions'][$j];
                $answers = $this->model('answers')->fetch_where('question_id = ?', [$question['id']]);
                $question_groups[$i]['questions'][$j]['answers'] = $answers;
            }

        }

        $view_data = [
            'questions_group' => $question_groups,
        ];

        $this->view('calculator', $view_data);
    }
}