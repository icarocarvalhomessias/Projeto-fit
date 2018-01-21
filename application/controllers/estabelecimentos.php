<?php

class Estabelecimentos extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        //Carrega a library de validacao de formulario
        $this->load->library('form_validation');
        //Carrega a model de estabelecimento
        $this->load->model('estabelecimento_model');
        //Carrega a model de categoria
        $this->load->model('categoria_model');
        //Carrega a config de estabelecimento
        $this->load->config('estabelecimentos');
    }
    
    function index(){
        
        // Carrega todos os estabelecimentos cadastrados
        $estabelecimentos = $this->estabelecimento_model->get_all();
        
        //Passando os dados para a view
        $dados['estabelecimentos'] = $estabelecimentos;
        $dados['titulo']   = "Gerenciar Estabelecimentos";
        $dados['view']     = "estabelecimentos/index";    
        $dados['js'][] = 'estabelecimento';                    
        
        //Carrega a view de estabelecimento
        $this->load->view("layout", $dados);
        
    }
    
    public function cadastrar(){
        $dados['categorias'] = $this->categoria_model->get_all();
        $dados['titulo'] = "Cadastrar Estabelecimento";
        $dados['view'] = 'estabelecimentos/editar';
        $dados['js'][] = 'estabelecimento';
        
        $this->load->view("layout", $dados);
    }
    
    public function editar($id = NULL){
        
        if($id === NULL){
            redirect('estabelecimentos');
        }
        
        $estabelecimento = $this->estabelecimento_model->get_by_id($id);

        $date = date_create($estabelecimento->data_cadastro);
        $estabelecimento->data_cadastro = str_replace('-', '/',date_format($date, 'd-m-Y'));
        
        $dados['categorias'] = $this->categoria_model->get_all();
        $dados['estabelecimento']   = $estabelecimento;
        $dados['titulo']    = 'Editar Estabelecimento';
        $dados['view']      = 'estabelecimentos/editar';            
        $dados['js'][] = 'estabelecimento';        
        
        
        $this->load->view("layout", $dados);
        
    }

    public function salvar(){
        $regras = $this->config->item('regras');
        
        $this->form_validation->set_rules($regras);
        
        $this->form_validation->set_error_delimiters('<label class="control-label" for="inputError">','</label>');
        
        $estabelecimento = new stdClass();
        
        $id = $this->input->post('id');
        
        $estabelecimento->razao_social       = $this->input->post('razao_social');
        $estabelecimento->nome_fantasia      = $this->input->post('nome_fantasia');
        $estabelecimento->CNPJ               = $this->input->post('CNPJ');
        $estabelecimento->email              = $this->input->post('email');
        $estabelecimento->endereco           = $this->input->post('endereco');
        $estabelecimento->cidade             = $this->input->post('cidade');
        $estabelecimento->estado             = $this->input->post('estado');
        $estabelecimento->telefone           = $this->input->post('telefone');
        $estabelecimento->categoria          = $this->input->post('categoria');
        $estabelecimento->status             = $this->input->post('status');
        $estabelecimento->data_cadastro      = $this->input->post('data_cadastro');     

        $data_cadastro = str_replace('/', '-', $estabelecimento->data_cadastro);

        $arrData = explode('-', $data_cadastro);

        $estabelecimento->data_cadastro = $arrData[2] . "-" . $arrData[1] . "-" . $arrData[0];
        

        if(($this->form_validation->run() === FALSE) || ($estabelecimento->categoria  == 0)){
            
            $dados['categorias'] = $this->categoria_model->get_all(); 
            $dados['estabelecimento']   = $estabelecimento;
            $dados['titulo']    = "Cadastrar Estabelecimento";
            $dados['view']      = 'estabelecimentos/editar';
            
            $this->load->view("layout", $dados);
            
        }else{

            if(!empty($id)){
                
                $estabelecimento->id = $id;
                $resultado = $this->estabelecimento_model->atualizar($estabelecimento);
                
            }else{                
                $resultado = $this->estabelecimento_model->inserir($estabelecimento);
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
            
            redirect('estabelecimentos');
        }
    }
    
    public function remover($id = NULL){
        
        if($id != NULL){

            $resultado = $this->estabelecimento_model->remover($id);
            
            if($resultado){
                
                $mensagem = array('msg' => 'delete-ok', 'tipo' => 'success');
            }else{
                $mensagem = array('msg' => 'erro', 'tipo' => 'danger');
            }
            
            $this->session->set_flashdata('msg',$mensagem);
        }
        
        redirect('estabelecimentos','refresh');
        
        
    }
    
}
