<?php
use models\Usuario;
use models\Logins;
/**
* Tutorial CRUD
* Autor:Alan Klinger 05/06/2017
*/

#A classe devera sempre iniciar com letra maiuscula
#terá sempre o mesmo nome do arquivo
#e precisa terminar com a palavra Controller
class RegistroController {

	/**
	* Para acessar http://localhost/NOMEDOPROJETO/usuarios/index
	**/
	function index($id = null){

		#variáveis que serao passados para a view
		$send = [];
		$send['data'] = null;
		
		#$send['tipoUser'] = [0=>"Escolha uma opção", 1=>"Usuário comum", 2=>"Admin"];
		$send['tipoUser'] = Logins::$userTypes;
		
		#chama a view
		render("registro", $send);
	}

	function salvar($id=null){
		$model = new Logins();
		#validacao
		$requeridos = ["nome"=>"Nome é obrigatório",
		"dataNascimento"=>"Data de nascimento é obrigatória",
		"email"=>"email é obrigatório",
		"senha"=>"senha é obrigatório"];
		foreach($requeridos as $field=>$msg){
			#verifica se o campo está vazio
			if (!validateRequired($_POST,$field)){
				setValidationError($field, $msg);
			}
		}
		#valida a data
		if (!validateDate(_v($_POST,"dataNascimento"),"d/m/Y")){
			setValidationError("dataNascimento", "Tem que ser uma data válida no formato dd/mm/yyyy");
		}
		#se alguma validação tiver falhado
		if (count($_SESSION['errors'])){
			setFlash("error","Falha ao salvar usuário.");
			#volta para a página que estava
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			die();
		}


		$id = $model->save($_POST);	
		setFlash("success","Salvo com sucesso.");
		redirect("login/");
	}


}
