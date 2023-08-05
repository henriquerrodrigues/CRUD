<?php
    if(!isset($_SESSION) || $_SESSION['sim_userPermissao'] != 1){
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }

    $sql = "SELECT * FROM cidade WHERE cid_situacao = 1;";
    $cidade = $data->find('dynamic', $sql);
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-8">
        <h2>SIM</h2>
        <ol class="breadcrumb">
            <li>
                <a href="?module=cadastro&acao=lista_sim">Serviço de Inspeção Municipal</a>
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

            <form role="form" action="?module=cadastro&acao=grava_sim" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">

                <div class="row form-group">
                    <div class="col-sm-6">
                        <label class="control-label" for="sim_titulo">Título:</label>
                        <input name="sim_titulo" type="text" class="form-control blockenter" id="sim_titulo" style="text-transform:uppercase;" required />
                    </div>

                    <div class="col-sm-6">
                        <label class="control-label" for="sim_responsavel">Vet. responsável:</label>
                        <input name="sim_responsavel" type="text" class="form-control blockenter" id="sim_responsavel" style="text-transform:uppercase;" required />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-sm-4">
                        <label class="control-label" for="sim_email">E-mail:</label>
                        <input name="sim_email" type="tel" class="form-control blockenter" id="sim_email" required />
                    </div>
                    
                    <div class="col-sm-4">
                        <label class="control-label" for="sim_telefone">Telefone:</label>
                        <input name="sim_telefone" type="tel" class="form-control blockenter" id="sim_telefone" style="text-transform:uppercase;" required />
                    </div>
                
                    <div class="col-sm-4">
                        <label class="control-label" for="cid_cod">Cidade:</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="cid_cod" name="cid_cod" required>
                            <option value="" selected disabled>-- Selecione --</option>
                            <?php
                                for ($i = 0; $i < count($cidade); $i++) {
                                    echo '<option value="' . $cidade[$i]['cid_cod'] . '">' . $cidade[$i]['cid_nome'] . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <label for="sim_plano">Plano de Trabalho:</label>
                        <input type="file" name="sim_plano" class="filestyle" id="sim_plano">
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
        window.location.href = '?module=cadastro&acao=lista_sim';
    }

    $(document).ready(function() {
        $("#sim_telefone").mask("(99) 9999-9999?9");
        $("#MyForm").submit(function(event) {
            document.forms['MyForm'].submit();
        });
    });
</script>