<?php
use models\Usuario;
use models\Objetivos_Usuarios;
use models\Objetivos;
use models\Situacao;
/**
* Tutorial CRUD
* Autor:Alan Klinger 05/06/2017
*/

#A classe devera sempre iniciar com letra maiuscula
#terá sempre o mesmo nome do arquivo
#e precisa terminar com a palavra Controller
class LoginController {

	/**
	* Para acessar http://localhost/NOMEDOPROJETO/usuarios/index
	**/
	function index($id = null){

		#variáveis que serao passados para a view
		$send = [];

		#cria o model

		$send['lista'] = $arr_data;
		$send['data'] = null;
		#chama a view
		render("login", $send);
	}

	
	function salvar($id=null){

		$model = new Usuario();
		$modelUseObj = new Objetivos_Usuarios();
		
		if ($id == null){
			$id = $model->save($_POST);
			foreach($_POST['obj'] as $item){
				$data = array(
					'id_usuario'=>$id,
					'id_objetivo'=>$item
				);
				$modelUseObj->save($data);
			}
		} else {
			$id = $model->update($id, $_POST, "id");

			$modelUseObj->delete($id, "id_usuario");

			foreach($_POST['obj'] as $item){
				$data = array(
					'id_usuario'=>$id,
					'id_objetivo'=>$item
				);
				$modelUseObj->save($data);
			}
		}
		
		redirect("usuarios/index/$id");
	}

	function deletar(int $id){
		
		$model = new Usuario();
		$modelUseObj = new Objetivos_Usuarios();
		$model->delete($id, "id");
		$modelUseObj->delete($id, "id_usuario");
		redirect("usuarios/index/");
	}


}
