<?php
if (!isset($_SESSION)) {
    echo '<script>window.location="?module=index&acao=logout"</script>';
}

$sql = "SELECT * FROM estabelecimento WHERE est_cod = " . $_POST['param_0'];
$result = $data->find('dynamic', $sql);

$sql = "SELECT cid_cod, cid_nome FROM cidade WHERE cid_situacao = 1";
$cidade = $data->find('dynamic', $sql);

$sql = "SELECT * FROM estabelecimento_produto WHERE esp_situacao = 1 AND est_cod =" . $_POST['param_0'];
$ati = $data->find('dynamic', $sql);

$sql = "SELECT * FROM estabelecimento_produto WHERE esp_situacao = 0 AND est_cod =" . $_POST['param_0'];
$ina = $data->find('dynamic', $sql);

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
        <button class="btn btn-primary" onclick="voltar();" type="submit"><i class="fa fa-check"></i><span class="hidden-xs hidden-sm"> Voltar</span></button>
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

            <div class="row form-group">
                <div class="col-sm-6">
                    <label class="control-label" for="est_nome">Nome:</label>
                    <input name="est_nome" type="text" class="form-control blockenter" id="est_nome" value="<?php echo $result[0]['est_nome'] ?>" style="text-transform:uppercase;" disabled required />
                </div>

                <div class="col-sm-3">
                    <label class="control-label" for="est_cnpj">CNPJ:</label>
                    <input name="est_cnpj" type="text" class="form-control blockenter" id="est_cnpj" value="<?php echo $result[0]['est_cnpj'] ?>" style="text-transform:uppercase;" max-lenght="14" disabled required />
                </div>
                <div class="col-sm-3">
                    <label for="cid_cod">Cidade:</label>
                    <select class="form-control selectpicker" data-live-search="true" data-size="6" id="cid_cod" name="cid_cod" disabled required>
                        <option value="">-- Selecione --</option>
                        <?php
                            for ($i = 0; $i < count($cidade); $i++) {
                                if ($result[0]['cid_cod'] == $cidade[$i]['cid_cod']) {
                                    echo '<option value="' . $cidade[$i]['cid_cod'] . '" selected>' . $cidade[$i]['cid_nome'] . '</option>';
                                } else {
                                    echo '<option value="' . $cidade[$i]['cid_cod'] . '" >' . $cidade[$i]['cid_nome'] . '</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-12">
                    <label class="control-label" for="est_descricao">Descrição:</label>
                    <textarea name="est_descricao" type="text" class="form-control blockenter" id="est_descricao" style="text-transform:uppercase; height: 200px" required disabled><?php echo $result[0]['est_descricao'] ?></textarea>
                </div>
            </div>
            </form>
        </div>
    </div>
    
    <div class="ibox-content">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6 col-xs-6">
                <h2>Produtos desse estabelecimento</h2>

                <div class="col-lg-3 col-xs-4" style="margin-left: 185%">
                    <button class="btn btn-primary" onclick="novo(<?php echo $_POST['param_0']?>);" type="submit"><i class="fa fa-plus"></i><span class="hidden-xs hidden-sm">    Novo</span></button>
                </div>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-thumbs-o-up"></i>Ativos (<?php echo count($ati); ?>)</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-thumbs-o-down"></i>Inativos (<?php echo count($ina); ?>)</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="table-responsive" style="overflow-x: initial;">
                                        <br class="hidden-md hidden-lg" />
                                        <table class="table table-striped table-bordered table-hover dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Cód.</th>
                                                    <th>Produto</th>
                                                    <th>Quantidade</th>
                                                    <th>...</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                for ($i = 0; $i < count($ati); $i++) {
                                                    
                                                    switch ($ati[$i]['esp_un_med']) {
                                                        case 1:
                                                            $un_med = 'KG';
                                                            break;
                                                        case 2:
                                                            $un_med = 'L';
                                                            break;
                                                        case 3:
                                                            $un_med = 'M²';
                                                            break;
                                                        case 4:
                                                            $un_med = 'M³';
                                                            break;
                                                        case 5:
                                                            $un_med = 'Un';
                                                            break;
                                                    }
                                                    echo '
                                            <tr>
                                                <td>' . str_pad($ati[$i]['esp_cod'], 4, '0', STR_PAD_LEFT) . '</td>
                                                <td>' . $ati[$i]['esp_nome'] . '</td>
                                                <td>' . $ati[$i]['esp_qtd'] . ' ' . $un_med . '</td>
                                                <td>
                                                    <a href="#" onClick=\'inativar(' . $ati[$i]['esp_cod'] . ', "' . $ati[$i]['asp_nome'] . '",'.$ati[0]['est_cod'].');\' title="Inativar Estabelecimento" style="text-decoration:none;">
                                                        <span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-thumbs-o-down fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <div class="table-responsive" style="overflow-x: initial;">
                                        <br class="hidden-md hidden-lg" />
                                        <table class="table table-striped table-bordered table-hover dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Cód.</th>
                                                    <th>Produto</th>
                                                    <th>Quantidade</th>
                                                    <th>...</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                for ($i = 0; $i < count($ina); $i++) {
                                                    switch ($ina[$i]['esp_un_med']) {
                                                        case 1:
                                                            $un_med = 'KG';
                                                            break;
                                                        case 2:
                                                            $un_med = 'L';
                                                            break;
                                                        case 3:
                                                            $un_med = 'M²';
                                                            break;
                                                        case 4:
                                                            $un_med = 'M³';
                                                            break;
                                                        case 5:
                                                            $un_med = 'Un';
                                                            break;
                                                    }
                                                    echo '
                                            <tr>
                                                <td>' . str_pad($ina[$i]['esp_cod'], 4, '0', STR_PAD_LEFT) . '</td>
                                                <td>' . $ina[$i]['esp_nome'] . '</td>
                                                <td>' . $ina[$i]['esp_qtd'] . ' ' . $un_med . '</td>
                                                <td>
                                                    <a href="#" onClick=\'ativar(' . $ina[$i]['esp_cod'] . ', "' . $ina[$i]['asp_nome'] . '",'.$ina[0]['est_cod'].');\' title="Reativar registro" style="text-decoration:none;">
                                                        <span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-thumbs-o-up fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <script>
                function inativar(id, nome, idEstab) {
                    var url = "?module=cadastro&acao=inativar_produto";

                    swal({
                        title: "Você tem certeza?	",
                        text: "Deseja realmente inativar este registro<br /><b>" + nome + "</b>",
                        type: "error",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Sim",
                        cancelButtonText: "Não",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }).then(function() { //CONFIRM    
                        id = id+','+idEstab; 
                        nextPage(url, id);
                    }, function(dismiss) {
                        // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                        if (dismiss === 'cancel') {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: "slideDown",
                                timeOut: 5000
                            };
                            toastr.info("Nenhum dado foi afetado!", "Cancelado");
                        }
                    })
                }

                function ativar(id, nome, idEstab) {
                    var url = "?module=cadastro&acao=ativar_produto";

                    swal({
                        title: "Você tem certeza?",
                        text: "Deseja realmente reativar este registro?<br /><b>" + nome + "</b>",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Sim",
                        cancelButtonText: "Não",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }).then(function() { //CONFIRM  
                        id = id+','+idEstab;    
                        nextPage(url, id);
                    }, function(dismiss) {
                        //dismiss can be 'cancel', 'overlay', 'close', 'timer'
                        if (dismiss === 'cancel') {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: "slideDown",
                                timeOut: 5000
                            };
                            toastr.info("Nenhum dado foi afetado!", "Cancelado");
                        }
                    })
                }

                function novo(idEstab) {
                    nextPage("?module=cadastro&acao=novo_produto", idEstab);
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