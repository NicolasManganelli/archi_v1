<?php
if(isset($_SESSION['id_compte']))
	{
	if(isset($_GET['action']))
		{
		switch($_GET['action'])
			{
			case "afficher_comptes":
			$entete="<h1>Gestion des comptes</h1>";
			//2. on insert les champs dans la table comptes (modele : front.php)
			if(isset($_POST['submit']))
				{
				if(empty($_POST['nom_compte']))
					{
					$message="<label class=\"pas_ok\">Mets ton nom</label>";	
					$color['nom_compte']="class=\"avertissement\" ";						
					}					
				elseif(empty($_POST['prenom_compte']))
					{
					$message="<label class=\"pas_ok\">Mets ton prénom</label>";	
					$color['prenom_compte']="class=\"avertissement\" ";						
					}	
				elseif(empty($_POST['login_compte']))
					{
					$message="<label class=\"pas_ok\">Mets ton login</label>";	
					$color['login_compte']="class=\"avertissement\" ";						
					}
				elseif(empty($_POST['statut_compte']))
					{
					$message="<label class=\"pas_ok\">Mets ton statut</label>";	
					$color['statut_compte']="class=\"avertissement\" ";						
					}					
				elseif(empty($_POST['pass_compte']))
					{
					$message="<label class=\"pas_ok\">Mets ton pass</label>";	
					$color['pass_compte']="class=\"avertissement\" ";						
					}
				else{
					$requete="INSERT INTO comptes SET nom_compte='',
													  prenom_compte='',
													  login_compte='',
													  statut_compte='',
													  pass_compte=''";
					
					}
				}
			break;
			
			case "supprimer_comptes":
			//3. on supprime un compte de la table comptes (modele : messages.php)
			break;		
			}
			
		//1. calculer l'affichage du tableau de la liste des comptes	
		$tab_resultats="<table class=\"tab_resultats\">\n";
		$tab_resultats.="<tr>";
		$tab_resultats.="<th>Identité</th>";
		$tab_resultats.="<th>Login</th>";
		$tab_resultats.="<th>Statut</th>";
		$tab_resultats.="<th>Actions</th>";
		$tab_resultats.="</tr>";
		$requete="SELECT * FROM comptes ORDER BY id_compte DESC";
		$resultat=mysqli_query($connexion,$requete);
		while($ligne=mysqli_fetch_object($resultat))
			{
			$tab_resultats.="<tr>";	
			$tab_resultats.="<td>" . $ligne->prenom_compte . " " . $ligne->nom_compte . "</td>";
			$tab_resultats.="<td>" . $ligne->login_compte . "</td>";
			$tab_resultats.="<td>" . $ligne->statut_compte . "</td>";
			$tab_resultats.="<td>X</td>";			
			$tab_resultats.="</tr>";	
			}
		$tab_resultats.="</table>";
		}		
	}
else{
	header("Location:../index.php");	
	}		
?>