<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {


    public function timeline(){

        //valida a auntenticacao
        $this->validaAunteticao();

        //recuperação dos tweets

        $tweet = Container::getModel('tweet');

        $tweet->__set('id_usuario', $_SESSION['id']);

        $tweets = $tweet->getAll();

        $this->view->tweets = $tweets;


        $usuario = Container::getModel('usuario');
        $usuario->__set('id', $_SESSION['id']);
        
        $this->view->info_usuario = $usuario->getInfoUsuario();
        $this->view->total_tweets = $usuario->getTotalTweets();
        $this->view->total_seguindo = $usuario->getTotalSeguindo();
        $this->view->total_seguidores = $usuario->getTotalSeguidores();

        $this->render('timeline');

        
    }


    public function tweet(){

        //valida a auntenticacao
        $this->validaAunteticao();


        $tweet = Container::getModel('tweet');

        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_usuario', $_SESSION['id']);

        $tweet->salvar();

        header('Location: /timeline');

        
    }


    public function validaAunteticao(){

        session_start();

        if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == ''){
            header('Location: /?login=erro');
        }
    }

    public function quemSeguir(){

        $this->validaAunteticao();

        $pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';

        $usuarios = array();

        $usuario = Container::getModel('usuario');
        $usuario->__set('id', $_SESSION['id']);

        if($pesquisarPor != "") {

            $usuario->__set('nome', $pesquisarPor);
           

            $usuarios = $usuario->getAll();

           

        }

        $this->view->info_usuario = $usuario->getInfoUsuario();
        $this->view->total_tweets = $usuario->getTotalTweets();
        $this->view->total_seguindo = $usuario->getTotalSeguindo();
        $this->view->total_seguidores = $usuario->getTotalSeguidores();
        


        $this->view->usuarios = $usuarios;

        $this->render('quemSeguir');

    }

    public function acao(){

        $this->validaAunteticao();

        $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
        $id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

        $usuario = Container::getModel('usuario');  
        $usuario->__set('id', $_SESSION['id']);


        if($acao == 'seguir'){
            $usuario->seguirUsuario($id_usuario_seguindo);
        } else if ($acao == 'deixar_de_seguir'){
            $usuario->deixarSeguirUsuario($id_usuario_seguindo);
        }

        header('Location: /quem-seguir');
    }

    public function deletarTweet(){

        self::validaAunteticao();

        $tweet = Container::getModel('tweet');
        $tweet->__set('id', $_GET['id']);
        $tweet->delete();
       
        header('Location: /timeline');
    }
}