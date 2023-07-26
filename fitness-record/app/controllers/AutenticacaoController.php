<?php
use models\Logins;

class AutenticacaoController {

    function index(){
        #variáveis que serao passados para a view
        $send = [];
        #chama a view
        render("login", $send);
        $send['data'] = null;
    }
    function logar(){

        $model = new Logins();
        #busca o usuario pelo email e senha
        $user = $model->findByEmailAndSenha($_POST["email"],  $_POST["senha"]);
    
        if ($user != null){
            #se encontrar salva na sessao
            $_SESSION['user'] = $user;
            redirect("usuarios");
        } else {
            #caso contrario, manda para o login novamente
            $send = ["msg"=>"Login ou senha inválida"];
            render("login", $send);
        }
    }
    function logout(){
        session_destroy();
        redirect("autenticacao");
    }

    

}
