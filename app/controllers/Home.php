<?php



namespace App\Controllers;

use App\Core\Controller;

class Home extends Controller
{

  public $data = [];
  public $model = null;


  public function __construct()
  {
    # code...
    $this->model = $this->model("HomeModel");
  }


  public function index()
  {
    # code...
    $this->model->index();
    $this->data = array_merge($this->data, $this->model->data);
    $this->render('home/index', $this->data);
  }

  // public function list()
  // {
  //   # code...
  //   $this->model->list();
  //   $this->data = array_merge($this->data, $this->model->data);
  //   $this->render('home/list', $this->data);
  // }
}
