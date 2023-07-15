<?php

namespace App\Models;

use CodeIgniter\Model;

class ServerModel extends Model
{
  protected $DBGroup = 'default';
  protected $table      = 'UserNameAndPassword';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $returnType     = 'array';
  protected $useSoftDeletes = true;
  protected $allowedFields = ['name', 'email','username','password','salt'];
  function initalize() {
    return $db = \Config\Database::connect();
  }
  function login($data, $errors) {
      $username = $data['username'];
      $password = $data['password'];
      $salt = "SELECT salt FROM UserNameAndPassword WHERE username=". $this->escape($username);
      $resulty = $this->query($salt);
      foreach ($resulty->getResultArray() as $row) {
          $saltresult = $row['salt'];
      }
      if(count($resulty->getResultArray()) == 0) {
          array_push($errors, "Invalid user/pass combo");
      }
      else {
        $password = md5($password . $saltresult);
        $querycheck = "SELECT * FROM UserNameAndPassword WHERE username=". $this->escape($username) . "AND password=" . $this->escape($password);
        $query = $this->query($querycheck);
        $numRows = count($query->getResult());
        $hashuser = md5($username);
        if ($numRows == 1) {
            setcookie("login", $hashuser . $saltresult . $password, time()+3600);
            $_SESSION['username'] = $username;
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['success'] = "You are now logged in";
        }
        else {
          array_push($errors, "Invalid user/password combo");
          redirect()->route('Login');
          return $errors;
        }
      }
  }
  function register($data, $errors) {
    $username = "";
    $email    = "";
    $salt = "";
    if (isset($_POST['reg_user'])) {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $filter = '/[\'^£$%&*()}{#~?><>,|=_+¬-]/';
        if (preg_match($filter, $username) || preg_match($filter, $password))
        {
          array_push($errors, "Special characters not allowed");
          return $errors;
        }
        $query = "SELECT * FROM UserNameAndPassword WHERE username=" . $this->escape($username) . "OR email= " . $this->escape($email) . "LIMIT 1";
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
        $query = $this->query($query);
        $result = $query->getResultArray();
        $user = count($result);
        $resultarray = array();
        if ($user != 0) { // If user exists
            foreach ($result as $r) {
                $resultarray['username'] = $r['username'];
                $resultarray['email'] = $r['email'];
            }
            if ($resultarray['username'] === $username) {
                array_push($errors, "Username already exists");
            }

            if ($resultarray['email'] === $email) {
                array_push($errors, "Email already exists");
            }
            return $errors;
        }
        if (count($errors) == 0) {
            $salt = bin2hex(random_bytes(10));
            $password .= $salt;
            $password = md5($password);//encrypt the password before saving in the database
            $hashuser = md5($username);
            $builder = $this->table('UserNameAndPassword');
            $query = [
              'username' => $username,
              'email' => $email,
              'password' => $password,
              'salt' => $salt,
            ];
            $builder->insert($query);
            setcookie("login", $hashuser . $salt . $password, time()+3600);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            $_SESSION['isLoggedIn'] = true;
        }
    }
  }
}
