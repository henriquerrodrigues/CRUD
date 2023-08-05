<?php
    if (!isset($_SESSION)) {
        echo '<script>window.location="?module=index&acao=logout"</script>';
    }

    $sql = "SELECT cid_cod, cid_nome FROM cidade WHERE cid_situacao = 1";
    $cidade = $data->find('dynamic', $sql);

    $sql = "SELECT bazar_cod, bazar_titulo, bazar_responsavel FROM sim WHERE bazar_situacao = 1";
    $sim = $data->find('dynamic', $sql);
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-8">
        <h2>Forma de Atendimento</h2>
        <ol class="breadcrumb">
            <li>
                <a href="?module=cadastro&acao=lista_estabelecimento">Estabelecimento</a>
            </li>
            <li class="active">
                <strong>Novo</strong>
            </li>
        </ol>
    </div>

    <div class="col-lg-3 col-xs-4" style="text-align:right;">
        <br /><br />
        <button class="btn btn-primary" onclick="$('#MyForm').valid() ? enviar():'';" type="submit"><i class="fa fa-check"></i><span class="hidden-xs hidden-sm"> Salvar</span></button>
        <button class="btn btn-default" onclick="voltar();" type="button"><i class="fa fa-times"></i><span class="hidden-xs hidden-sm"> Cancelar</span></button>
    </div>
</div>
<div id="result_var"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Formulário de Cadastro</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="ibox-content">

            <form role="form" action="?module=cadastro&acao=grava_estabelecimento" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">

                <div class="row form-group">
                    <div class="col-sm-6">
                        <label class="control-label" for="est_nome">Nome:</label>
                        <input name="est_nome" type="text" class="form-control blockenter" id="est_nome" style="text-transform:uppercase;" required />
                    </div>

                    <div class="col-sm-3">
                        <label class="control-label" for="est_cnpj">CNPJ:</label>
                        <input name="est_cnpj" type="text" class="form-control blockenter" id="est_cnpj" style="text-transform:uppercase;" max-lenght="14" required />
                    </div>
                    <div class="col-sm-3">
                        <label for="cid_cod">Cidade:</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="cid_cod" name="cid_cod" required>
                            <option value="">-- Selecione --</option>
                            <?php
                                for ($i = 0; $i < count($cidade); $i++) {
                                    echo '<option value="' . $cidade[$i]['cid_cod'] . '">' . $cidade[$i]['cid_nome'] . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <?php if($_SESSION['bazar_userPermissao'] == 1){?>

                    <div class="row form-group">
                        <div class="col-sm-12">
                            <label for="cid_cod">SIM - (SERVIÇO DE INSPEÇÃO MUNICIPAL) responsável:</label>
                            <select class="form-control selectpicker" data-live-search="true" data-size="6" id="bazar_cod" name="bazar_cod" required>
                                <option value="">-- Selecione --</option>
                                <?php
                                    for ($i = 0; $i < count($sim); $i++) {
                                        echo '<option value="' . $sim[$i]['bazar_cod'] . '">' . $sim[$i]['bazar_titulo'] . ' - '.$sim[$i]['bazar_responsavel'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                <?php }?>
                    

                <div class="row form-group">
                    <div class="col-sm-12">
                        <label class="control-label" for="est_descricao">Descrição:</label>
                        <textarea name="est_descricao" type="text" class="form-control blockenter" id="est_descricao" style="text-transform:uppercase; height: 200px" required></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>


<script>
    function enviar() {
        document.forms['MyForm'].submit();
    }

    function voltar() {
        window.location.href = '?module=cadastro&acao=lista_estabelecimento';
    }

    $(document).ready(function() {
        $("#MyForm").submit(function(event) {
            document.forms['MyForm'].submit();
        });
        $("#est_cnpj").mask("99.999.999/9999-99");

    });
</script>