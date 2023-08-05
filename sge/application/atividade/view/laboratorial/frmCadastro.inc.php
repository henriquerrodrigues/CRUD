<?php
if (!isset($_SESSION)) {
    echo '<script>window.location="?module=index&acao=logout"</script>';
}

switch ($_POST['param_0']) {
    case 1:
        $mes = 'Janeiro';
        break;
    case 2:
        $mes = 'Fevereiro';
        break;
    case 3:
        $mes = 'Março';
        break;
    case 4:
        $mes = 'Abril';
        break;
    case 5:
        $mes = 'Maio';
        break;
    case 6:
        $mes = 'Junho';
        break;
    case 7:
        $mes = 'Julho';
        break;
    case 8:
        $mes = 'Agosto';
        break;
    case 9:
        $mes = 'Setembro';
        break;
    case 10:
        $mes = 'Outubro';
        break;
    case 11:
        $mes = 'Novembro';
        break;
    case 12:
        $mes = 'Dezembro';
        break;
}

// $sql = "SELECT ren_cod FROM relatorio_ensaio WHERE est_cod=".$_GET['est_cod'];
// $relatorio = $data->find('dynamic', $sql);

$sql = "SELECT esp_cod, esp_nome FROM estabelecimento_produto WHERE esp_situacao = 1 AND est_cod=" . $_POST['param_2'];
$produto = $data->find('dynamic', $sql);

// $sql = "SELECT rnc_cod FROM rnc WHERE rnc_situacao = 1 AND est_cod=" . $_POST['param_2'];
// $rnc = $data->find('dynamic', $sql);
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-8">
        <h2>Análise Laboratorial - <?php echo $mes . ' de ' . $_POST['param_1'] ?></h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Novo</strong>
            </li>
        </ol>
    </div>

    <div class="col-lg-3 col-xs-4" style="text-align:right;">
        <br /><br />
        <button class="btn btn-primary" onclick="$('#MyForm').valid() ? enviar():'';" type="submit"><i class="fa fa-check"></i><span class="hidden-xs hidden-sm"> Salvar</span></button>
        <button class="btn btn-default" onclick='nextPage("?module=atividade")' type="button"><i class="fa fa-times"></i><span class="hidden-xs hidden-sm"> Cancelar</span></button>
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

            <form role="form" action="?module=atividade&acao=grava_laboratorial" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">
                <input type="hidden" name="anl_mes" value="<?php echo $_POST['param_0'] ?>">
                <input type="hidden" name="anl_ano" value="<?php echo $_POST['param_1'] ?>">
                <input type="hidden" name="est_cod" value="<?php echo $_POST['param_2'] ?>">

                <div class="row form-group">
                    <div class="col-sm-4">
                        <label for="ree_cod">Nº Relatório de Ensaio</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="ren_cod" name="ren_cod">
                            <option value="" disabled selected>--SELECIONE--</option>
                            <?php
                            for ($i = 0; $i <= count($relatorio); $i++) {
                                echo '<option value="' . $relatorio[$i]['ree_cod'] . '">' . str_pad($relatorio[$i]['ree_cod'], 4, '0', STR_PAD_LEFT) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label for="esp_cod">Produto Coletado</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="esp_cod" name="esp_cod" required>
                            <option value="" disabled selected>--SELECIONE--</option>
                            <?php
                            for ($i = 0; $i <= count($produto); $i++) {
                                echo '<option value="' . $produto[$i]['esp_cod'] . '">' . $produto[$i]['esp_nome'] . '</option>';
                            }
                            ?>
                        </select>
                        </label>
                    </div>

                    <div class="col-sm-4">
                        <label for="anl_tipo">Tipo de análise:</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="anl_tipo" name="anl_tipo" required>
                            <option value="" disabled selected>--SELECIONE--</option>
                            <option value="1">MICROBIOLÓGICA</option>
                            <option value="2">FISICO-QUÍMICA</option>
                        </select>
                        </label>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-sm-2">
                        <label class="control-label" for="anl_resultado">Resultado:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="anl_resultado" id="conforme" value="1" onchange="rnc(this.value)">
                            <label class="form-check-label" for="conforme">
                                Conforme
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="anl_resultado" id="nao_conforme" value="2" onchange="rnc(this.value)">
                            <label class="form-check-label" for="nao_conforme">
                                Não Conforme
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-3" id="rnc_cod" style="display: none">
                        <label class="control-label" for="rnc_cod">RNC:</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" name="rnc_cod" id="rnc_cod" required>
                            <option value="" selected disabled>-- Selecione --</option>
                            <?php
                            for ($i = 0; $i < count($rnc); $i++) {
                                echo '<option value="' . $rnc[$i]['rnc_cod'] . '">' . str_pad($rnc[$i]['rnc_cod'], 4, '0', STR_PAD_LEFT) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </form>

        </div>
    </div>


    <script>
        function rnc(id) {
            if (id == 2) {
                document.getElementById('rnc_cod').style.display = 'block';
                document.getElementById('rnc_cod').removeAttribute('disabled', 'disabled');
                document.getElementById('rnc_cod').setAttribute('required', 'required');

            } else {
                document.getElementById('rnc_cod').style.display = 'none';
                document.getElementById('rnc_cod').setAttribute('disabled', 'disabled');
                document.getElementById('rnc_cod').removeAttribute('required', 'required');
            }
        }

        function enviar() {
            document.forms['MyForm'].submit();
        }

        $(document).ready(function() {
            $("#MyForm").validate({
                rules: {
                    cli_nome: {
                        required: true,
                        minlength: 3
                    },
                    cid_codigo: {
                        required: true
                    }
                }
            });
            $("#MyForm").submit(function(event) {
                document.forms['MyForm'].submit();
            });
        });
    </script>