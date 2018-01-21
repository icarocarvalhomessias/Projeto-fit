<?php

class Categoria_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    function get_all(){
        
        //Seleciona todas as colunas
        $this->db->select('*');
        //Seleciona a tabela
        $this->db->from('categorias');
        //Faz a consulta
        $resultado = $this->db->get();
        //Se tiver resultado
        if($resultado->num_rows > 0){
            
            return $resultado->result();
        }else{
            return false;
        }
    }
    
    function inserir($categoria){
        
        $this->db->select('*');
        $this->db->from('categorias');
        $this->db->where('nome', $categoria->nome);
        $resultado = $this->db->get();

        if($resultado->num_rows > 0){
            
            return false;
            
        }else{

            $this->db->insert('categorias', $categoria);
            
            $resultado = (bool) $this->db->affected_rows();
            
            return $resultado;
        }


    }
    
    function get_by_id($id){
        $this->db->select('*');
        $this->db->from('categorias');
        $this->db->where('id', $id);
        
        $resultado = $this->db->get();
        
        if($resultado->num_rows > 0){
            return $resultado->row(0);
        }else{
            return FALSE;
        }
    }
    
    function atualizar($categoria){
        
        $this->db->where('id', (int)$categoria->id);
        $this->db->update('categorias', $categoria);
        
        $resultado = (bool)$this->db->affected_rows();
        
        return $resultado;
    }
    
    function remover($id){

        $this->db->select('*');
        $this->db->from('estabelecimentos');
        $this->db->where('categoria', $id);

        $res = $this->db->get();
        
        if($res->num_rows > 0){
            return false;
        }else{
            
            $this->db->where('id', (int)$id);
            $this->db->delete('categorias');
            
            $resultado = (bool)$this->db->affected_rows();
            
            return $resultado;
        }
    }
}
