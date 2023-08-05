<?php
    if(!isset($_SESSION))   {
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }

    date_default_timezone_set('America/Sao_Paulo');

    $sql = "SELECT est_cod, est_nome FROM estabelecimento WHERE est_situacao = 1;";
    $estab = $data->find('dynamic', $sql);

?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-8">
        <h2>Atividade</h2>
        <ol class="breadcrumb">
            <li>
                Filtro de lançamentos
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
            <h5>Formulário de Filtro</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="ibox-content">

            <form role="form" action="?module=atividade&acao=lista" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">

                <div class="row form-group">
                    <div class="col-sm-8">
                        <label for="est_cod">Estabelecimento</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="est_cod" name="param_2" required>
                            <option value="">--SELECIONE--</option>
                            <?php
                                for ($i = 0; $i < count($estab); $i++) {
                                    echo '<option value="' . $estab[$i]['est_cod'] . '">' . $estab[$i]['est_nome'].'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <label for="ano">Ano:</label>
                        <select id="ano" name="param_1" class="form-control selectpicker" required>
                            <option value="" disabled selected>--SELECIONE--</option>
                            <?php
                                $anoAtual = date("Y");
                                for ($ano = $anoAtual; $ano >= 1900; $ano--) {
                                    echo '<option value="' . $ano . '">' . $ano . '</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <label for="mes_cod">Mês de referência</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="mes_cod" name="param_0" required>
                            <option value="" disabled selected>--SELECIONE--</option>
                            <option value="1">Janeiro</option>
                            <option value="2">Fevereiro</option>
                            <option value="3">Março</option>
                            <option value="4">Abril</option>
                            <option value="5">Maio</option>
                            <option value="6">Junho</option>
                            <option value="7">Julho</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>
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
        window.location.href = '?module=dashboard&acao=lista';
    }

    $(document).ready(function() {
        $("#MyForm").submit(function(event) {
            document.forms['MyForm'].submit();
        });
    });
</script>