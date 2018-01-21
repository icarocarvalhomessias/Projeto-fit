<?php

class Estabelecimento_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    

    function get_all(){
        
        //Seleciona todas as colunas
        $this->db->select('estabelecimentos.id,nome_fantasia, email, categoria , nome, data_cadastro, status');
        //Seleciona a tabela
        $this->db->from('estabelecimentos');
        $this->db->join('categorias', 'estabelecimentos.categoria = categorias.id');
        //Faz a consulta
        $resultado = $this->db->get();
        //Se tiver resultado
        if($resultado->num_rows > 0){
            
            return $resultado->result();
        }else{
            return false;
        }
    }
    
    function inserir($estabelecimento){
        $this->db->insert('estabelecimentos', $estabelecimento);
        
        $resultado = (bool) $this->db->affected_rows();
        
        return $resultado;
    }
    
    function get_by_id($id){
        $this->db->select('estabelecimentos.id,nome_fantasia, razao_social, CNPJ, telefone, email,endereco, cidade, estado, data_cadastro, categoria , nome, status');        
        $this->db->from('estabelecimentos');
        $this->db->join('categorias', 'estabelecimentos.categoria = categorias.id');        
        $this->db->where('estabelecimentos.id', $id);
        
        $resultado = $this->db->get();
        
        if($resultado->num_rows > 0){
            return $resultado->row(0);
        }else{
            return FALSE;
        }
    }
    
    function atualizar($estabelecimento){
        
        $this->db->where('id', (int)$estabelecimento->id);
        $this->db->update('estabelecimentos', $estabelecimento);
        
        $resultado = (bool)$this->db->affected_rows();
        
        return $resultado;
    }
    
    function remover($id){
        $this->db->where('id', (int)$id);
        $this->db->delete('estabelecimentos');
        
        $resultado = (bool)$this->db->affected_rows();
        
        return $resultado;
    }
}
