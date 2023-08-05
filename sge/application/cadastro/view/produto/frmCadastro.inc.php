<?php
if (!isset($_SESSION)){
    echo '<script>window.location="?module=index&acao=logout"</script>';
}
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-8">
        <h2>Cadastro de produtos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="?module=cadastro&acao=lista_cliente">Produto</a>
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

            <form role="form" action="?module=cadastro&acao=grava_produto" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">
                <input type="hidden" name="est_cod" value="<?php echo $_POST['param_0']?>">

                <div class="row form-group">
                    <div class="col-sm-10">
                        <label class="control-label" for="esp_nome">Nome:</label>
                        <input name="esp_nome" type="text" class="form-control blockenter" id="esp_nome" style="text-transform:uppercase;" required />
                    </div>

                    <div class="col-sm-2    ">
                        <label class="control-label" for="esp_med_cod">Un. de medida:</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="esp_un_med" name="esp_un_med" required>
                            <option value="" selected disabled>-- Selecione --</option>
                            <option value="1">KG - Quilogramas</option>
                            <option value="2">L - Litros</option>
                            <option value="3">M² - Metros Quadrados</option>
                            <option value="4">M³ - Metros Cúbicos</option>
                            <option value="5">Un - Unidade</option>

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
            window.location.href = '?module=cadastro&acao=lista_estabelecimento';
        }

        $(document).ready(function() {
            $("#MyForm").submit(function(event) {
                document.forms['MyForm'].submit();
            });
        });
    </script>