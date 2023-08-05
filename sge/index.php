<?php
	session_start();

	function meu_autoloader($nomeClasse) {
		
		// Caso não esteja atualizado um cookie, todos são atualizados com o valor atual da variável de sessão
		if(($_SESSION['bazar_userSession'] != $_COOKIE['bazar_userSession']) 	  ||
		($_SESSION['bazar_userId'] != $_COOKIE['bazar_userId'])	  ||
		($_SESSION['bazar_userName'] != $_COOKIE['bazar_userName']) ||
		($_SESSION['bazar_idSession'] != $_COOKIE['bazar_idSession']) || 
		($_SESSION['bazar_userPermissao'] != $_COOKIE['bazar_userPermissao'])){
			setcookie('bazar_userSession', $_SESSION['bazar_userSession'], $tempo_cookie);	
			setcookie('bazar_userId', $_SESSION['bazar_userId'], $tempo_cookie);	
			setcookie('bazar_userName', $_SESSION['bazar_userName'], $tempo_cookie);	
			setcookie('bazar_session', $_SESSION['bazar_session'], $tempo_cookie);	
			setcookie('bazar_idSession', $_SESSION['bazar_idSession'], $tempo_cookie);	
			setcookie('bazar_userPermissao', $_SESSION['bazar_userPermissao'], $tempo_cookie);	
		}

		if(!$_SESSION['bazar_userSession']){
		    // Para não perder sessão
		    $_SESSION['bazar_userId']         	= $_COOKIE['bazar_userId'];
			$_SESSION['bazar_userName']       	= $_COOKIE['bazar_userName'];
			$_SESSION['bazar_userSession']   		= $_COOKIE['bazar_userSession'];
			$_SESSION['bazar_userPermissao']  	= $_COOKIE['bazar_userPermissao'];
			$_SESSION['bazar_idSession']      	= $_COOKIE['bazar_idSession'];
			$_SESSION['bazar_userbazar'] 			= $_COOKIE['bazar_userbazar'];
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