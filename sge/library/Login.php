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
				$_SESSION['bazar_userId'] 			= $db->result($result, $i,'usu_cod');
				$_SESSION['bazar_userName'] 		= $db->result($result, $i,'usu_nome');	
				$_SESSION['bazar_userEmail'] 		= $db->result($result, $i,'usu_email');									
				$_SESSION['bazar_userPermissao'] 	= $db->result($result, $i,'upe_cod');
				$_SESSION['bazar_userCliente'] 		= $db->result($result, $i,'cli_cod');
				$_SESSION['bazar_userFuncionario']  = $db->result($result, $i,'fun_cod');
				$_SESSION['bazar_userSetor']  		= $db->result($result, $i,'set_cod');
				$_SESSION['bazar_userSession'] 		= $session;

				$retorno['login'] 	 = 'Logado';
				$retorno['nome'] 	 = $db->result($result, $i,'usu_nome');
				$retorno['mensagem'] = "Logado com Sucesso";

				
				// Cria um cookie com o usu�rio
				$tempo_cookie = strtotime("+2 day", time());
				setcookie('bazar_userId', $_SESSION['bazar_userId'], $tempo_cookie, "/");			
				setcookie('bazar_userName', $_SESSION['bazar_userName'], $tempo_cookie, "/");			
				setcookie('bazar_userEmail', $_SESSION['bazar_userEmail'], $tempo_cookie, "/");
				setcookie('bazar_userPermissao', $_SESSION['bazar_userPermissao'], $tempo_cookie, "/");
				setcookie('bazar_userCliente', $_SESSION['bazar_userCliente'], $tempo_cookie, "/");
				setcookie('bazar_userFuncionario', $_SESSION['bazar_userFuncionario'], $tempo_cookie, "/");
				setcookie('bazar_userSetor', $_SESSION['bazar_userSetor'], $tempo_cookie, "/");
				setcookie('bazar_userSession', $_SESSION['bazar_userSession'], $tempo_cookie, "/");				
				setcookie('bazar_idSession', $_SESSION['bazar_idSession'], $tempo_cookie, "/");	
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
		if ((isset($_SESSION['bazar_idSession']))&&($_SESSION['bazar_idSession'] == $_SESSION['bazar_userSession'])){
			$retorno['logged'] = "yes";
		}else{
			$retorno['logged'] = "no";
		}
		return $retorno;			
	}	
}

?>