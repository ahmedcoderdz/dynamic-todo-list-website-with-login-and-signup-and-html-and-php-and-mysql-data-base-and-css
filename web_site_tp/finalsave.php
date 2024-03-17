<?php 
session_start();
include("connection.php"); //connecté avec base des données.

if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à ce page.
    echo "Connectez vous d'abord, svp.";
}else{

    if(isset($_POST['oui'])){

        $tdo = $_SESSION['$todo'];
        $idedit = $_SESSION['$idE'];

        if ($_POST['tache'] == $tdo) { //si ne modifier rien!
            header('location: todo.php');
        }elseif($_POST['tache']==""){ //s'il supprime et fait sauvgarder ==> supprimer la tache
            header('location: supprimer.php?deletid='.$idedit);
        }else {
            $nv = $_POST['tache'];
            $editer = $conect->query("UPDATE tache SET todo = '$nv' WHERE idtache = '$idedit' ");
            if ($editer) {
                header('location: todo.php');
            }else {
                echo 'Dzl, un erreur de mis à jour!' ;
            }

        }
    
    }

}

?>