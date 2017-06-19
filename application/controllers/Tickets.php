<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

	public function item($id_item=0,$id_box=0){ 
		test_login($this);
		if ($id_item&&$id_box) {
			$this->load->model('tickets_model');
			$this->load->model('clinica_model');
			$item = $this->clinica_model->getItemBoxByIds($id_item,$id_box);
			$tickets = $this->tickets_model->getTicketsByItemBox($id_item,$id_box);
			$data = array(
				'item' => $item,
				'tickets' => $tickets
				);
			$this->load->view('item/item',$data);			
		}else show_404();
	}

	public function alltickets(){ 
		test_login($this);
		if(is_maintence($this)) redirect(site_url());
		$this->load->library('pagination');
		$this->load->model('tickets_model');
		$tickets = $this->tickets_model->getAllTickets();
		
			//Configuração de paginação do codeigniter
		$config['base_url'] = site_url('tickets/alltickets/');
		$config['total_rows'] = count($tickets);
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;	
		
			//Configuração de tags html
		$config['num_tag_open'] = '<li class="waves-effect">';
		$config['num_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active white-text">';
		$config['cur_tag_close'] = '</li>';
		
		$config['next_link'] = 'navigate_next';
		$config['next_tag_open'] = '<li class="nopadding"><i class="material-icons">';
		$config['next_tag_close'] = '</i></li>';
		
		$config['prev_link'] = 'navigate_before';
		$config['prev_tag_open'] = '<li class="nopadding"><i class="material-icons">';
		$config['prev_tag_close'] = '</i></li>';
		
		$config['first_link'] = 'first_page';
		$config['first_tag_open'] = '<li class="nopadding"><i class="material-icons">';
		$config['first_tag_close'] = '</i></li>';

		$config['last_link'] = 'last_page';
		$config['last_tag_open'] = '<li class="nopadding"><i class="material-icons">';
		$config['last_tag_close'] = '</i></li>';

		$config['full_tag_open'] = '<ul class="pagination center">';
		$config['full_tag_close'] = '</ul>';
		



		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data = array(
			'tickets' => $this->tickets_model->fetchTickets($config["per_page"], $page),
			'links' => $this->pagination->create_links()
			);

		$this->load->view('item/all_tickets',$data);


	}

	public function closeTicket(){
		test_login($this);
		$id_ticket = $this->input->post('id_ticket');
		if(!empty($id_ticket)||is_numeric($id_ticket)){ 
			$this->load->model("tickets_model");
			$time = $this->tickets_model->closeTicket($id_ticket);
			if($time){
				$response = array('message'=>'O chamado '.$id_ticket.' foi encerrado com sucesso',
					'time'=> nice_date($time,'d/m/Y')." \n ".nice_date($time,'H:i:s'),
					'status'=>1);
			} else {
				$response = array('message'=>'O chamado já foi encerrado','status'=>0);
			}
		} else $response = array('message'=>'Dados insuficientes para fechar o chamado','status'=>0);

		header('Content-Type: application/json');
		echo json_encode( $response );
		
	}

	public function createTicket(){
		test_login($this);
		if(is_maintence($this))redirect(site_url());
		if( $this->input->post('id_item') 	  != NULL &&
			$this->input->post('id_box')	  != NULL &&
			$this->input->post('description') != NULL ){

			$id_item 	 = $this->input->post('id_item');
		$id_box  	 = $this->input->post('id_box');
		$description = $this->input->post('description');
		$description = trim($description);


		$this->load->model("tickets_model");
		$data = $this->tickets_model->createTicket($id_item,$id_box,$description);

		if ($data) {
			header("location:".site_url('tickets/item/'.$id_item.'/'.$id_box));
		} 
	}
}

public function newTicket($id_item=NULL,$id_box=NULL){
	test_login($this);
	if(is_maintence($this))redirect(site_url());
	$this->load->model("clinica_model");
	$itens = $this->clinica_model->getItensTypes();
	$boxes = $this->clinica_model->getAllBoxes();

	$data = array(
		"options" => array(
			"id_item" => $id_item,
			"id_box"  => $id_box
			),
		"itens" => $itens,
		"boxes" => $boxes
		);


	$this->load->view('item/new_ticket',$data);

}

public function records(){
	test_login($this);
	if(is_maintence($this))redirect(site_url());
	$this->load->view('tickets/record_config');
}


public function createRecords(){
	test_login($this);
	if(is_maintence($this))redirect(site_url());
	if( $this->input->post('record') != NULL){

		$record	 = $this->input->post('record');

		switch ($record) {
			case 1:
				$this->load->model("tickets_model");
				$itens = $this->tickets_model->recordItens();
				$this->load->view('tickets/record_itens',array('itens'=>$itens));


			break;
			case 2:
				$max = $this->input->post('max');
				if($max!=""){
					$max = substr($max,6,4).'-'.substr($max,3,2).'-'.substr($max,0,2);
				} else {
					$max = "";
				}

				$min = $this->input->post('min');
				if($min!=""){
					$min = substr($min,6,4).'-'.substr($min,3,2).'-'.substr($min,0,2);
				} else {
					$min = "";
				}
				$this->load->model("tickets_model");
				$tickets = $this->tickets_model->getTicketsAtDate($min,$max);
				$this->load->view('tickets/record_date_pdf',array('tickets'=>$tickets,'min'=>$min, 'max'=>$max));
				
			break;

			case 3:
				$this->load->model("tickets_model");
				$boxes = $this->tickets_model->recordBoxes();
				$this->load->view('tickets/record_boxes',array('boxes'=>$boxes));
			break;
			default:
				redirect(site_url('tickets/records'));
			break;
		}




		
		

	}
}

}

