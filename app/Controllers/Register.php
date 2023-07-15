<?php

namespace App\Controllers;

class Register extends BaseController
{
    public function index()
    {
      return view('register/register'); //Returns Login page from Views folder
    }
    public function register() {
      if (!isset($_SESSION))
      {
        session_start();
      }
      $db = new \App\Models\ServerModel();
      $db->initalize();
      $errors = array();
      if (isset($_POST['reg_user'])) {
          $username = $_POST['username'];
          $password = $_POST['password_1'];
          $password2 = $_POST['password_2'];
          $email = $_POST['email'];
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              array_push($errors,"Invalid email format");
          }
          if (empty($username)) {
              array_push($errors, "Username is required");
          }
          if (empty($password)) {
              array_push($errors, "Password is required");
          }
          if ($password != $password2) {
              array_push($errors, "The two passwords do not match");
          }
          if(empty($errors)) {
            $data = array('username' => $username, 'password' => $password, 'email' => $email);
            $errors = $db->register($data, $errors);
            if(!empty($errors)) {
              $_SESSION['errors'] = $errors;
              var_dump($_SESSION['errors']);
              return redirect()->route('Register');
            }
            else {
              return redirect()->route('Index');
            }
          }
          else {
            $_SESSION['errors'] = $errors;
            return redirect()->route('Register');
          }
        }
      }
}
