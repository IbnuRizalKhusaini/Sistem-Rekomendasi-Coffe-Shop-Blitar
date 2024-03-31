<?php
session_start();
require_once '../helper/connection.php';

$kode = $_POST['kode'];
$name = $_POST['name'];
$detail = $_POST['detail'];

$query = mysqli_query($connection, "insert into alternatives(kode,name,detail) value('$kode', '$name', '$detail')");
if ($query) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil menambah data'
  ];
  header('Location: ./index.php');
} else {
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => mysqli_error($connection)
  ];
  header('Location: ./index.php');
}
