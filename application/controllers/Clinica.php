<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clinica extends CI_Controller {

	public function index(){ 
		test_login($this);

		$this->load->model('clinica_model');
		$setores = $this->clinica_model->getAllBoxesOnSetoresArray();
		if($setores){

			$data = array(
				'setores' => $setores
				);

			$this->load->view('home/clinica',$data);
		} else show_500();

	}

	public function box($id){
		test_login($this);

		$this->load->model('clinica_model');
		$box = $this->clinica_model->getBoxItensByNum($id);

		if($box){
			$data = array('box' => $box );
			$this->load->view('home/box',$data);
		} else  show_404();
	}

	public function manutencao(){
		test_login($this);

		$this->load->model('clinica_model');
		$itens = $this->clinica_model->getAllItensOnMaintence();
		$data = array('itens'=>$itens);
		
		$this->load->view('home/manutencao',$data);
		
	}
}
