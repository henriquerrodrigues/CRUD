<?php
    $sql = "SELECT upe_descricao FROM usuario_permissao WHERE upe_cod = ".$_SESSION['sim_userPermissao'];
    $permissao = $data->find('dynamic', $sql);

	
    $img_perfil = 'application/images/sem_img_profile.svg';
    

    $tam_image = getimagesize($img_perfil);

    //Compara se altura é largura é maior que altura
    if($tam_image[0]>$tam_image[1]){
        $bs = 'background-size:100% auto;';
    }else
        if($tam_image[0]<$tam_image[1]){
            $bs = 'background-size:auto 100%;';
        }else{
            $bs = 'background-size:100%;';
        }

?>

<style>
    .avatar{ 
        background-image:url('<?php echo $img_perfil; ?>');
        <?php echo $bs; ?>
        background-position:center center; 
        /*border-radius:50%;*/
        border: none;
        background-repeat: no-repeat;
        background-color: #FFF; 
    }
    .reduzido.avatar{
        margin-right: auto;
        margin-left: auto;
        width:32px; 
        height:32px; 
    }
    
</style>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header" style="padding: 27px 25px;">
                <div class="dropdown profile-element"> 
                    <a title="Visualizar usuário" href="#" onClick="nextPage('?module=cadastro&acao=edita_usuario', <?php echo $_SESSION['sim_userId'];?>);" style="text-decoration:none;">
                	<span>
                        <div class="avatar" style="width:60px; height:60px;">
                            <br />
                        </div>
                    </span>
                    </a>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> 
                        	<span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['sim_userName']; ?></strong></span> 
                        	<span class="text-muted text-xs block"><?php echo $permissao[0]['upe_descricao']; ?> <b class="caret"></b></span> 
                        </span> 
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a title="Visualizar usuário" href="#" onClick="nextPage('?module=cadastro&acao=edita_usuario', <?php echo $_SESSION['sim_userId'];?>);" style="text-decoration:none;">Meus Dados</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="background: transparent;">
                    	<div class="reduzido avatar">
                            <br />
                        </div>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs" style="color:#000;">
                        <li><a href="#" onClick="nextPage('?module=cadastro&acao=edita_usuario', <?php echo $_SESSION['sim_userId'];?>);">Meus Dados</a></li>
                        <li class="divider"></li>
                        <li><a href="?module=index&acao=logout">Sair do Sistema</a></li>
                    </ul>
                </div>
            </li>

            <?php 
            	if($_GET['module']=='dashboard'){
            		echo '<li class="active">';
                    //Valida qual variavel vai receber active
                    unset($item_sel);
                    $acao = explode('_',$_GET['acao']);
            	}else{
            		echo '<li>';
            	}

                echo '
                <a href="?module=dashboard&acao=lista"><i class="fa fa-pie-chart"></i><span class="nav-label">Dashboard</span></a>';                       
            			
            ?>	    
            </li>
            
            <?php 
            	if($_GET['module']=='cadastro'){
            		echo '<li class="active">';
                    //Valida qual variavel vai receber active
                    unset($item_sel);
                    $acao = explode('_',$_GET['acao']);
                    switch ($acao[1]) {

                        case 'usuario':
                            $item_sel[0] = 'class="active"';
                        break;
                        
                        case 'cidade':
                            $item_sel[1] = 'class="active"';
                        break;
                        
                        case 'estabelecimento':
                            $item_sel[2] = 'class="active"';
                        break;
                        
                        case 'sim':
                            $item_sel[3] = 'class="active"';
                        break;

                        case 'atividade':
                            $item_sel[4] = 'class="active"';
                        break;

                    }
            	}else{
            		echo '<li>';
            	}

            	switch($_SESSION['sim_userPermissao']) {
            		case '1': //ADMINISTRADOR
            			echo '
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Cadastros</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">    
                            <li '.$item_sel[0].' ><a href="?module=cadastro&acao=lista_usuario"><i class="fa fa-user" aria-hidden="true"></i>Usuários</a></li>

    	                    <li '.$item_sel[1].' ><a href="?module=cadastro&acao=lista_cidade"><i class="fa fa-building" aria-hidden="true"></i>Cidades</a></li>

                            <li '.$item_sel[2].' ><a href="?module=cadastro&acao=lista_estabelecimento"><i class="fa fa-building-o" aria-hidden="true"></i>Estabelecimentos</a></li>

                            <li '.$item_sel[3].' ><a href="?module=cadastro&acao=lista_sim"><i class="fa fa-user-secret" aria-hidden="true"></i>SIM</a></li>
                        </ul>';
                    break;
              
                    case '2': //FUNCIONÁRIO
                        echo '
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Registros</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">    
                            <li '.$item_sel[2].' ><a href="?module=cadastro&acao=lista_estabelecimento"><i class="fa fa-building-o" aria-hidden="true"></i>Estabelecimentos</a></li>
                        </ul>';
                    break;
            	}
            ?>	
            </li>
            <?php
                if($_GET['module']=='atividade'){
                        echo '<li class="active">';
                        //Valida qual variavel vai receber active
                        unset($item_sel);
                        $acao = explode('_',$_GET['acao']);
                        switch ($acao[1]) {
                            case 'filtro':
                                $item_sel[0] = 'class="active"';
                            break;
                        }
                    }else{
                        echo '<li>';
                    }

                    switch($_SESSION['sim_userPermissao']) {
                        case '2': //ADMINISTRADOR
                            echo '
                            <a href="#"><i class="fa fa-wrench"></i> <span class="nav-label">Atividade</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li '.$item_sel[0].' ><a href="?module=atividade&acao=filtro"><i class="fa fa-flag" aria-hidden="true"></i>Lançamentos</a></li>
                            </ul>';
                        break;
                    }
            ?>
        </ul>
    </div>
</nav>