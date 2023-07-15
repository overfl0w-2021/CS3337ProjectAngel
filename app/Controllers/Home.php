<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $title = 'Home';
    protected $data = array();

    public function __construct() {
      $this->data = array(
        'title' => $this->title
      );
    }
    public function index()
    {
      /*helper(form);
      $linkTags = array(
        'css' => array(
        'href' => 'public/css/home.css'),
        'rel' => 'stylesheet',
        'type' => 'text/css'
        )
      );
      $this->data['linkTags'] = $linkTags;*/
      return view('home/home', $this->data); //Returns home page from Views folder
    }
}
