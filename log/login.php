<?php 
//permet d'autoriser l'usage des variables de session.
session_start();
require_once("../outils/fonctions.php"); 
	
// Si qqun appuie sur le bouton "Entrer" du formulaire de connexion.
if(isset($_POST['submit']))
	{	
		// Et que le kaptcha est rempli et que le login est correct ainsi que le mot de passe.
	if(!empty($_POST['captcha']) && !empty($_POST['login_compte']) && !empty($_POST['pass_compte']))
		{ 
			// et que tout est rempli correctement.
		if(isset($_SESSION['captcha']) && $_SESSION['captcha']==$_POST['captcha'])
			{
				//alors je me connecte.
			login($_POST['login_compte'],$_POST['pass_compte']); 	
			}			         
		}				
	}
	
include('login.html');
?>