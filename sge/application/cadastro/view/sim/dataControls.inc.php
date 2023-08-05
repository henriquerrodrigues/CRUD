<?php
switch ($_GET['acao']) {

	case 'grava_sim':

		$aux['bazar_responsavel']    	= addslashes(mb_strtoupper($_POST['bazar_responsavel'], 'UTF-8'));
		$aux['bazar_titulo']      	= addslashes(mb_strtoupper($_POST['bazar_titulo'], 'UTF-8'));
		$aux['bazar_telefone']      	= $_POST['bazar_telefone'];
		$aux['bazar_email']      		= $_POST['bazar_email'];
		$aux['cid_cod']      		= $_POST['cid_cod'];

		$arquivo = $_FILES['bazar_plano'];
		$local_arquivo = "arquivos/plano-de-servico/". date('Ymdhis') . $arquivo['name'];
		$moved = move_uploaded_file($arquivo['tmp_name'], $local_arquivo);

		$aux['bazar_plano'] = '';
		if ($moved) {
			$aux['bazar_plano'] = $local_arquivo;
		}

		$data->tabela = 'sim';
		$data->add($aux);

		echo '<script>window.location = "?module=cadastro&acao=lista_sim&ms=1";</script>';
		break;

	case 'update_sim':

		$aux['bazar_cod']    			= $_POST['bazar_cod'];
		$aux['bazar_responsavel']    	= addslashes(mb_strtoupper($_POST['bazar_responsavel'], 'UTF-8'));
		$aux['bazar_telefone']      	= $_POST['bazar_telefone'];
		$aux['bazar_email']      		= $_POST['bazar_email'];
		$aux['cid_cod']      		= $_POST['cid_cod'];

		$data->tabela = 'sim';
		$data->update($aux);

		echo '<script>window.location = "?module=cadastro&acao=lista_sim&ms=2";</script>';
		break;

	case 'inativar_sim':
		$sql = 'UPDATE sim SET bazar_situacao = 0 WHERE bazar_cod = ' . $_POST['param_0'];
		$data->executaSQL($sql);

		echo '<script>window.location = "?module=cadastro&acao=lista_sim&ms=5"</script>';
		break;

	case 'ativar_sim':
		$sql = 'UPDATE sim SET bazar_situacao = 1 WHERE bazar_cod = ' . $_POST['param_0'];
		$data->executaSQL($sql);

		echo '<script>window.location = "?module=cadastro&acao=lista_sim&ms=5"</script>';
		break;
}
