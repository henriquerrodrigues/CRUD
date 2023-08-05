<?php
    if(!isset($_SESSION) || $_SESSION['bazar_userPermissao'] != 1){
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }

    $sql = "SELECT s.*, c.cid_nome, c.est_uf FROM sim AS s INNER JOIN cidade AS c ON (c.cid_cod = s.cid_cod) WHERE bazar_situacao = 1 ";
    $ati = $data->find('dynamic', $sql);

    $sql = "SELECT s.*, c.cid_nome FROM sim AS s INNER JOIN cidade AS c ON (c.cid_cod = s.cid_cod) WHERE bazar_situacao = 0";
    $ina = $data->find('dynamic', $sql);
?>

<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: "slideDown",
        timeOut: 5000
    };
    <?php
    switch ($_GET[ms]) {
        case 1:
            echo 'toastr.success("Cidade cadastrada com sucesso!", "Incluido!");';
            break;

        case 2:
            echo 'toastr.success("Cidade atualizada com sucesso", "Atualizado!");';
            break;

        case 3:
            echo 'toastr.success("Cidade excluida com sucesso", "Exluido!");';
            break;

        case 4:
            echo 'toastr.info("Cidade foi inativada", "Inativado!");';
            break;

        case 5:
            echo 'toastr.success("Cidade foi reativada", "Reativado!");';
            break;
    }
    ?>
</script>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-xs-6">
        <h2>SIM</h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Serviço de Inspeção Municipal</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-6 col-xs-6" style="text-align:right;">
        <br /><br />
        <a href="?module=cadastro&acao=novo_sim" class="btn btn-primary" style="height: 34px;">
            <span class="glyphicon glyphicon-plus-sign"></span> <span class="hidden-xs hidden-sm">Novo</span>
        </a>
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
                                            <th style="width:10px;">Cód.</th>
                                            <th style="width:80px;">Vet. responsável</th>
                                            <th style="width:10px;">E-mail</th>
                                            <th style="width:10px;">Telefone</th>
                                            <th style="width:10px;">Cidade</th>
                                            <th style="width:10px;">...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($ati); $i++) {
                                            echo '
                                                <tr>
                                                    <td>' . str_pad($ati[$i]['bazar_cod'], 4, '0', STR_PAD_LEFT) . '</td>
                                                    <td>' . $ati[$i]['bazar_responsavel'] . '</td>
                                                    <td>' . $ati[$i]['bazar_email'] . '</td>
                                                    <td>' . $ati[$i]['bazar_telefone'] . '</td>
                                                    <td>' . $ati[$i]['cid_nome'].' - '.$ati[$i]['est_uf'] . '</td>
                                                    <td>
                                                        <a href="#" onclick="nextPage(\'?module=cadastro&acao=edita_sim\', ' . $ati[$i]['bazar_cod'] . ')">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </a>
                                                        <a href="#" onClick=\'inativar("' . $ati[$i]['bazar_cod'] . '", "' . $ati[$i]['bazar_cod'] . '");\' title="Inativar SIM" style="text-decoration:none;">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                <i class="fa fa-thumbs-o-down fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            ';
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
                                            <th style="width:10px;">Cód.</th>
                                            <th style="width:80px;">Vet. responsável</th>
                                            <th style="width:10px;">E-mail</th>
                                            <th style="width:10px;">Telefone</th>
                                            <th style="width:10px;">Cidade</th>
                                            <th style="width:10px;">...</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($ina); $i++) {
                                            echo '
                                                <tr>
                                                    <td>' . $ina[$i]['bazar_cod'] . '</td>
                                                    <td>' . $ina[$i]['bazar_responsavel'] . '</td>
                                                    <td>' . $ina[$i]['bazar_email'] . '</td>
                                                    <td>' . $ina[$i]['bazar_telefone'] . '</td>
                                                    <td>' . $ina[$i]['cid_nome'].' - '.$ina[$i]['est_uf'] . '</td>
                                                    <td>
                                                        <a href="#" onClick=\'ativar("' . $ina[$i]['bazar_cod'] . '", "' . $ina[$i]['bazar_cod'] . '");\' title="Reativar SIM" style="text-decoration:none;">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                <i class="fa fa-thumbs-o-up fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            ';
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
    <br />

    <script>
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                "lengthMenu": [
                    [50, 150, 200, -1],
                    [50, 150, 200, "Todos"]
                ],
                "order": [
                    [0, "asc"]
                ]
            });
        });

        function inativar(id, nome) {
            var url = "?module=cadastro&acao=inativar_sim";

            swal({
                title: "Você tem certeza?	",
                text: "Deseja realmente inativar este Cadastro?<br /><b>" + nome + "</b>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim",
                cancelButtonText: "Não",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then(function() { //CONFIRM      
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

        function ativar(id, nome) {
            var url = "?module=cadastro&acao=ativar_sim";

            swal({
                title: "Você tem certeza?",
                text: "Deseja realmente reativar este Registro?<br /><b>" + nome + "</b>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim",
                cancelButtonText: "Não",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then(function() { //CONFIRM      
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
    </script>