<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Projeto</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets/css/metisMenu.min.css');?>" rel="stylesheet" type="text/css">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url('assets/css/timeline.css');?>" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/sb-admin-2.css'); ?>" rel="stylesheet" type="text/css">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url('assets/css/morris.css');?>" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('assets/css/jquery-ui.css');?>" rel="stylesheet" type="text/css">
    

</head>

<body>

    <div id="wrapper">

     
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url();?>">Projeto</a>
        </div>        
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url("estabelecimentos");?>">
                                <i class="fa fa-building"></i> Estabelecimentos</a>
                         </li>
                         <li>
                            <a href="<?php echo base_url("categorias");?>">
                                <i class="fa fa-caret-square-o-down"></i> Categorias</a>
                         </li>
                    </ul>
                </div>
         
            </div>
 
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <?php  $this->load->view("adm/" . (isset($view)) ? $view : ''); ?>   

            </div>
        </div>

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js');?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('assets/js/metisMenu.min.js');?>"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('assets/js/sb-admin-2.js');?>"></script>

    <script src="<?php echo base_url('assets/js/jquery-ui.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.mask.js');?>"></script>
    
    <?php
    
    if(isset($js) && is_array($js)){
        foreach ($js as $j){
            echo '<script src="'.base_url('assets/js/'.$j.'.js').'"></script>';
        }
    }
    
    ?>
    

</body>

</html>
