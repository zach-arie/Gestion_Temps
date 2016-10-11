<?php
//cOeuvre.class.php
// permettre la gestion des données des compositions
class cOeuvre{

	public $Oeuvre;
	public $Titre;
	public $Compositeur;
	public $DateComposition;
	public $JusteAnnee;
	public $RefCatal;
	public $Opus;
	public $TypeOpus;
	Public $TypeOeuvre;
	public $Niveau;
	
	public function __construtor(){
		$this->Oeuvre=0;
	}
	
	public function fct_coeuvre_lire($mysqli, $NumOeuvre){
	// lire une oeuvre
		$requete="SELECT * FROM Oeuvre WHERE Oeu_Id=".$NumOeuvre.";";
		$resultat=mysqli_query($mysqli,$requete);
		$OeuvreIdentifie=false;
		if (mysqli_num_rows($resultat)==1){ 
			$Enrgt = mysqli_fetch_assoc($resultat) ;
			$this->Oeuvre=$Enrgt['Oeu_Id'];
			$this->CompositeurVal=$Enrgt['Oeu_Compositeur'];
			$this->Titre=$Enrgt['Oeu_Titre'];
			$this->Opus=$Enrgt['Oeu_Opus'];
			$this->TypeOpus=$Enrgt['Oeu_Opus'];
			$this->DateComposition=$Enrgt['Oeu_Annee'];
			$this->JusteAnnee=$Enrgt['Oeu_JusteAnnee'];
			$this->RefCatal=$Enrgt['Oeu_Ref_Catalogue'];
			$this->TypeOeuvre=$Enrgt['Oeu_Type'];
			$this->Niveau=$Enrgt['Oeu_Niveau'];
			$OeuvreIdentifie=true;
		}
		mysqli_free_result($resultat);
		return $OeuvreIdentifie;
	}
	public function fct_coeuvre_inserer($mysqli){
		// Insérer ou Mettre à jour l'oeuvre en cours
		$OeuvreIdentifie=false;
		if ($this->Oeuvre==0){
			$requete="INSERT INTO Oeuvre (Oeu_Compositeur, Oeu_Opus,Oeu_Annee, Oeu_JusteAnnee, Oeu_Type_Opus, 
			                              Oeu_Titre, Oeu_Ref_Catalogue, Oeu_Type, Oeu_Niveau) 
						     VALUES ('".$this->Compositeur."','".$this->Opus."','"
									 .$this->DateComposition."','".$this->JusteAnnee."',".$this->TypeOpus.",'".$this->Titre."','"
									 .$this->RefCatal."',".$this->TypeOeuvre.",".$this->Niveau.")" ;
                        $resultat=mysqli_query($mysqli,$requete);
			if ($resultat){
				$this->Oeuvre=mysqli_insert_id();
				$OeuvreIdentifie=true;
			} else {
				$this->Oeuvre=0;
			}
			mysqli_free_result($resultat);
		} else {
			//on fait une mise à jour
			$requete="UPDATE Oeuvre set Oeu_Compositeur='".$this->Compositeur."', Oeu_Opus='".$this->JusteAnnee.
					 "', Oeu_Annee='".$this->DateComposition."',Oeu_JusteAnnee='".$this->JusteAnnee.
					 "', Oeu_Type_Opus=".$this->Opus.",Oeu_Titre='".$this->Titre."',Oeu_Ref_Catalogue='".$this->RefCatal.
					 "', Oeu_Type=".$this->TypeOeuvre.", Oeu_Niveau=".$this->Niveau." WHERE Oeu_Id=".$this->Oeuvre;
			$resultat=mysqli_query($mysqli,$requete);
                        if ($resultat){
				$OeuvreIdentifie=true;
			} else {
				$this->Oeuvre=0;
			}
			mysqli_free_result($resultat);
		}
		
		return $OeuvreIdentifie;
	}
	
	public function fct_coeuvre_verifier(){
		if ($this->JusteAnnee=="O"){
			
		}
		if (len($this->Titre)>0 AND len($this->Compositeur)>0){
			return true;
		} else {
			return false;
		}
	}
}