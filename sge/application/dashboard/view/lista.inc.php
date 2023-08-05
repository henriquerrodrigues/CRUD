<?php
date_default_timezone_set('America/Sao_Paulo');
$hoje = date('Y-m-d');

$sql = "SELECT a.avi_cod, a.avi_titulo, a.avi_descricao, u.usu_nome FROM aviso AS a INNER JOIN usuario AS u ON (a.usu_cod = u.usu_cod) WHERE a.avi_data = '" . $hoje . "' ORDER BY a.avi_data DESC";
$aviso = $data->find('dynamic', $sql);

$sql = "SELECT a.avi_cod, a.avi_titulo, a.avi_descricao, a.avi_data, u.usu_nome FROM aviso AS a INNER JOIN usuario AS u ON (a.usu_cod = u.usu_cod) WHERE a.avi_data > DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND a.avi_data < CURDATE() ORDER BY a.avi_data DESC";
$antigo = $data->find('dynamic', $sql);

?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-xs-6">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Painel de avisos</strong>
            </li>
        </ol>
    </div>
    <?php if ($_SESSION['sim_userPermissao'] ==  1) { ?>
        <div class="col-lg-6 col-xs-6" style="text-align:right;">
            <br /><br />
            <a href="?module=dashboard&acao=novo_aviso" class="btn btn-primary" style="height: 34px;">
                <span class="glyphicon glyphicon-plus-sign"></span> <span class="hidden-xs hidden-sm">Novo aviso</span>
            </a>
        </div>
    <?php } ?>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <h2>Notificações diárias</h2>

    <?php for ($i = 0; $i < count($aviso); $i++) { ?>
        <div class="row">
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span style="padding: 5px; background-color: #4bb8eb; border-radius: 5px; color: #fff"><?php echo $aviso[$i]['usu_nome'] ?></span>
                        <span class="pull-right" style="padding: 5px; background-color: #18A689; border-radius: 5px; color: #fff"><?php echo date('d/m/Y'); ?></span>
                    </div>
                    <div class="ibox-content">
                        <h3 style="font-weight: bold;"><?php echo $aviso[$i]['avi_titulo'] ?></h3>
                        <p style="line-height: 1.5; text-align: justify"><?php echo $aviso[$i]['avi_descricao'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <h2>Notificações dos ultimos 7 dias</h2>

        <?php for ($i = 0; $i < count($antigo); $i++) { ?>
            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span style="padding: 5px; background-color: #4bb8eb; border-radius: 5px; color: #fff"><?php echo $antigo[$i]['usu_nome'] ?></span>
                            <span class="pull-right" style="padding: 5px; background-color: #ffc107; border-radius: 5px; color: #fff"><?php echo implode('/', array_reverse(explode('-',  $antigo[$i]['avi_data']))); ?></span>
                        </div>
                        <div class="ibox-content">
                            <h3 style="font-weight: bold;"><?php echo $antigo[$i]['avi_titulo'] ?></h3>
                            <p style="line-height: 1.5; text-align: justify"><?php echo $antigo[$i]['avi_descricao'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    </html>
    <script>
        $(document).ready(function() {

            $("#todo, #inprogress, #completed").sortable({
                connectWith: ".connectList",
                update: function(event, ui) {

                    var todo = $("#todo").sortable("toArray");
                    var inprogress = $("#inprogress").sortable("toArray");
                    var completed = $("#completed").sortable("toArray");
                    $('.output').html("ToDo: " + window.JSON.stringify(todo) + "<br/>" + "In Progress: " + window.JSON.stringify(inprogress) + "<br/>" + "Completed: " + window.JSON.stringify(completed));
                }
            }).disableSelection();

            var sparklineCharts = function() {
                $("#sparkline").sparkline([34, 43, 43, 35, 44, 32, 44, 52], {
                    type: 'line',
                    width: '100%',
                    height: '60',
                    lineColor: '#1ab394',
                    fillColor: "#ffffff"
                });
            };

        });
    </script>