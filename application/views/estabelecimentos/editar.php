<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="col-lg-12">
    <h1 class="page-header">
       Estabelecimentos
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-building"></i>  <a href="<?php echo base_url('estabelecimentos') ?>">Estabelecimentos</a>
        </li>
        <li class="active">
            <i class="fa fa-file"></i> <?php echo $titulo;?>
        </li>
    </ol>
    
</div>
<div class="col-lg-12">
    <?php
        echo form_open(base_url('estabelecimentos/salvar'), 'id="editar_estabelecimento"'); 
            
        $estabelecimento_id = (isset($estabelecimento->id))? $estabelecimento->id: set_value('id');
        $estabelecimento_id = ($estabelecimento_id === '' && isset($id))? $id: $estabelecimento_id; 
        
        $atributos = array(
            'name'  => 'id',
            'id'    => 'estabelecimento_id',
            'value' => (isset($estabelecimento->id))? $estabelecimento->id: $estabelecimento_id,
            'type'  => 'hidden'
        );
        
        echo form_input($atributos);
    ?>
    
    <div class="row">
        <div class="form-group col-lg-6">
            <?php
            echo form_label('Razão Social *');
            echo form_input('razao_social', (isset($estabelecimento->razao_social)? $estabelecimento->razao_social: set_value('razao_social')), 'id="razao_social" class="form-control" required="TRUE"');
            echo form_error('razao_social');
            ?>
        </div>  
        <div class="form-group col-lg-6">
            <?php 

            echo form_label('Nome Fantasia');
            echo form_input('nome_fantasia',(isset($estabelecimento->nome_fantasia)? $estabelecimento->nome_fantasia: set_value('nome_fantasia')), 'class="form-control " id="nome_fantasia"');
            echo form_error('nome_fantasia');
            ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-lg-6">
            <?php 
            echo form_label('CNPJ *');
            echo form_input('CNPJ',(isset($estabelecimento->CNPJ)? $estabelecimento->CNPJ: set_value('CNPJ')), 'class="form-control CNPJ" id="CNPJ" required="TRUE" onBlur="validarCNPJ(CNPJ.value);"');
            echo form_error('CNPJ');
            ?>
        </div>
        <div class="form-group col-lg-6">
            <?php 
            echo form_label('E-mail');
            echo form_input('email',(isset($estabelecimento->email)? $estabelecimento->email: set_value('email')), 'class="form-control email" id="email" onBlur="validaEmail()"');
            echo form_error('email');
            ?>
        </div>
        
    </div>

    <div class="row">
        <div class="form-group col-lg-4">
            <?php 
            echo form_label('Endereço');
            echo form_input('endereco',(isset($estabelecimento->endereco)? $estabelecimento->endereco: set_value('endereco')), 'class="form-control " id="endereco"');
            echo form_error('endereco');
            ?>
        </div>
        <div class="form-group col-lg-4">
            <?php 
            echo form_label('Cidade');
            echo form_input('cidade',(isset($estabelecimento->cidade)? $estabelecimento->cidade: set_value('cidade')), 'class="form-control " id="cidade"');
            echo form_error('cidade');
            ?>
        </div>
        <div class="form-group col-lg-4">
            <?php 
            echo form_label('Estado');
            echo form_input('estado',(isset($estabelecimento->estado)? $estabelecimento->estado: set_value('estado')), 'class="form-control " id="estado"');
            echo form_error('estado');
            ?>
        </div>
        
    </div>
    <div class="row">
        <div class="form-group col-lg-3">
            <?php 
            echo form_label('Telefone');
            echo form_input('telefone',(isset($estabelecimento->telefone)? $estabelecimento->telefone: set_value('telefone')), 'class="form-control " id="telefone" onBlur="mascaraTelefone()"');
            echo form_error('telefone');
            ?>
        </div>
       
   
        <div class="form-group col-lg-3 div-grupos" name="grupo">
            <?php 
                
                $cat = array();
                $cat['0'] = "Selecione uma categoria";
                foreach ($categorias as $c){
                    $cat[$c->id] = $c->nome;
                }
                            
                echo form_label('Categorias *');
                echo form_dropdown('categoria',$cat,(isset($estabelecimento->categoria)? $estabelecimento->categoria: set_value('categoria')),'class="form-control" id="categoria" required="TRUE" onBlur="validaCategoria()"');
                echo form_error('categoria');
            
            ?>
        </div>
        <div class="form-group col-lg-3">
            <?php 

            echo form_label('Status *');

            $status_estabelecimento = $this->config->item('status');

            echo form_dropdown('status',$status_estabelecimento,(isset($estabelecimento->status)? $estabelecimento->status: set_value('status')),'class="form-control" id="status" required="TRUE"');
            echo form_error('status');
            ?>
        </div>
        <div class="form-group col-lg-3">
            <?php 
            echo form_label('Data Cadastro');
            echo form_input('data_cadastro',(isset($estabelecimento->data_cadastro)? $estabelecimento->data_cadastro: set_value('data_cadastro')), 'class="form-control data_cadastro" id="data_cadastro" onBlur="validaData()"');
            echo form_error('data_cadastro');
            ?>
        </div>
    
    
    <div class="row" style="padding-top: 200px">
        <div class="form-group col-lg-6">
            <?php 
            
            echo form_submit('salvar','Salvar', 'class="btn btn-primary" onClick="validaCategoria()" id="salvar"');
            echo nbs(2);
            ?>
            <a href="<?php echo base_url('estabelecimentos');?>" class="btn btn-danger" role="button">Cancelar  </a>           
        </div>
    </div>
    
    <?php echo form_close(); ?>
    
</div> 