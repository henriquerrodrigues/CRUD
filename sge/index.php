<?php
	session_start();

	function meu_autoloader($nomeClasse) {
		
		// Caso não esteja atualizado um cookie, todos são atualizados com o valor atual da variável de sessão
		if(($_SESSION['sim_userSession'] != $_COOKIE['sim_userSession']) 	  ||
		($_SESSION['sim_userId'] != $_COOKIE['sim_userId'])	  ||
		($_SESSION['sim_userName'] != $_COOKIE['sim_userName']) ||
		($_SESSION['sim_idSession'] != $_COOKIE['sim_idSession']) || 
		($_SESSION['sim_userPermissao'] != $_COOKIE['sim_userPermissao'])){
			setcookie('sim_userSession', $_SESSION['sim_userSession'], $tempo_cookie);	
			setcookie('sim_userId', $_SESSION['sim_userId'], $tempo_cookie);	
			setcookie('sim_userName', $_SESSION['sim_userName'], $tempo_cookie);	
			setcookie('sim_session', $_SESSION['sim_session'], $tempo_cookie);	
			setcookie('sim_idSession', $_SESSION['sim_idSession'], $tempo_cookie);	
			setcookie('sim_userPermissao', $_SESSION['sim_userPermissao'], $tempo_cookie);	
			setcookie('sim_userSim', $_SESSION['sim_userSim'], $tempo_cookie);	
		}

		if(!$_SESSION['sim_userSession']){
		    // Para não perder sessão
		    $_SESSION['sim_userId']         	= $_COOKIE['sim_userId'];
			$_SESSION['sim_userName']       	= $_COOKIE['sim_userName'];
			$_SESSION['sim_userSession']   		= $_COOKIE['sim_userSession'];
			$_SESSION['sim_userPermissao']  	= $_COOKIE['sim_userPermissao'];
			$_SESSION['sim_idSession']      	= $_COOKIE['sim_idSession'];
			$_SESSION['sim_userSim'] 			= $_COOKIE['sim_userSim'];
		}
		require_once 'library/'.implode('/',explode('_',$nomeClasse)).'.php';
	}

	spl_autoload_register('meu_autoloader');

	try {
	    $factory = new Command_Factory();
	    $factory->createCommand()->execute();
	} catch (Exception_Pagenotfound $ep) {
	    echo '<h1>ERRO 404 - Página não encontrada</h1>';
	} catch (Exception $e) {
	    echo '<h1>ERRO 500 - Erro na execução</h1>';
	}
?>