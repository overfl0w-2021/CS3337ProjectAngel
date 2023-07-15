<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

class Upload extends BaseController
{
  protected $helpers = ['form'];
  protected $mediaPath = 'public/uploads/';
  public function index()
  {
      return view('upload/upload', ['errors' => []]);
  }
  public function upload()
  {
    if(!isset($_SESSION['username'])) {
      return redirect()->route('Login');
    }
    else {
      $db = new \App\Models\MediaModel();
      $db->initalize();
      $validationRule = [
              'userfile' => [
                  'label' => 'Image File',
                  'rules' => [
                      'uploaded[userfile]',
                      'is_image[userfile]',
                      'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                      'max_size[userfile,1000000]',
                  ],
              ],
          ];
          if (! $this->validate($validationRule)) {
              $data = ['errors' => $this->validator->getErrors()];
              return view('upload/upload', $data);
          }

          $img = $this->request->getFile('userfile');

          if (! $img->hasMoved()) {
              $filepath = WRITEPATH . 'uploads/' . $img->store();
              $data = ['uploaded_fileinfo' => new File($filepath)];
              $datas = new File($filepath);
              $errors = array();
              $db->upload($datas, $errors);
              var_dump($datas);
              return view('upload/uploaded', $data);
          }

          $data = ['errors' => 'The file has already been moved.'];

          return view('upload/upload', $data);
      }
    }
  }
