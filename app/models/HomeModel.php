<?php

namespace App\Models;

use App\Core\Model;

class HomeModel extends Model
{

  public $data = [];

  public function index()
  {
    # code...

    $this->data = ['contents' => $this->get_list("SELECT * FROM `contents` ORDER BY id DESC")];

    if (isset($_REQUEST['method_type'])) {

      switch ($_REQUEST['method_type']) {


        case 'add':

          if (!empty($_SESSION['user'])) {
            $content = $_REQUEST['content'];

            $this->insert("contents", ['content' => $content, 'id_account' => $_SESSION['user']['id']]);

            die(json_encode([
              'status' => true,
              'message' => 'Add successfully',
            ]));
          } else {
            die(json_encode([
              'status' => false,
              'message' => 'Add failed',
            ]));
          }

          break;

        case 'detail':
          $id = $_REQUEST['id'];
          die(json_encode(['data' => $this->get_row("SELECT * FROM `contents` WHERE id = '$id'")]));
          break;

        case 'edit':

          if (!empty($_SESSION['user'])) {
            $id = $_REQUEST['id'];
            $content = $_REQUEST['content'];

            $this->update("contents", ['content' => $content], "id = '$id'");

            die(json_encode([
              'status' => true,
              'message' => 'Edit successfully',
            ]));
          } else {
            die(json_encode([
              'status' => false,
              'message' => 'Edit failed',
            ]));
          }

          break;

        case 'delete':

          if (!empty($_SESSION['user'])) {
            $id = $_REQUEST['id'];

            $this->remove("contents", "id = '$id'");

            die(json_encode([
              'status' => true,
              'message' => 'Delete successfully',
            ]));
          } else {
            die(json_encode([
              'status' => false,
              'message' => 'Delete failed',
            ]));
          }

          break;

        case 'login':

          $username = $_REQUEST['username'];
          $password = $_REQUEST['password'];

          $user = $this->get_row("SELECT * FROM `accounts` WHERE username = '$username' AND 
          password = '" . md5($password) . "'");
          if (!$user) {
            die(json_encode([
              'status' => false,
              'message' => 'Login failed',
            ]));
          }

          $_SESSION['user'] = [
            'username' => $username,
            'id' => $user['id'],
          ];

          die(json_encode([
            'status' => true,
            'message' => 'Login successfully',
          ]));
          break;

        case 'logout':
          unset($_SESSION['user']);
          die(json_encode([
            'status' => true,
            'message' => 'Logout successfully',
          ]));
          break;
        default:
          exit();
      }
    }
  }

  // public function list()
  // {
  //   # code...

  //   $this->data = ['list' => $this->get_list("SELECT * FROM `contents`")];
  //   echo (json_encode($this->data['list']));
  // }
}
