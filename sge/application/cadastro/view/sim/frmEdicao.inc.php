<?php
    if(!isset($_SESSION) || $_SESSION['bazar_userPermissao'] != 1){
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }

    $sql = "SELECT * FROM sim WHERE bazar_cod =".$_POST['param_0'];
    $result = $data->find('dynamic', $sql);

    $sql = "SELECT * FROM cidade WHERE cid_situacao = 1";
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

            <form role="form" action="?module=cadastro&acao=update_sim" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">
                <input type="hidden" name="bazar_cod" value="<?php echo $_POST['param_0']?>">

                <div class="row form-group">
                    <div class="col-sm-5">
                        <label class="control-label" for="bazar_responsavel">Vet. responsável:</label>
                        <input name="bazar_responsavel" type="text" class="form-control blockenter" id="bazar_responsavel" style="text-transform:uppercase;" value="<?php echo $result[0]['bazar_responsavel']?>" required />
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label" for="bazar_email">E-mail:</label>
                        <input name="bazar_email" type="tel" class="form-control blockenter" id="bazar_email" value="<?php echo $result[0]['bazar_email']?>" required />
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label" for="bazar_telefone">Telefone:</label>
                        <input name="bazar_telefone" type="tel" class="form-control blockenter" id="bazar_telefone" style="text-transform:uppercase;"  value="<?php echo $result[0]['bazar_telefone']?>" required />
                    </div>     
                
                    <div class="col-sm-3">
                        <label class="control-label" for="cid_cod">Cidade:</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="cid_cod" name="cid_cod" required>
                            <option value="" selected disabled>-- Selecione --</option>
                            <?php
                                for ($i = 0; $i < count($cidade); $i++) {
                                    if($result[0]['cid_cod'] == $cidade[$i]['cid_cod']){
                                        echo '<option value="' . $cidade[$i]['cid_cod'] . '" selected>' . $cidade[$i]['cid_nome'] . '</option>';
                                    }else{
                                        echo '<option value="' . $cidade[$i]['cid_cod'] . '" >' . $cidade[$i]['cid_nome'] . '</option>';
                                    }
                                }
                            ?>
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
        window.location.href = '?module=cadastro&acao=lista_cidade';
    }

    $(document).ready(function() {
        $("#bazar_telefone").mask("(99) 9999-9999?9");
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