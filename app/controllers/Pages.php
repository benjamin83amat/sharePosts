<?php

  class Pages extends Controller {
    public function __construct() {
    }
    
    public function index() { 
      $data = [
        'title' => 'SharePosts',
        'description' => 'Simple social network build on the Simple MVC framework'
      ];
      
      $this->view('pages/index', $data);
    }
    public function about() {
         $data = [
        'title' => 'About us',
        'description' => 'App to shareposts with other users'
      ];
       $this->view('pages/about', $data);
    }
  }