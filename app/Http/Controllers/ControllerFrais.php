<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/01/2019
 * Time: 14:10
 */

namespace App\Http\Controllers;

use App\dao\ServiceFrais;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\metier\FicheFraisT;
use App\metier\EtatT;
use App\Exceptions\MonException;
use Illuminate\Http\Request;


class ControllerFrais extends Controller
{

    // visualise les frais d'un visiteur
    public function getListeFicheFrais($id)
    {
        $listeFicheFrais = array();
        try {
            $unService = new ServiceFrais();
            $response = $unService->getListeFicheFrais($id);
            if ($response) {
                foreach ($response as $value) {
                    $ficheFrais = new FicheFraisT();
                    $ficheFrais->setIdFrais((int)$value->id_frais);
                    $ficheFrais->setAnneeMois((string)$value->anneemois);
                    $ficheFrais->setIdVisiteur((int)$value->id_visiteur);
                    $ficheFrais->setNbJustificatifs((string)$value->nbjustificatifs);
                    $ficheFrais->setDateModification($value->datemodification);
                    $ficheFrais->setMontantValide((double)$value->montantvalide);
                    $unEtat = new EtatT();
                    $unEtat->setIdEtat((int)$value->id_etat);
                    $unEtat->setLibEtat($value->lib_etat);
                    $ficheFrais->setEtat($unEtat);
                    $listeFicheFrais[]=$ficheFrais;
                }
            }
            return json_encode($listeFicheFrais);
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }


    // visualise les frais selon les montants
    // en mode path
    public function getListeFicheFraisMontant($v1,$v2)
    {
        $listeFicheFrais = array();
        try {
            $unService = new ServiceFrais();
            $response = $unService->getListeFicheFraisMontant($v1,$v2);
            if ($response) {
                foreach ($response as $value) {
                    $ficheFrais = new FicheFraisT();
                    $ficheFrais->setIdFrais((int)$value->id_frais);
                    $ficheFrais->setAnneeMois((string)$value->anneemois);
                    $ficheFrais->setIdVisiteur((int)$value->id_visiteur);
                    $ficheFrais->setNbJustificatifs((string)$value->nbjustificatifs);
                    $ficheFrais->setDateModification($value->datemodification);
                    $ficheFrais->setMontantValide((double)$value->montantvalide);
                    $unEtat = new EtatT();
                    $unEtat->setIdEtat((int)$value->id_etat);
                    $unEtat->setLibEtat($value->lib_etat);
                    $ficheFrais->setEtat($unEtat);
                    $listeFicheFrais[]=$ficheFrais;
                }
            }
            return json_encode($listeFicheFrais);
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

    // visualise les frais selon les montants
    // en mode query
    public function getListeFicheFraisMontantQuery(Request $req)
    {
        $v1=$req->input('valeur1');
        $v2=$req->input('valeur2');
        $listeFicheFrais = array();
        try {
            $unService = new ServiceFrais();
            $response = $unService->getListeFicheFraisMontant($v1,$v2);
            if ($response) {
                foreach ($response as $value) {
                    $ficheFrais = new FicheFraisT();
                    $ficheFrais->setIdFrais((int)$value->id_frais);
                    $ficheFrais->setAnneeMois((string)$value->anneemois);
                    $ficheFrais->setIdVisiteur((int)$value->id_visiteur);
                    $ficheFrais->setNbJustificatifs((string)$value->nbjustificatifs);
                    $ficheFrais->setDateModification($value->datemodification);
                    $ficheFrais->setMontantValide((double)$value->montantvalide);
                    $unEtat = new EtatT();
                    $unEtat->setIdEtat((int)$value->id_etat);
                    $unEtat->setLibEtat($value->lib_etat);
                    $ficheFrais->setEtat($unEtat);
                    $listeFicheFrais[]=$ficheFrais;
                }
            }
            return json_encode($listeFicheFrais);
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }


    // visualise les frais d'une période d'un visiteur
    public function getListeFraisPeriode($id)
    {
        try {
            $unService = new ServiceFrais();
            $response = $unService->getFrais($id);
            return response()->json($response);
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

// visualise les frais d'une période d'un visiteur
    public function getUnFrais($id)
    {
        try {
            $unService = new ServiceFrais();
            $response = $unService->getUnFrais($id);
            if ($response) {
                    $ficheFrais = new FicheFraisT();
                    $ficheFrais->setIdFrais((int)$response->id_frais);
                    $ficheFrais->setAnneeMois($response->anneemois);
                    $ficheFrais->setIdVisiteur((int)$response->id_visiteur);
                    $ficheFrais->setNbJustificatifs((string)$response->nbjustificatifs);
                    $ficheFrais->setDateModification($response->datemodification);
                    $ficheFrais->setMontantValide((double)$response->montantvalide);
                    $unEtat = new EtatT();
                    $unEtat->setIdEtat((int)$response->id_etat);
                    $unEtat->setLibEtat($response->lib_etat);
                    $ficheFrais->setEtat($unEtat);

                }

            return json_encode($ficheFrais);

        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

    /**
     * modifie  un  frais
     * @param type $json
     * @return \
     * @throws Exception
     */
    public function updateFicheFrais()
    {
        try {
            $json = file_get_contents('php://input'); // Récupération du flux JSON
            $fraisJson = json_decode($json);
            if ($fraisJson != null) {
                $idfrais = $fraisJson->id;
                $anneeMois = $fraisJson->anneemois;
                $dateModification = $fraisJson->dateModification;
                $montantValide = $fraisJson->montantValide;
                $nbJustificatifs = $fraisJson->nbJustificatifs;
                $idVisiteur = $fraisJson->idVisiteur;
                $idetat = $fraisJson->etat->idEtat;
                $unService = new ServiceFrais();
                $uneReponse = $unService->updateFrais($idfrais,$anneeMois, $dateModification,
                    $montantValide,$nbJustificatifs, $idVisiteur, $idetat);
                return response()->json($uneReponse);
            }
        } catch(MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

    /**
     * ajoute un nouveau  frais
     * @param type $json
     * @return \
     * @throws Exception
     */
    public function addFicheFrais()
    {
        try {
            $json = file_get_contents('php://input'); // Récupération du flux JSON
            $fraisJson = json_decode($json);
            if ($fraisJson != null) {
                $anneeMois = $fraisJson->anneeMois;
                $dateModification = $fraisJson->dateModification;
                $montantValide = $fraisJson->montantValide;
                $nbJustificatifs = $fraisJson->nbJustificatifs;
                $idVisiteur = $fraisJson->idVisiteur;
                $etat = $fraisJson->etat->idEtat;
                $unService = new ServiceFrais();
                $uneReponse = $unService->insertFrais($anneeMois, $dateModification,
                    $montantValide,
                    $nbJustificatifs, $idVisiteur, $etat);
                return response()->json($uneReponse);
            }
        } catch(MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }



    /**
     * supprime un frais
     * @param type $json
     * @return \
     * @throws Exception
     */
    public function suppressionFrais()
    {
        try {
            $json = file_get_contents('php://input'); // Récupération du flux JSON
            $fraisJson = json_decode($json);
            if ($fraisJson != null) {
                $idfrais = $fraisJson->id;
                $unService = new ServiceFrais();
                $uneReponse = $unService->deleteFrais($idfrais);
                return response()->json($uneReponse);
            }
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

    /**
     * Frais par visiteur
     * @param type $json
     * @return \
     * @throws Exception
     */

    public function getListeFraisVisiteur($seuil)
    {
        $listeItems = array();
        try {
            $unService = new ServiceFrais();
            $response = $unService->getNbFraisParVisiteur($seuil);
            foreach ($response as $value) {
               $item = array();
                $item["id_visiteur"] = $value->id_visiteur;
                $item["nom_visiteur"] = (string)$value->nom_visiteur;
                $item["nb"] = $value->nb;
                $listeItems[] = $item;
            }

            return json_encode($listeItems);
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }


    public function getVisiteurFraisMax()
    {
        try {
            $unService = new ServiceFrais();
            $response = $unService->getVisiteurFraisMax();
           return json_encode($response);
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }
}