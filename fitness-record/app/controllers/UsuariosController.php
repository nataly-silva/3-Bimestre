<?php
use models\Usuario;
use models\Objetivos_Usuarios;
use models\Objetivos;
use models\Situacao;
use models\Logins;
/**
* Tutorial CRUD
* Autor:Alan Klinger 05/06/2017
*/

#A classe devera sempre iniciar com letra maiuscula
#terá sempre o mesmo nome do arquivo
#e precisa terminar com a palavra Controller
class UsuariosController {


		#construtor, é iniciado sempre que a classe é chamada
	function __construct() {
		#se nao existir é porque nao está logado
		if (!isset($_SESSION["user"])){
			redirect("autenticacao");
			die();
		}
		#proibe o usuário de entrar caso não tenha autorização
		if ($_SESSION['user']['tipo'] < Logins::ADMIN_USER){
			header("HTTP/1.1 401 Unauthorized");
			die();
		}
	}

	/**
	* Para acessar http://localhost/NOMEDOPROJETO/usuarios/index
	**/
	function index($id = null){

		#variáveis que serao passados para a view
		$send = [];

		#cria o model
		$model = new Usuario();
		$logs = new Logins();
		$situacao = new Situacao();
		$modelUseObj = new Objetivos_Usuarios();
		$modelObj = new Objetivos();

		#recupera a lista com todos os modelos
        $LoginsModel = new Logins();
        $send['logins'] = $LoginsModel->all();
		
		$send['data'] = null;
		#se for diferente de nulo é porque estou editando o registro
		if ($id != null) {
			// Buscar o registro do banco
			$result = [];
			$dataObj = $modelUseObj->all();
			foreach ($dataObj as $item) {
				if ($item['id_usuario'] == $id) {
					$obj_array = $modelObj->findById($item['id_objetivo'], "id");
					if (!isset($result['objetivo'])) {
						$result['objetivo'] = '';
					}
					$result['objetivo'] .= $obj_array['obj'] . ", ";
				}
			}
			
			$userData = $model->findById($id, "id");
			$send['data'] = array_merge($userData, $result);
		}
		
		$allusers = $model->all();
		$arr_data = [];
		foreach($allusers as $user){
			$obj = [];
			$count = 0;
			$dataObj = $modelUseObj->all();
			if(count($dataObj) == 0) $obj['objetivo'] = null;
			else
				foreach($dataObj as $chave=>$item){
					if($item['id_usuario'] == $user['id']){
						$obj_array = $modelObj->findById($item['id_objetivo'], "id");
						$obj['objetivo'] .= $obj_array['obj'].", ";
					}else if($chave == 2 && $count!=0){
						$obj['objetivo'] = " ";
					}else{
						$count++;
					}
				}
			$arr_data[]= array_merge($user, $obj);
		}
		#busca todos os registros
		// print_r($arr_data);
		$send['lista'] = $arr_data;
		$send['logins'] = $logs->all();
		$send['logId'] = $logs->all();
		$send['tiposSi'] = $situacao->all();

		#chama a view
		render("usuarios", $send);
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
		$modelUseObj->delete($id);
		redirect("usuarios/");
	}





}
