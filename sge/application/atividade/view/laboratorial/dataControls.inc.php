<?php
switch ($_GET['acao']) {

	case 'grava_laboratorial':
		
		$aux['anl_mes'] 		= $_POST['anl_mes'];
		$aux['anl_ano'] 		= $_POST['anl_ano'];
		$aux['est_cod'] 		= $_POST['est_cod'];
		$aux['ren_cod'] 		= $_POST['ren_cod'];
		$aux['esp_cod']			= $_POST['esp_cod'];
		$aux['anl_tipo'] 		= $_POST['anl_tipo'];
		$aux['anl_resultado']	= $_POST['anl_resultado'];
		$aux['rnc_cod'] 		= $_POST['rnc_cod'];
		

		$data->tabela = 'analise_laboratorial';
		$data->add($aux);

		$id = $_POST['anl_mes'].','.$_POST['anl_ano'].','.$_POST['est_cod'];
		
		echo '<script>nextPage(\'?module=atividade&acao=lista\', \''.$id.'\')</script>';
	break;
	
}
