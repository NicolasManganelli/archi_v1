<?php
//je connecte la librairie de fonctions php
require_once("../outils/fonctions.php");
//je stocke dans une variable ($connexion)
//le résultat de la fonction connexion()
$connexion=connexion();

//on calcule les notifications des nouveaux messages
$requete="SELECT id_contact FROM contacts WHERE lu=0";
$resultat=mysqli_query($connexion,$requete);
$nb_lignes=mysqli_num_rows($resultat);
$notification=" <span class=\"notif\">".$nb_lignes."</span>";	


//si admin.php reçoit le parametre action (si un client a cliqué sur un bouton)
if(isset($_GET['action']))
	{
	$contenu="form_" . $_GET['action'] . ".html";	
	switch($_GET['action'])
		{
		case "comptes":
		
		break;	
		
		case "actus":

		break;	
		
		case "slider":

		break;	
		
		case "messagerie":
			$contenu="messagerie.html";
			
		break;		
		}	
	}
else//personne n'a cliqué sur un bouton ( à l'arrivée sur le tableau de bord)
	{
	$contenu="intro.html";
	}

mysqli_close($connexion);
include("admin.html");
?>