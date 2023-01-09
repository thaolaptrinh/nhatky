


<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

session_start();
define('_DIR_ROOT', __DIR__);
require_once __DIR__ . '/vendor/autoload.php';

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
  $base_url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
} else {
  $base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/nhatky/';
}


function BASE_URL($url)
{
  global $base_url;
  return $base_url . $url;
}




$controller = 'home';
$action = 'index';
$params = [];

if (!empty($_SERVER['PATH_INFO'])) {
  $url = $_SERVER['PATH_INFO'];
} else {
  $url = '/';
}
$url = trim($url);

$urlArray = array_filter(explode('/', $url));
$urlArray  = array_values($urlArray);






if (!empty($urlArray)) {
  foreach ($urlArray as $key => $value) {
    # code...
    $urlCheck .= $value . '/';
    $fileCheck = rtrim($urlCheck, '/');

    $fileArray = explode('/', $fileCheck);

    $fileArray[count($fileArray) - 1] = ucfirst($fileArray[count($fileArray) - 1]);

    $fileCheck = implode('/', $fileArray);

    if (!empty($urlArray[$key - 1])) {
      unset($urlArray[$key - 1]);
    }

    if (file_exists(__DIR__ . '/app/controllers/' . $fileCheck . '.php')) {
      $controller = $fileCheck;
      break;
    }
  }
  $urlArray = array_values($urlArray);
}

if (!empty($urlArray[0])) {
  $controller = ucfirst($urlArray[0]);
} else {
  $controller = ucfirst($controller);
}


if (file_exists(__DIR__ .  '/app/controllers/' .  $controller . '.php')) {
  if (class_exists("\App\Controllers\\" . $controller)) {
    $controller = "\App\Controllers\\" . $controller;
    $ctrl = new $controller();
    unset($urlArray[0]);

    if (!empty($urlArray[1])) {
      $action = $urlArray[1];
      unset($urlArray[1]);
    }


    $params = array_values($urlArray);
    if (method_exists($controller, $action)) {
      try {
        //code...
        call_user_func_array([$ctrl, $action], $params);
      } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
      }
    }
  }
}
