<?php
//je connecte la librairie de fonctions php
require_once("../outils/fonctions.php");
//je stocke dans une variable ($connexion)
//le résultat de la fonction connexion()
$connexion=connexion();

//si admin.php reçoit le parametre action (si un client a cliqué sur un bouton)
if(isset($_GET['module']))
	{
	$contenu="form_" . $_GET['module'] . ".html";	
	switch($_GET['module'])
		{
		case "comptes":
		include_once("comptes.php");
		break;	
		
		case "actus":

		break;	
		
		case "slider":

		break;

		case "messages":
		include_once("message.php");
		break;		
		}	
	}
else//personne n'a cliqué sur un bouton ( à l'arrivée sur le tableau de bord)
	{
	$contenu="intro.html";
	}
	
//on calcule les notifications des nouveaux messages
$requete="SELECT lu FROM contacts WHERE lu=0";
$resultat=mysqli_query($connexion,$requete);
$nb_lignes=mysqli_num_rows($resultat);
$notification=" <span class=\"notif\">".$nb_lignes."</span>";		

mysqli_close($connexion);
include("admin.html");
?>