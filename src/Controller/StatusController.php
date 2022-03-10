<?php

namespace App\Controller;

use App\Model\StatusModel;
use App\Controller\AbstractController;

class StatusController extends AbstractController
{
    public function index()
    {
        $statusModel = new StatusModel();

        $status = $statusModel->findAll();
        
        $this->render('status.php', [
            'status' => $status
        ]);
    }

    public function create()
    {
        $statusModel = new StatusModel();

        //ON RECUPERE LES DONNEES DU FORMULAIRE STATUS
        $Auteur_Status = $_POST['auteurStatus'];
        $Titre_Status = $_POST['titreStatus'];
        $Content_Status = $_POST['contenuStatus'];

        if (!empty($Auteur_Status)) {
            
            $statusModel = new StatusModel();
            $statusModel->create($Auteur_Status, $Titre_Status, $Content_Status);
        }
        header('Location:http://localhost/Eval_PHP_Twitter/');
        exit();
    }

    public function triTitre()
    {
        
        $statusModel = new StatusModel();
        $Titre_Status = $_POST['rechercheTitre'];

        if (!empty($Titre_Status)) {

            $statusModel = new StatusModel();
            $statusModel->triTitre($Titre_Status);
        }
        header('Location:http://localhost/Eval_PHP_Twitter/');
        exit();
    }
}
