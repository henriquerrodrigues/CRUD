<?php
    if(!isset($_SESSION) || $_SESSION['sim_userPermissao'] != 1){
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }

    date_default_timezone_set('America/Sao_Paulo');

    $sql = "SELECT * FROM cidade WHERE cid_situacao = 1;";
    $cidades = $data->find('dynamic', $sql);
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-8">
        <h2>Avisos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="?module=dashboard&acao=lista">Avisos</a>
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
            <h5>Formulário de Criação</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="ibox-content">

            <form role="form" action="?module=dashboard&acao=grava_aviso" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">


                <!-- Identificação -->
                <div class="row form-group">
                    <div class="col-sm-10">
                        <label class="control-label" for="avi_titulo">Título</label>
                        <input name="avi_titulo" type="text" class="form-control blockenter" id="avi_titulo" style="text-transform:uppercase;" required />
                    </div>
                    <div class="col-sm-2">
                        <label class="control-label" for="avi_data">Data de publicação</label>
                        <input name="avi_data" type="date" class="form-control blockenter" id="avi_data" min="<?php echo date('Y-m-d') ?>" required />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <label class="control-label" for="avi_descricao">Descrição:</label>
                        <textarea name="avi_descricao" type="text" class="form-control blockenter" id="avi_descricao" style="text-transform:uppercase; height: 200px" required></textarea>
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

    function expulsa() {
        window.alert('Você não tem permissão para acessar essa página!');
    }


    $(document).ready(function() {
        $("#cli_cnpj").mask("99.999.999/9999-99");
        $("#cli_tel").mask("(99) 9999-9999?9");
        $("#cli_cep").mask("99999-999");

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