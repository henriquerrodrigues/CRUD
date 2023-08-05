<?php
switch ($_GET['acao']) {

  case 'grava_estabelecimento':

    $aux['est_nome']        = addslashes(mb_strtoupper($_POST['est_nome']));
    $aux['est_cnpj']        = $_POST['est_cnpj'];
    $aux['cid_cod']         = $_POST['cid_cod'];
    $aux['sim_cod']         = $_POST['sim_cod'];
    $aux['est_descricao']   = addslashes(mb_strtoupper($_POST['est_descricao']));

    $data->tabela = 'estabelecimento';
    $data->add($aux);

    echo '<script>window.location = "?module=cadastro&acao=lista_estabelecimento&ms=1";</script>';
  break;

  case 'update_estabelecimento':
    $aux['est_cod']         = $_POST['est_cod'];
    $aux['est_nome']        = addslashes(mb_strtoupper($_POST['est_nome']));
    $aux['est_cnpj']        = $_POST['est_cnpj'];
    $aux['cid_cod']         = $_POST['cid_cod'];
    $aux['est_descricao']   = addslashes(mb_strtoupper($_POST['est_descricao']));

    $data->tabela = 'estabelecimento';
    $data->update($aux);

    echo '<script>window.location = "?module=cadastro&acao=lista_estabelecimento&ms=2";</script>';
  break;

  case 'inativar_estabelecimento':
    $sql = 'UPDATE estabelecimento SET est_situacao = 0 WHERE est_cod = ' . $_POST['param_0'];
    $data->executaSQL($sql);

    echo '<script>window.location = "?module=cadastro&acao=lista_estabelecimento&ms=4";</script>';
  break;

  case 'ativar_estabelecimento':
    $sql = 'UPDATE estabelecimento SET est_situacao = 1 WHERE est_cod = ' . $_POST['param_0'];
    $data->executaSQL($sql);

    echo '<script>window.location = "?module=cadastro&acao=lista_estabelecimento&ms=5";</script>';
  break;
}
