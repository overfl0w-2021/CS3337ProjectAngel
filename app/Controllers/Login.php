<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
      if(!empty($_SESSION['errors'])) {
          $errors = $_SESSION['errors'];
          unset($_SESSION['errors']);
      }
      return view('login/login'); //Returns Login page from Views folder
    }
    public function logout()
    {
      if (!isset($_SESSION))
      {
        session_start();
      }
      if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
          unset($_SESSION['errors']);
      }
      return redirect()->route('Index');
    }
    public function login() {
      if (!isset($_SESSION))
      {
        session_start();
      }
      $db = new \App\Models\ServerModel();
      $db->initalize();
      $errors = array();
      if (isset($_POST['login_user'])) {
          $username = $_POST['username'];
          $password = $_POST['password'];
          if (empty($username)) {
              array_push($errors, "Username is required");
          }
          if (empty($password)) {
              array_push($errors, "Password is required");
          }
          if(empty($errors)) {
            $data = array('username' => $username, 'password' => $password);
            $errors = $db->login($data, $errors);
            return redirect()->route('Index');
          }
          else {
            $_SESSION['errors'] = $errors;
            return redirect()->route('Login');
          }
        }
    }
}
