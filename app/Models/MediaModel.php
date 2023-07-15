<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaModel extends Model
{
  protected $DBGroup = 'default';
  protected $table      = 'Media';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $returnType     = 'array';
  protected $useSoftDeletes = true;
  protected $allowedFields = ['userid', 'url','mediatype','caption','filename','id'];
  function initalize() {
    return $db = \Config\Database::connect();
  }
  function upload($file, $errors) {
      $username = $_SESSION['username'];
      $querycheck = "SELECT * FROM UserNameAndPassword WHERE username=". $this->escape($username);
      $query = $this->query($querycheck);
      $numRows = count($query->getResult());
      $hashuser = md5($username);
      if ($numRows == 1) {
        foreach ($query->getResultArray() as $row) {
            $salt = $row['salt'];
            $password = $row['password'];
        }
        $name = $file->getBasename();
        $extension = $file->guessExtension();
        $build = $this->table("Media");
        $idquery = "SELECT id FROM UserNameAndPassword WHERE ". $this->escape($username);
        $idcheck = $this->query($idquery);
        foreach ($idcheck->getResultArray() as $row) {
            $idquery = $row['id'];
        }
        $url = $file->getRandomName();
        $query = [
          'userid' => $idquery,
          'url' => $url,
          'mediatype' => $extension,
          'filename' => $name,
        ];
        $build->insert($query);
      }
  }
}
