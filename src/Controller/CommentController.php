<?php

namespace App\Controller;

use App\Model\StatusModel;
use App\Model\CommentModel; 
use App\Controller\AbstractController;

class CommentController extends AbstractController
{
    public function index()
    {   
        $id = $_GET['id'];
        
        $statusModel = new StatusModel();
        $commentModel = new CommentModel();

        $comments = $commentModel->findByStatus($id);
        $status = $statusModel->findById($id);

        $this->render('comment.php', [
            'comments' => $comments,
            'status' => $status
        ]);
    }

    public function create()
    {
        $commentModel = new commentModel();

        //ON RECUPERE LES DONNEES DU FORMULAIRE DE COMMENTAIRE
        $Auteur_Comment = $_POST['auteurComment'];
        $Content_Comment = $_POST['contenuComment'];
        $Id_Status = $_POST['idStatus'];

        if (!empty($Auteur_Comment)) {
            //CREATION D UN COMMENTAIRE
            $commentModel = new commentModel();
            $commentModel->create($Auteur_Comment, $Content_Comment, $Id_Status);
        }
        header('Location:http://localhost/Eval_PHP_Twitter/?page=comment&id='.$Id_Status);
        exit();
    }
}

