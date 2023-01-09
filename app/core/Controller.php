<?php

namespace App\Core;

class Controller
{


  public function model($modelName)
  {
    # code...
    if (file_exists(_DIR_ROOT . '/app/models/' . $modelName . '.php')) {
      // require_once _DIR_ROOT . '/app/models/' . $modelName . '.php';
      if (class_exists("\App\Models\\" . $modelName)) {
        $md = "\App\Models\\" . $modelName;
        $model = new $md();
        return $model;
      } else {
        return false;
      }
    }
  }


  public function render($fileName, $data = [])
  {
    # code...
    if (file_exists(_DIR_ROOT . '/app/views/' . $fileName . '.php')) {
      require_once _DIR_ROOT . '/app/views/' . $fileName . '.php';
    }
  }
}
