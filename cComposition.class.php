<?php
//cComposition.class.php
// permettre la gestion des données des compositions
class cComposition{
    
	public $NumOrdre;
	public $Titre;
	public $SousTitre;
	public $Ton;
	public $TonVal;
	public $Mod;
	public $ModVal;
	
	public function fct_ccomposition_tostring (){
		$ChaineRetour=trim($this->NumOrdre).";".trim($this->Titre).";".trim($this->SousTitre).
                        ";".$this->Ton.";".$this->ValTon.";".$this->Mod.";".$this->ValMod;
                return $ChaineRetour;
	}
	public function fct_ccomposition_unstring ($chaine){
	    if (strlen($chaine)>0){
			list($this->NumOrdre, $this->Titre, $this->SousTitre, $this->Ton,$this->ValTon, $this->Mod,$this->ValMod)=
				split(";",$chaine);
			return true;
		} else { 
		return false;
		}
	}
	public function fct_ccomposition_verifier(){
		if (len($this->NumOrdre)>0 AND len($this->Titre)>0){
			return true;
		} else {
			return false;
		}
	}
	public function fct_ccomposition_inserer($mysqli,$Oeuvre_Id){
		$CompoInsere=false;
		if ($Oeuvre_Id>0){
			$requete="INSERT INTO Composition (Cms_Oeuvre, Cms_Ordre,Cms_Titre_Mvt, Cms_Ton,Cms_Mode, Cms_Titre)
						     VALUES (".$Oeuvre_Id.",'".$this->NumOrdre."','"
									 .$this->SousTitre."',".$this->Ton.",".$this->Mod.",'".$this->Titre."')" ;
			if (mysqli_query($mysqli,$requete)){
				$CompoInsere=true;
			} else {
				$this->Oeuvre=0;
			}
			mysqli_free_result($requete);
		}
		return $CompoInsere;
	}
	
}