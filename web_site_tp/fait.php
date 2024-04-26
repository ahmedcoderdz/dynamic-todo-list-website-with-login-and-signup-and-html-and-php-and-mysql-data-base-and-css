<?php 
session_start();
include("connection.php"); //connecté avec base des données.

if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à ce page.
    $a = 1;
    $_SESSION['$a']=$a;
    header('location: start.php');
}else{

if (isset($_GET['tacheid'])) { //all
    $idT = $_GET['tacheid'];
    if($conect->query("UPDATE tache SET cas = 'done' WHERE idtache='$idT' ")){
        header('location: todo.php');
    }
}else if (isset($_GET['Dtacheid'])) { //done
    $idT = $_GET['Dtacheid'];
    if($conect->query("UPDATE tache SET cas = 'done' WHERE idtache='$idT' ")){
        header('location: todo_fin.php');
    }
}else if (isset($_GET['Ctacheid'])) { //en cour
    $idT = $_GET['Ctacheid'];
    if($conect->query("UPDATE tache SET cas = 'done' WHERE idtache='$idT' ")){
        header('location: todo_cour.php');
    }
}

} ?>