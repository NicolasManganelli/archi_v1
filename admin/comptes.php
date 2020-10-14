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
				//on gere la liste déroulante des statuts
				if(!empty($_POST['statut_compte']))
				  {
				  $selected[$_POST['statut_compte']]= "selected=\"selected\"";
				  }		
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
					$requete="INSERT INTO comptes SET nom_compte='".$_POST['nom_compte']."',
													  prenom_compte='".$_POST['prenom_compte']."',
													  login_compte='".$_POST['login_compte']."',
													  statut_compte='".$_POST['statut_compte']."',
													  pass_compte=SHA1('".$_POST['pass_compte']."')";
					$resultat=mysqli_query($connexion,$requete);
					$message="<label class=\"ok\">Nouveau compte créé</label>";
					}
				}
			break;
			
			case "supprimer_compte":
			if(isset($_GET['id_compte']))
				{
				$entete="<h1 class=\"ouinon\">Vous-voulez vraiment supprimer ce compte ? 
				<a href=\"admin.php?module=comptes&action=supprimer_compte&statut_compte=".$_GET['statut_compte']."&id_compte=".$_GET['id_compte']."&confirm=1\">OUI</a>
				<a href=\"admin.php?module=comptes&action=afficher_comptes\">NON</a>
				</h1>";
				//si l'internaute à confirmer la suppression (bouton oui)
				if(isset($_GET['confirm']) && $_GET['confirm']==1)
					{
					//on vérifie que ce n'est pas le dernier statut admin	
					$requete="SELECT * FROM comptes WHERE statut_compte='admin'";
					$resultat=mysqli_query($connexion,$requete);
					$nb=mysqli_num_rows($resultat);
					
					if($nb==1 && $_GET['statut_compte']=="admin")
						{
						$entete="<h1 class=\"pas_ok\">Impossible ! Il faut au moins un compte admin</h1>";	
						}
					else{
						$requete2="DELETE FROM comptes WHERE id_compte='".$_GET['id_compte']."'";	
						$resultat2=mysqli_query($connexion,$requete2);
						$entete="<h1 class=\"ok\">Compte supprimé</h1>";						
						}
					}
				}
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
			$tab_resultats.="<td>
			<a href=\"admin.php?module=comptes&action=supprimer_compte&statut_compte=".$ligne->statut_compte."&id_compte=".$ligne->id_compte."\">
			<span class=\"dashicons dashicons-no-alt\"></span>
			</a></td>\n";			
			$tab_resultats.="</tr>";	
			}
		$tab_resultats.="</table>";
		}
	}
else{
	header("Location:../index.php");	
	}		
?>