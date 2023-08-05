<?php
switch ($_GET['acao']) {

  case 'grava_produto':
    
    $aux['esp_nome']    = addslashes(mb_strtoupper($_POST['esp_nome'], 'UTF-8'));
    $aux['esp_un_med']  = addslashes(mb_strtoupper($_POST['esp_un_med'], 'UTF-8'));
    $aux['est_cod']     = $_POST['est_cod'];

    $data->tabela = 'estabelecimento_produto';
    $data->add($aux);

    echo '<script>nextPage("?module=cadastro&acao=visualiza_estabelecimento&ms=1",'.$_POST['param_1'].');</script>';
    break;

  case 'update_produto':
    $aux['afr_cod'] = $_POST['afr_cod'];
    $aux['afr_descricao'] = mb_strtoupper($_POST['afr_descricao'],  'UTF-8');

    $data->tabela = 'estabelecimento_produto';
    $data->update($aux);

    echo '<script>window.location = "?module=cadastro&acao=lista_produto&ms=2";</script>';
    break;

  case 'inativar_produto':

    $sql = 'UPDATE estabelecimento_produto SET esp_situacao = 0 WHERE esp_cod = ' . $_POST['param_0'];
    $data->executaSQL($sql);

    echo '<script>nextPage("?module=cadastro&acao=visualiza_estabelecimento&ms=4",'.$_POST['param_1'].');</script>';
    break;

  case 'ativar_produto':
    $sql = 'UPDATE estabelecimento_produto SET esp_situacao = 1 WHERE esp_cod = ' . $_POST['param_0'];
    $data->executaSQL($sql);

    echo '<script>nextPage("?module=cadastro&acao=visualiza_estabelecimento&ms=5",'.$_POST['param_1'].');</script>';
    break;
}
