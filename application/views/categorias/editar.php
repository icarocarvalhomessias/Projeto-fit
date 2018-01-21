<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="col-lg-12">
    <h1 class="page-header">
        Categorias
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-caret-square-o-down"></i>  <a href="<?php echo base_url('categorias') ?>">Categorias</a>
        </li>
        <li class="active">
            <i class="fa fa-file"></i> <?php echo $titulo;?>
        </li>
    </ol>
    
</div>
<div class="col-lg-12">
    <?php
        echo form_open(base_url('categorias/salvar'), 'id="editar_categoria"'); 
            
        $categoria_id = (isset($categoria->id))? $categoria->id: set_value('id');
        $categoria_id = ($categoria_id === '' && isset($id))? $id: $categoria_id; 
        
        $atributos = array(
            'name'  => 'id',
            'id'    => 'categoria_id',
            'value' => (isset($categoria->id))? $categoria->id: $categoria_id,
            'type'  => 'hidden'
        );
        
        echo form_input($atributos);
    ?>
    
    <div class="row">
        <div class="form-group col-lg-6">
            <?php
            echo form_label('Nome*');
            echo form_input('nome', (isset($categoria->nome)? $categoria->nome: set_value('nome')), 'id="nome" class="form-control" required="TRUE"');
            echo form_error('nome');
            ?>
        </div>  
    </div>    
    <div class="row" style="padding-top: 200px">
        <div class="form-group col-lg-6">
            <?php 
            
            echo form_submit('salvar','Salvar', 'class="btn btn-primary" id="salvar"');
            echo nbs(2);
            ?>
            <a href="<?php echo base_url('categorias');?>" class="btn btn-danger" role="button">Cancelar  </a>           
        </div>
    </div>
    
    <?php echo form_close(); ?>
    
</div> 