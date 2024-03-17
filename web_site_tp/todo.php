<?php 
session_start();
include("connection.php"); //connecté avec base des données.

if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à ce page.
    echo "Connectez vous d'abord, svp.";
}else{
$email = $_SESSION['email'];

$resultat = $conect->query("SELECT iduser FROM user WHERE email='$email' ");//pour garder iduser
$i = $resultat->fetch_assoc(); //$i['iduser']==> باه نحفضو لكل مستعمل معلوماته
$id = $i['iduser'];

if (isset($_POST['submitA']) && $_POST['tache'] != ""){ //submitA ==> nom de le champ input
$tache = $_POST['tache'];

$insert = "INSERT INTO tache (todo, iduser) VALUES ('$tache', '$id')";
           $conect->query($insert); //pour exécuter
}
?>

<!doctype html>
<html>
<head>
	<title>Task List</title>
    <button><a href="sortir.php">Se déconnecter</a></button>


</head>
<body>
	
	<header>
		<h1>Task List</h1>
		<form action="todo.php" method="POST">
			<input type="text" name="tache" id="new-task-input" placeholder="Saisir votre tâche" >
			<input type="submit" name="submitA" id="new-task-submit" value="Add task" >
		</form>
	</header>
	<main>
		<section class="task-list">
			<h2>Tasks</h2>

            <?php 
            $R = $conect->query("SELECT idtache, todo FROM tache WHERE iduser = '$id' "); //pour affiche les tache d'utilisateur
            while($T = $R->fetch_assoc()){
                
                echo '<td>'. $T['todo'].' </td>
                <button><a href="modifier.php?editid='.$T['idtache'].'" >Modifier</a></button>
                <button><a href="supprimer.php?deletid='.$T['idtache'].'" >Supprimer</a></button><br>';
            }

            ?>
		</section>
	</main>

</body>

</html>

<?php } ?>