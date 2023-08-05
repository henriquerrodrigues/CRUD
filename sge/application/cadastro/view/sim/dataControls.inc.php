<?php
switch ($_GET['acao']) {

	case 'grava_sim':

		$aux['sim_responsavel']    	= addslashes(mb_strtoupper($_POST['sim_responsavel'], 'UTF-8'));
		$aux['sim_titulo']      	= addslashes(mb_strtoupper($_POST['sim_titulo'], 'UTF-8'));
		$aux['sim_telefone']      	= $_POST['sim_telefone'];
		$aux['sim_email']      		= $_POST['sim_email'];
		$aux['cid_cod']      		= $_POST['cid_cod'];

		$arquivo = $_FILES['sim_plano'];
		$local_arquivo = "arquivos/plano-de-servico/". date('Ymdhis') . $arquivo['name'];
		$moved = move_uploaded_file($arquivo['tmp_name'], $local_arquivo);

		$aux['sim_plano'] = '';
		if ($moved) {
			$aux['sim_plano'] = $local_arquivo;
		}

		$data->tabela = 'sim';
		$data->add($aux);

		echo '<script>window.location = "?module=cadastro&acao=lista_sim&ms=1";</script>';
		break;

	case 'update_sim':

		$aux['sim_cod']    			= $_POST['sim_cod'];
		$aux['sim_responsavel']    	= addslashes(mb_strtoupper($_POST['sim_responsavel'], 'UTF-8'));
		$aux['sim_telefone']      	= $_POST['sim_telefone'];
		$aux['sim_email']      		= $_POST['sim_email'];
		$aux['cid_cod']      		= $_POST['cid_cod'];

		$data->tabela = 'sim';
		$data->update($aux);

		echo '<script>window.location = "?module=cadastro&acao=lista_sim&ms=2";</script>';
		break;

	case 'inativar_sim':
		$sql = 'UPDATE sim SET sim_situacao = 0 WHERE sim_cod = ' . $_POST['param_0'];
		$data->executaSQL($sql);

		echo '<script>window.location = "?module=cadastro&acao=lista_sim&ms=5"</script>';
		break;

	case 'ativar_sim':
		$sql = 'UPDATE sim SET sim_situacao = 1 WHERE sim_cod = ' . $_POST['param_0'];
		$data->executaSQL($sql);

		echo '<script>window.location = "?module=cadastro&acao=lista_sim&ms=5"</script>';
		break;
}
