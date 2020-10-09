<?php 

if(isset($_GET['action']))
	{	
    switch($_GET['action']){
        case "afficher_message":
			$contenu="messagerie.html";
			
			//on construit un tableau qui affiche tous
			//les messages reçus depuis le front
			$tab_resultats="<table class=\"tab_resultats\">\n";
				$requete="SELECT * FROM contacts 
						ORDER BY date_contact DESC";
				$resultat=mysqli_query($connexion,$requete);
				//tant que dans la variable $resultat il y a des lignes 
				//je vais exploiter chaque champ de chaque ligne sous forme d'objets
				$i=1;
				while($ligne=mysqli_fetch_object($resultat))
					{
					//premiere ligne visible
					$tab_resultats.="<tr>\n";	

						$tab_resultats.="<td><a href=\"#message".$i."\">".$ligne->nom_contact." ".$ligne->prenom_contact."</a></td>\n";
						$tab_resultats.="<td>".$ligne->date_contact."</td>\n";
						$tab_resultats.="<td>".$ligne->lu."</td>\n";
						$tab_resultats.="<td><a href=\"admin.php?action=suipprimer=message_id".$ligne->id_contact."\">
						<span class=\"dashicons dashicons-no-alt\"></span></a></td>\n";
						

					$tab_resultats.="</tr>\n";

					//deuxieme ligne visible si clic
					$tab_resultats.="<tr>\n";	

						$tab_resultats.="<td id=\"message".$i."\" colspan=\"4\">
										<strong>Expediteur : </strong>" . $ligne->mel_contact . "<br />";
						$tab_resultats.="<strong>Message</strong>
										<br />" . $ligne->message_contact . "</td>\n";

					$tab_resultats.="</tr>\n";
					
					$i++;
					}
			
			$tab_resultats.="</table>\n";
			
        break;		
        
        case "supprimer_message":
        
        break;
    }	
}
    
    
    ?>