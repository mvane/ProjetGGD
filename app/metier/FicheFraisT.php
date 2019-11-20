<?php

namespace App\metier;

class FicheFraisT implements \JsonSerializable {

    private $idFrais;
    private $anneeMois;
    private $dateModification;
    private $montantValide;
    private $nbJustificatifs;
    private $idVisiteur;
    private $etat;

    public function getIdFrais() {
        return $this->idFrais;
    }

    public function setIdFrais($id)
    {
        $this->idFrais = $id;
    }
    public function getAnneeMois() {
        return $this->anneeMois;
    }

    public function setAnneeMois($anneeMois) {
        $this->anneeMois = $anneeMois;
    }

    public function getNbJustificatifs() {
        return $this->nbJustificatifs;
    }

    public function setNbJustificatifs($nbJustificatifs) {
        $this->nbJustificatifs = $nbJustificatifs;
    }

    public function getDateModification() {
        return $this->dateModification;
    }

    public function setDateModification($dateModification) {
        $this->dateModification = $dateModification;
    }

    public function getMontantValide() {
        return $this->montantValide;
    }

    public function setMontantValide($montantValide) {
        $this->montantValide = $montantValide;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function getIdVisteur() {
        return $this->idVisteur;
    }

    public function setIdVisiteur($idVisiteur) {
        $this->idVisiteur = $idVisiteur;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
