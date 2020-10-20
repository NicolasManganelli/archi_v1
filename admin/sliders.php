<?php
if(isset($_SESSION['id_compte']))
	{
	if(isset($_GET['action']))
		{
		switch($_GET['action'])
			{
			case "afficher_sliders":
			$entete="<h1>Gestion du slider</h1>";
			$action_form="afficher_sliders";
			//2. on insert les champs dans la table slider (modele : front.php)
			if(isset($_POST['submit'])){
        if(empty($_POST['titre_slider'])){
          $message="<label class=\"pas_ok\">Mettez votre titre</label>";	
          $color['titre_slider']="class=\"avertissement\" ";
        }elseif(empty($_FILES['fichier_slider']['name'])){
          $message="<label class=\"pas_ok\">Téléchargez l'image</label>";	
          $color['fichier_slider']="class=\"avertissement\" ";
        }else{

          // On test si le fichier a le bon format.
          if (fichier_type($_FILES['fichier_slider']['name'])=="png" ||
            fichier_type($_FILES['fichier_slider']['name'])=="jpg" || 
            fichier_type($_FILES['fichier_slider']['name'])=="gif") {

              //  On insere ds la table sliders les champs autre que "Files"
              $requete="INSERT INTO sliders
              SET titre_slider='" . addslashes($_POST['titre_slider']). "',
                  descriptif_slider='" .addslashes($_POST['descriptif_slider']). "'";
            $resultat=mysqli_query($connexion, $requete);
            $dernier_id_cree=mysqli_insert_id($connexion);


            // On génère les 2 chemins des fichiers images : le big et le small
            $chemin_b="../medias/slider_b" .$dernier_id_cree ."." .fichier_type($_FILES['fichier_slider']['name']);
            $chemin_s="../medias/slider_s" .$dernier_id_cree ."." .fichier_type($_FILES['fichier_slider']['name']);

            // tmp_name correspond au nom temporaire donné au fichier lors de sa copie
            if(is_uploaded_file($_FILES['fichier_slider']['tmp_name'])) {
              if(copy($_FILES['fichier_slider']['tmp_name'], $chemin_b)) {
                  // On calcul les dimensions de l'image d'origine
                  $size = getimagesize($chemin_b);
                  $largeur = $size[0];
                  $hauteur = $size[1];
                  $rapport = $largeur / $hauteur;
                  // Si $rapport>1 alors image paysage
                  // Si $rapport<1 alors image portrait
                  // Si $rapport>1 alors image carrée

                  //On génère une miniature en respectantl'homothétie.
                  $largeur_mini = 100;
                  $quality = 80;
                  redimage($chemin_b, $chemin_s, $largeur, $largeur / $rapport, $quality);

                  // On met à jour la table sliders avec le chemin du fichier
                  $requete2 = "UPDATE sliders SET fichier_slider='" . $chemin_s . "' WHERE id_slider='" . $dernier_id_cree . "'";
                  $resultat2 = mysqli_query($connexion, $requete2);
                  $message = "<label class=\"pas_ok\">Fichier inséré</label>";	
              }
            }

            }else{
              $message="<label class=\"pas_ok\">Seules les extensions png, jpg, gif</label>";	
              $color['fichier_slider']="class=\"avertissement\" ";
            }
            
        
      }	
			break;






    }
			case "modifier_slider":
			
			//si qq valide le formulaire (appui sur le bouton ENVOYER)
			if(isset($_POST['submit'])){

      }
      
      if(isset($_GET['id_slider'])){
        $action_form="modifier_slider&id_slider=" . $_GET['id_slider'];
      }
      break;

  




			
			case "supprimer_slider":
        if(isset($_GET['id_slider']))
          {
          $entete="<h1 class=\"ouinon\">Vous-voulez vraiment supprimer ce slider ? 
          <a href=\"admin.php?module=sliders&action=supprimer_slider&id_slider=" .$_GET['id_slider']."&confirm=1\">OUI</a>
          <a href=\"admin.php?module=sliders&action=afficher_sliders\">NON</a>
          </h1>";
          
          //si l'internaute à confirmer la suppression (bouton oui)
          if(isset($_GET['confirm']) && $_GET['confirm']==1){

          }
        }
        break;		
        }
			
		$requete="SELECT * FROM sliders ORDER BY id_slider";
		$tab_resultats=afficher_sliders($connexion,$requete);
		}
	}
else{
	header("Location:../index.php");	
	}
