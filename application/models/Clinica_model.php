<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clinica_model extends CI_Model {

	

	public function getBoxItensByNum($id){
		$this->db->from("full_itens");
		$this->db->where("num_box",$id);
		$this->db->order_by("id","asc");
		$itens = $this->db->get();
		if ($itens->num_rows()) {

			return $itens->result_array();

		} else return FALSE;
	}

	public function getAllItensOnBoxes(){

		$this->db->from("full_itens");
		$itens = $this->db->get();
		if ($itens->num_rows()) {

			return $itens->result_array();

		} else return FALSE;
	}

	public function getAllItensOnBoxesByIds($id_item,$id_box){

		$this->db->from("box_itens");
		$this->db->where("id_box",$id_box);
		$this->db->where("id_item",$id_item);
		$itens = $this->db->get();
		if ($itens->num_rows()) {

			return $itens->result_array();

		} else return FALSE;
	}


	public function getItensTypes(){

		$this->db->from("itens");
		$itens = $this->db->get();
		if ($itens->num_rows()){

			return $itens->result_array();

		} else return FALSE;
	}

	public function getAllBoxesIds(){

		$this->db->select('id_box');
		$this->db->from('boxes');
		$ids = $this->db->get();
		if($ids){
			return $ids;
		}else return FALSE;
	}

	public function getAllBoxes(){
		$this->db->from('boxes');
		$this->db->order_by("num_box","asc");
		$boxes = $this->db->get();
		if($boxes){
			return $boxes->result_array();
		}else return FALSE;
	}

	public function getAllBoxesOnSetoresArray(){
		$this->db->from('boxes_maintence');
		$this->db->order_by("sector_box","asc");
		$this->db->order_by("num_box","asc");
		$boxes = $this->db->get();
		if($boxes){
			$boxes = $boxes->result_array();
			$setores = array();
			foreach ($boxes as $box) {
				$setores[$box['sector_box']][] = $box;
			}

			return $setores;

		}else return FALSE;
	}

	

	public function getAllItensOnMaintence(){
		$this->db->from("full_itens");
		$this->db->where("operating <=",0);
		$this->db->order_by('num_box','asc');
		$itens = $this->db->get();
		if ($itens->num_rows()) {

			return $itens->result_array();

		} else return FALSE;
	}


	public function getItemBoxByIds($id_item,$id_box){
		$this->db->from("full_itens");
		$this->db->where("id",$id_item);
		$this->db->where("id_box",$id_box);
		$item = $this->db->get()->result_array();
		if(count($item)>0){
			return $item[0];
		}else return FALSE;

	}

	public function toggleItemBoxStatus($id_item,$id_box){
		$item = $this->getItemBoxByIds($id_box,$id_item);
		if($item['operando']){
			$data = array(
				'operando' => 0
				);

			
		} else {
			$data = array(
				'operando' => 1
				);

		}
		$this->db->where('id_item', $item['id']);
		$this->db->where('id_box', $item['id_box']);
		if($this->db->update('boxes_itens', $data)){
			return TRUE;
		} else return FALSE;

	}


}