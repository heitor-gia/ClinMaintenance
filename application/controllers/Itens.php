<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itens extends CI_Controller {

	public function index(){ 
		test_login($this);
		if(!is_admin($this)) redirect(site_url());

		$this->load->model('itens_model');
		$itens = $this->itens_model->getAllItens();
		$data = array(
			'itens' => $itens
			);

		$this->load->view('item/all_itens',$data);
	}

	public function createItem(){
		test_login($this);
		if(!is_admin($this))redirect(site_url());
		$name_item = $this->input->post('name_item');
		if($this->input->post('description_item')=='undefined'){
			$description_item="";
		} else $description_item = $this->input->post('description_item');

		if(!empty($name_item)){

			$this->load->model('itens_model');
			$item = $this->itens_model->createItem($name_item,$description_item);
			if($item){
				$response = array('message'=>'O item foi cadastrado com sucesso".', 'id_item'=>(int)$item,'status'=>1);
			} else $response = array('message'=>'Não foi possível cadastrar o item".', 'status'=>0);
		} else {
			$response = array('message'=>'Preencha o campo "Nome do item".', 'status'=>0);
		}

		header('Content-Type: application/json');
		echo json_encode( $response );
	}

	public function editItem(){
		test_login($this);
		if(!is_admin($this))redirect(site_url());
		$name_item = $this->input->post('name_item');

		if($this->input->post('description_item')=='undefined'){
			$description_item="";
		} else $description_item = $this->input->post('description_item');

		$id_item = $this->input->post('id_item');
		
		if(!empty($name_item)&&!empty($id_item)){

			$this->load->model('itens_model');
			if($this->itens_model->updateItem($id_item,$name_item,$description_item)){
				$response = array('message'=>'O item foi editado com sucesso.', 'status'=>1);
			} else $response = array('message'=>'Não foi possível salvar as alterações no item.','status'=>0);

		} else {
			$response = array('message'=>'Preencha o campo "Nome do item".', 'status'=>0);
		}

		header('Content-Type: application/json');
		echo json_encode( $response );
	}

	public function deleteItem(){
		test_login($this);
		if(!is_admin($this))redirect(site_url());
		$id_item = $this->input->post('id_item');
		
		if(!empty($id_item)){

			$this->load->model('itens_model');
			if($this->itens_model->deleteItem($id_item)){
				$response = array('message'=>'O item foi excluído com sucesso.', 'status'=>1);
			} else $response = array('message'=>'Falha na conexão.','status'=>0);

		} else {
			$response = array('message'=>'Não foi possível excluir no item. Erro 400!', 'status'=>0);
		}

		header('Content-Type: application/json');
		echo json_encode( $response );
	}
}