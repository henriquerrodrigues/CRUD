<?php
switch ($_GET['acao']) {

  case 'grava_aviso':

    $aux['avi_titulo']        = addslashes(mb_strtoupper($_POST['avi_titulo'], 'UTF-8'));
    $aux['avi_data']          = $_POST['avi_data'];
    $aux['avi_descricao']     = addslashes(mb_strtoupper($_POST['avi_descricao'], 'UTF-8'));
    $aux['usu_cod']           = $_SESSION['sim_userId'];

    //gravando dados do cliente
    $data->tabela = 'aviso';
    $data->add($aux);

    echo '<script>window.location = "?module=dashboard&acao=lista&ms=1";</script>';
    break;

  case 'update_cliente':
    
    $aux['cli_cod']             = $_POST['cli_cod'];
    $aux['cli_nome']            = addslashes(mb_strtoupper($_POST['cli_nome'], 'UTF-8'));
    $aux['cli_cnpj']            = $_POST['cli_cnpj'];
    $aux['cli_tel']             = $_POST['cli_tel'];
    $aux['cli_mail']            = $_POST['cli_mail'];
    $aux['cli_endereco']        = addslashes(mb_strtoupper($_POST['cli_endereco'], 'UTF-8'));
    $aux['cli_nro_endereco']    = $_POST['cli_nro_endereco'];
    $aux['cli_bairro']          = addslashes(mb_strtoupper($_POST['cli_bairro'], 'UTF-8'));
    $aux['cli_cep']             = $_POST['cli_cep'];
    $aux['cid_cod']             = $_POST['cid_cod'];
    $aux['usu_cod']             = $_SESSION['sim_userId'];

    $data->tabela = 'cliente';
    $data->update($aux);

    echo '<script>window.location = "?module=cadastro&acao=lista_cliente&ms=2";</script>';
    break;

  case 'inativar_cliente':
    $sql = 'UPDATE cliente SET cli_situacao = 0 WHERE cli_cod = ' . $_POST['param_0'];
    $data->executaSQL($sql);

    $sql = 'UPDATE usuario SET usu_situacao = 0 WHERE usu_cod = ' . $_POST['param_0'];
    $data->executaSQL($sql);
    echo '<script>window.location = "?module=cadastro&acao=lista_cliente&ms=4";</script>';
    break;


  case 'ativar_cliente':
    $sql = 'UPDATE cliente SET cli_situacao = 1 WHERE cli_cod = ' . $_POST['param_0'];
    $data->executaSQL($sql);

    $sql = 'UPDATE usuario SET usu_situacao = 1 WHERE usu_cod = ' . $_POST['param_0'];
    $data->executaSQL($sql);
    echo '<script>window.location = "?module=cadastro&acao=lista_cliente&ms=4";</script>';
    break;
}
