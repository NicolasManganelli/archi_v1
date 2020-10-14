<?php

	if (isset($_SESSION['id_compte'])){

	if(isset($_GET['action']))
	{
	switch($_GET['action'])
		{
		case "afficher_comptes":
		
		break;
		
		case "supprimer_comptes":
		
		break;		
		}

		// Calculer l'affichage du tableau de la liste des comptes 


	}
	else{
		header("Location:../index.php");
		}
}	
?>