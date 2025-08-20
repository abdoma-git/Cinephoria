<?php

    class Voiture{

        private $modele;
        private $km;
        private $couleur;

        public function __construct($a, $b, $c){
            $this->modele = $a;
            $this->km = $b;
            $this->couleur = $c;
        }


        public function getModele(){
            print($this->modele);
        }

        public function setModele($modele){
            $this->modele = $modele;
        }

        public function setCouleur($couleur){
            $this->couleur = $couleur;
        }


        public function afficherVoiture(){
            print('La voiture dont le modele est '.$this->modele.' a '.$this->km.' km et de couleur '.$this->couleur.'');
        }

    }
?>