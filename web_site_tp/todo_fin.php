<?php 
session_start();
include("connection.php"); //connecté avec base des données.

if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à ce page.
    $a = 1;
    $_SESSION['$a']=$a;
    header('location: start.php');
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

<link rel="stylesheet" href="core.css">

<head>
	<title>Task List</title>
    <button class="deconneter"><a href="sortir.php">Se déconnecter</a></button>


</head>
<body>
	
	<header>
        <div></div>
		<h1>Task List</h1>
		<form action="todo.php" method="POST">
			<input type="text" name="tache" id="new-task-input" placeholder="Saisir votre tâche" >
			<input type="submit" name="submitA" id="new-task-submit" value="Ajouter" >
		</form>
	</header>
	<main>
                       <h2 class="h22">Tasks(Fin)</h2>
    <a href="todo.php"><h2 class="h22">Tasks(Touts)</h2></a>
    <a href="todo_cour.php"><h2 class="h22">Tasks(En cours)</h2></a>

            <hr>
		<section class="task-list">

            <?php 
            $R = $conect->query("SELECT idtache, todo, cas FROM tache WHERE iduser = '$id' and cas='done' "); //pour affiche les tache d'utilisateur
            while($T = $R->fetch_assoc()){
                echo '<td>'. $T['todo'].' </td>';
                
                 //hna delet 'done' mn base de donée                   
                     echo '<a href="unfait.php?Dtacheid='.$T['idtache'].'"><button>Unfait!</button></a>';
                

                echo '<br><div class= "buttons">
                <a href="modifier.php?editid='.$T['idtache'].'"><button>Modifier</button></a>
                <a href="supprimer.php?deletid='.$T['idtache'].'"><button>Supprimer</button></a><br>
                </div>';
            }

            ?>
		</section>
	</main>
    <p class="copy">&copy;ABDESSAMED_AHMED</p>
</body>
    
</html>

<?php } ?>