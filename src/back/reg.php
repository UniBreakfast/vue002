<?php

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

ini_set('display_errors', 1);
error_reporting(E_PARSE | E_ERROR);
require "f.php";

$db = mysqli_connect('localhost', 'root', '', 'sandbox')
  or jsonEr("connection failed");
  // or exit ( '{"error": "connection failed"}' );

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, 1);
$login = $data['login'];
$mail  = $data['mail' ];
$pass  = $data['pass' ] or jsonEr('empty passwords are not allowed');
if (!$login and !$mail)
  jsonEr("it's neccessary to provide login or E-mail");

if ($login) {
  $q = "SELECT login FROM vue_users WHERE login = ?";
  if (f::getValue($db, $q, qp($login,'s')))
    jsonEr("login $login is already occupied");
}
if ($mail) {
  $q = "SELECT email FROM vue_users WHERE email = ?";
  if (f::getValue($db, $q, qp($mail,'s')))
   jsonEr("user with $mail is already registered, if that's you try to log in");
}

require "checks.php";
$hash = hashStr($pass);

if ($login and $mail) {
  $q = "INSERT vue_users (login, email, passhash) VALUES (?, ?, '$hash')";
  f::execute($db, $q, qp($login,'s', $mail, 's'));
}
else if ($login) {
  $q = "INSERT vue_users (login, passhash) VALUES (?, '$hash')";
  f::execute($db, $q, qp($login,'s'));
}
else {
  $q = "INSERT vue_users (email, passhash) VALUES (?, '$hash')";
  f::execute($db, $q, qp($mail, 's'));
}

$response = array("success"=>true, "data"=>$data);
echo json_encode($response);

?>