<?php
namespace App\metier;
class EtatT implements \JsonSerializable
{
    private $idEtat;
    private $libEtat;

    public function getIdEtat() {
        return $this->idEtat;
    }

    public function setIdEtat($id) {
        $this->idEtat = $id;
    }

    public function getLibEtat() {
        return $this->libEtat;
    }

    public function setLibEtat($libEtat) {
        $this->libEtat = $libEtat;
    }


    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}