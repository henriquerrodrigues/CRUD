<?php
class Login{	
	var $table;
	
	function validateUser($params, $session){
		if(!isset($_SESSION)){
			session_start();
    	}
		$db = new MySql();
		
		$i = 0;
		foreach($params as $key => $valor){
			if($i == 0){
				$conditions = $key." = '".$valor."'";
				$i++;
			}else{
				$conditions .= " AND ".$key." = '".$valor."'";
			}  
		}
		$sql = "SELECT * FROM ".$this->table." WHERE usu_situacao = 1 AND ".$conditions;
		$result = $db->executeQuery($sql,false);

		if ($db->countLines($result) > 0){
			for ($i=0;$i<$db->countLines($result);$i++){
				$_SESSION['sim_userId'] 			= $db->result($result, $i,'usu_cod');
				$_SESSION['sim_userName'] 		= $db->result($result, $i,'usu_nome');	
				$_SESSION['sim_userEmail'] 		= $db->result($result, $i,'usu_email');									
				$_SESSION['sim_userPermissao'] 	= $db->result($result, $i,'upe_cod');
				$_SESSION['sim_userCliente'] 		= $db->result($result, $i,'cli_cod');
				$_SESSION['sim_userFuncionario']  = $db->result($result, $i,'fun_cod');
				$_SESSION['sim_userSetor']  		= $db->result($result, $i,'set_cod');
				$_SESSION['sim_userSession'] 		= $session;

				$retorno['login'] 	 = 'Logado';
				$retorno['nome'] 	 = $db->result($result, $i,'usu_nome');
				$retorno['mensagem'] = "Logado com Sucesso";

				
				// Cria um cookie com o usu�rio
				$tempo_cookie = strtotime("+2 day", time());
				setcookie('sim_userId', $_SESSION['sim_userId'], $tempo_cookie, "/");			
				setcookie('sim_userName', $_SESSION['sim_userName'], $tempo_cookie, "/");			
				setcookie('sim_userEmail', $_SESSION['sim_userEmail'], $tempo_cookie, "/");
				setcookie('sim_userPermissao', $_SESSION['sim_userPermissao'], $tempo_cookie, "/");
				setcookie('sim_userCliente', $_SESSION['sim_userCliente'], $tempo_cookie, "/");
				setcookie('sim_userFuncionario', $_SESSION['sim_userFuncionario'], $tempo_cookie, "/");
				setcookie('sim_userSetor', $_SESSION['sim_userSetor'], $tempo_cookie, "/");
				setcookie('sim_userSession', $_SESSION['sim_userSession'], $tempo_cookie, "/");				
				setcookie('sim_idSession', $_SESSION['sim_idSession'], $tempo_cookie, "/");	
			}
		}else{
			$retorno['login'] 	 = "falha";
			$retorno['mensagem'] = "Senha e/ou login invalido";				
		}
		return $retorno;			
	}

	function logout(){
		unset($_SESSION);
		session_destroy();

	}
	
	function getLogin(){
		if ((isset($_SESSION['sim_idSession']))&&($_SESSION['sim_idSession'] == $_SESSION['sim_userSession'])){
			$retorno['logged'] = "yes";
		}else{
			$retorno['logged'] = "no";
		}
		return $retorno;			
	}	
}

?>