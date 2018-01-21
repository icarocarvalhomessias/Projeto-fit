<?php

class Categorias extends CI_Controller{
    
    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');

        $this->load->model('categoria_model');
    }
    
    function index(){
        
        $categorias = $this->categoria_model->get_all();
        $dados['categorias'] = $categorias;
        $dados['titulo']   = "Gerenciar Categorias";
        $dados['view']     = "categorias/index";    
        $dados['js'][] = 'categoria';                    
        
        $this->load->view("layout", $dados);
        
    }
    
    public function cadastrar(){
        $dados['titulo'] = "Cadastrar Categorias";
        $dados['view'] = 'categorias/editar';
        $dados['js'][] = 'categoria';
        
        $this->load->view("layout", $dados);
    }
    
    public function editar($id = NULL){
        
        if($id === NULL){
            redirect('categorias');
        }
        
        $categoria = $this->categoria_model->get_by_id($id);

        $dados['categoria']   = $categoria;
        $dados['titulo']    = 'Editar Categoria';
        $dados['view']      = 'categorias/editar';            
        $dados['js'][] = 'categoria';        
        
        
        $this->load->view("layout", $dados);
        
    }

    public function salvar(){

        $categoria = new stdClass();
        
        $id = $this->input->post('id');
        
        $categoria->nome       = $this->input->post('nome');

        if(($categoria->nome == "")){
                        
            $dados['categoria']   = $categoria;
            $dados['titulo']    = "Cadastrar Categoria";
            $dados['view']      = 'categorias/editar';
            
            $this->load->view("layout", $dados);
            
        }else{

            if(!empty($id)){
                
                $categoria->id = $id;
                $resultado = $this->categoria_model->atualizar($categoria);
                
            }else{                
                $resultado = $this->categoria_model->inserir($categoria);
            }
            
            if($resultado){
                //Verifica edicao ou insercao
                if(empty($id)){
                    
                    $mensagem = array('msg' => 'insert-ok', 'tipo' => 'success');
                    
                }else{
                    $mensagem = array('msg' => 'update-ok', 'tipo' => 'info');
                }
            }else{
                $mensagem = array('msg' => 'erro', 'tipo' => 'danger');
            }
            
            //Grava a mensagem em uma flashdata
            $this->session->set_flashdata('msg',$mensagem);
            
            redirect('categorias');
        }
    }
    
    public function remover($id = NULL){
        
        if($id != NULL){

            $resultado = $this->categoria_model->remover($id);
            
            if($resultado){
                
                $mensagem = array('msg' => 'delete-ok', 'tipo' => 'success');
            }else{
                $mensagem = array('msg' => 'erro', 'tipo' => 'danger');
            }
            
            $this->session->set_flashdata('msg',$mensagem);
        }
        
        redirect('categorias','refresh');
        
        
    }
    
}
