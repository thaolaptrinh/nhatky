<?php

namespace App\Core;

use App\Configs\Database;

class Model extends  Database
{

  public $db;
  public function __contruct()
  {
    # code...
    $this->db = new Database;
  }
}
