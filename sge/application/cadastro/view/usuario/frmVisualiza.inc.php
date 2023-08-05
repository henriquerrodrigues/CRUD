<?php

    if(!isset($_SESSION) || $_SESSION['sim_userPermissao'] != 1){
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }

    $sql = "SELECT u.*, c.cid_nome, c.est_uf FROM usuario AS u INNER JOIN cidade as c WHERE usu_cod = ". $_POST['param_0'];
    $result = $data->find('dynamic', $sql);

    $sql = "SELECT * FROM usuario_permissao WHERE upe_situacao = 1";
    $cargos = $data->find('dynamic', $sql);
    
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-8">
        <h2>Usuário</h2>
        <ol class="breadcrumb">
            <li>
                <a href="?module=cadastro&acao=lista_usuario">Usuário</a>
            </li>
            <li class="active">
                <strong>Visualizar</strong>
            </li>
        </ol>
    </div>

    <div class="col-lg-3 col-xs-4" style="text-align:right;">
        <br /><br />
        <button class="btn btn-primary" onclick="voltar();" type="button"><i class="fa fa-arrow-left"></i><span class="hidden-xs hidden-sm"> Voltar</span></button>
    </div>
</div>
<div id="result_var"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Visualização</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="ibox-content">

            <form role="form" action="?module=cadastro&acao=visualiza_usuario" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">
                <input name="usu_cod" type="hidden" class="form-control blockenter" id="usu_cod" value="<?php echo $result[0]['usu_cod']; ?>" />

                <div class="row form-group">

                    <div class="col-sm-3">
                        <label class="control-label" for="usu_nome">Nome de Usuário:</label>
                        <input name="usu_nome" type="text" class="form-control blockenter" id="usu_nome" value="<?php echo $result[0]['usu_nome']; ?>" disabled />
                    </div>

                    <div class="col-sm-3">
                        <label class="control-label" for="usu_email">E-mail:</label>
                        <input name="usu_email" type="text" class="form-control blockenter" id="usu_mail" value="<?php echo $result[0]['usu_email']; ?>" disabled />
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label" for="usu_cod">Nível:</label> 
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="usu_permissao" name="upe_descricao" disabled>
                            <option value="">-- Selecione --</option>
                            <?php
                                for ($i = 0; $i < count($cargos); $i++) {
                                    if ($result[0]['upe_cod'] == $cargos[$i]['upe_cod']) {
                                        echo '<option value="' . $cargos[$i]['upe_cod'] . '" selected>' . $cargos[$i]['upe_descricao'] . '</option>';
                                    } else {
                                        echo '<option value="' . $cargos[$i]['upe_cod'] . '">' . $cargos[$i]['upe_descricao'] . '</option>';
                                    }
                                };
                            ?>

                        </select>
                    </div>
                    <div class="col-sm-3" id="cid_nome">
                        <label class="control-label" for="cid_nome">Cidade:</label>
                        <input name="cid_nome" type="text" class="form-control blockenter" id="cid_nome" value="<?php echo $result[0]['cid_nome'].' - '.$result[0]['est_uf']; ?>" disabled>
                    </div>
                 </div>
            </form>

        </div>
    </div>
</div>

<script>
    function enviar() {
        document.forms['MyForm'].submit();
    }

    function voltar() {
        window.location.href = '?module=cadastro&acao=lista_usuario';
    }

    $(document).ready(function() {
        $("#cli_cnpj").mask("99.999.999/9999-99");
        $("#cli_tel").mask("(99) 9999-9999?9");
        $("#cli_cep").mask("99999-999");


        $("#MyForm").submit(function(event) {
            document.forms['MyForm'].submit();
        });

        $("#editar_senha").click(function(event) {
            $("#usu_senha").removeAttr('disabled');
            $("#usu_senha").focus('');
            $("#usu_senha").val('');
            $("#usu_senha").attr('disabled');
        });
    });
</script>