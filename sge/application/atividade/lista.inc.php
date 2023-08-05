<?php
    if(!isset($_SESSION))   {
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }

    date_default_timezone_set('America/Sao_Paulo');
    

    if($_POST != '') {
        $mes = $_POST['param_0'];
        $ano = $_POST['param_1'];
        $estabelecimento = $_POST['param_2'];
    }else{
        echo'<script>window.location="?module=atividade&acao=filtro"</script>';
    }

    $sql = "SELECT e.est_cod, e.est_nome, e.est_descricao, e.etp_cod, t.etp_descricao FROM estabelecimento AS e INNER JOIN estabelecimento_tipo as t ON t.etp_cod = e.est_cod WHERE e.est_cod =".$estabelecimento;
    $result = $data->find('dynamic', $sql);
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-8">
        <h2>Atividade</h2>
        <ol class="breadcrumb">            
        </ol>
    </div>

    <div class="col-lg-3 col-xs-4" style="text-align:right;">
        <br /><br />
        <button class="btn btn-default" onclick="window.history.back()" type="button"><i class="fa fa-times"></i><span class="hidden-xs hidden-sm"> Cancelar</span></button>
    </div>
</div>

<div id="result_var"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
        <h4>Dados do estabelecimento</h4>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="ibox-content">
            <div class='row form-group'>
                    
                <div class="col-sm-12">
                
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Cód.</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Tipo</th>
                                <th>Período (mês/ano)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td><?php echo $result[0]['est_cod']?></td>
                            <td><?php echo $result[0]['est_nome']?></td>
                            <td><?php echo $result[0]['est_descricao']?></td>
                            <td><?php echo $result[0]['etp_descricao']?></td>
                            <td><?php echo str_pad($mes, 2, '0', STR_PAD_LEFT).'/'.$ano?></td>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-12">
                    <?php
                        $id = $mes.','.$ano.','.$estabelecimento;
                    echo'
                        <a href="#" onclick="nextPage(\'?module=atividade&acao=novo_laboratorial\',\''.$id.'\')" class="btn btn-success">Análise Laboratorial</a>                
                        <a href="#" onclick="nextPage(\'?module=atividade&acao=novo_laboratorial\',\''.$id.'\')" class="btn btn-success">Relatório de Ensaio </a>                
                        <a href="#" onclick="nextPage(\'?module=atividade&acao=novo_laboratorial\',\''.$id.'\')" class="btn btn-success">Registro de Fiscalização </a>                
                        <a href="#" onclick="nextPage(\'?module=atividade&acao=novo_laboratorial\',\''.$id.'\')" class="btn btn-success">PAC </a>
                    '?>               

                    <?php if($result[0]['etp_cod'] == 1){//frigorífico
                    echo '<a href="?module=atividade&acao=novo_relatorio" class="btn btn-success">GTA </a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    function enviar() {
        document.forms['MyForm'].submit();
    }

    $(document).ready(function() {
        $("#MyForm").submit(function(event) {
            document.forms['MyForm'].submit();
        });
    });
</script>