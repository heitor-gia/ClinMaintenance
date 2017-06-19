<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itens_model extends CI_Model {

	
	public function getItemById($id_item){
		if($id_item){
			$item = $this->db->from('itens')
			->where('id_item',$id_item)
			->get()
			->result_array();
			if(count($item)){
				
				return $item[0];

			}else return FALSE;

		}else return FALSE;
	}

	public function getAllItens(){
		$itens = $this->db->from('tickets_item_type')
		->get()
		->result_array();
		if(count($itens)){
			return $itens;
		} else return FALSE;
	}

	public function createItem($name,$description=""){
		$data = array(
			'name_item' 	   => $name,
			'description_item' => $description
			); 
		$this->db->trans_begin();

		$this->db->insert('itens',$data);
		$id_item = $this->db
		->select('MAX(id_item) as id_item')
		->from('itens')
		->get()
		->result_array()[0]['id_item'];
		$this->db->query('call sp_add_item_to_boxes('.$id_item.')');

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return FALSE;
		}else{	
			$this->db->trans_commit();
			return $this->db->select('max(id_item) as id_item')
							->from('itens')
							->get()
							->result_array()[0]['id_item'];
		}

	}

	public function updateItem($id_item,$name_item,$description=""){
		$data = array(
			'name_item' => $name_item,
			'description_item' => $description
			);

		$this->db->where('id_item', $id_item);
		return $this->db->update('itens', $data);

	}

	public function deleteItem($id_item){
		if(is_numeric($id_item)){
			$this->db->where('id_item',$id_item);
			return  $this->db->delete('itens');
		} else return FALSE;
	}

}