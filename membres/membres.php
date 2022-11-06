<?php 
	
	session_start();	
	require_once '../connexion/config.php';
	
	if(!isset($_SESSION['user']))
		header('Location:../connexion/connexion.php');
	
	if($_SESSION['admin'] != 1)
		header('Location:../accueil.php');

?>
	
<head>
    <meta charset="UTF-8">
    <title>LeMauvaisCoin</title>
	<link href="styles.css" rel="stylesheet" type="text/css" rel="icon" href="../lmc.png"/> 
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="result">
       <div class="result-content">
            <h3>Liste des membres</h3>
            <div class="liste-produits">
                <?php 
				   $con = mysqli_connect("localhost","root","","projet");
                   $req2 = mysqli_query($con , "SELECT * FROM utilisateur");
                   if(mysqli_num_rows($req2) == 0){
					   echo "Aucun utilisateur trouvé";
                   }else {
                       while($row = mysqli_fetch_assoc($req2)){
                           echo '
                           <div class="utilisateur">
                                <div class="text" style = "margin-top:10px;">
                                    <p class="pseudo"><strong>'.$row['pseudo'].'</strong>
									<span>
										<a style="color:orange;text-decoration:none;" href="admin.php?id='.$row['id'].'">(Admin)</a>
										<a style="color:red;text-decoration:none;" href="revoquer.php?id='.$row['id'].'">(Révoquer)</a>
										<a style="color:red;text-decoration:none;" href="bannir.php?id='.$row['id'].'">(Bannir)</a>
									</span>
									</p>
                                    <p class="description">'.$row['email'].'
									
                                </div>
                           </div>
                           ';
						   
                       }
                   }

                ?>
               
            </div>
			<a href = "../accueil.php"><div class = "icon"><ion-icon name="arrow-back-circle-outline"></ion-icon></div></a>
       </div>
    </div>
</body>
</html>