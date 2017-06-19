<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index(){
		if ($this->session->logado) header('location:'.site_url());
		$this->load->view('user/login');
	}

	public function login(){
		if ($this->session->logado) header('location:'.site_url());

		$user_name = $this->input->post('user_name');
		$password = $this->input->post('password');

		if (!empty($user_name) && !empty($password)) {
			$this->load->model('user_model');
			$user = $this->user_model->checklogin($user_name,$password);
			if($user){
				$data = array(
					'user_name' => $user['name_user'],
					'id_user'   => $user['id_user'],
					'user_type' => $user['user_type'],
					'activated_user' => $user['activated_user'],
					'logado'    => TRUE 
					);

				$this->session->set_userdata($data);
				$response = array('message' => 'OK','status'  => 1);
			} else $response = array('message' => 'Login inválido','status'  => 0);
		} else $response = array('message' => 'Erro no servidor','status'  => 0);

		header('Content-Type: application/json');
		echo json_encode( $response );
	}

	public function allUsers(){
		test_login($this);
		if(!is_admin($this)) redirect(site_url());
		$this->load->model('user_model');
		$users = $this->user_model->getAllUsers();
		$data = array('users' => $users);
		$this->load->view('user/all_users',$data);	
	}

	public function logout(){
		test_login($this);
		$this->session->sess_destroy();
		redirect(site_url());
	}

	public function configPassword(){
		test_login($this);
		$this->load->view('user/change_password');
	}

	public function changePassword(){
		test_login($this);
		$oldpswd = $this->input->post('oldpswd');
		$newpswd = $this->input->post('newpswd');
		$confpswd = $this->input->post('confpswd');
		$this->load->model('user_model');
		if(!empty($oldpswd) && !empty($newpswd) && !empty($confpswd)){
			$user = $this->user_model->checklogin($this->session->user_name,$oldpswd);
			if($user){
				if($newpswd==$confpswd){
					$this->user_model->changePassword($user['id_user'],$oldpswd,$newpswd);
					$response = array('message' => 'Senha alterada com sucesso!','status'  => 1);
				}else{
					$response = array('message' => 'As senhas não combinam','status'  => 0);
				}
			} else{
				$response = array('message' => 'Alteração de senha não autorizada','status'  => 0);
			}
		} else {
			$response = array('message' => 'Algo deu errado','status'  => 0);
		}

		header('Content-Type: application/json');
		echo json_encode( $response );
	}


	public function newUser(){
		test_login($this);
		if(!is_admin($this)) redirect(site_url());
		$this->load->model('user_model');
		$user_types = $this->user_model->getUserTypes();
		$data = array(
			'user_types' => $user_types
			);
		$this->load->view('user/new_user',$data);
	}

	public function createUser(){
		test_login($this);
		if(!is_admin($this)) redirect(site_url());
		$name_user = (string)$this->input->post('name_user');
		$user_type = (int)$this->input->post('user_type');
		
		if(!empty($user_type) && !empty($name_user)){
			$this->load->model('user_model');
			if($this->user_model->createUser($name_user,$user_type)){
				$response = array('message' => 'Usuário criado com sucesso! A senha padrão é "clinica".', 'status'  => 1);
			} else if($this->user_model->db->error()['code']=='1062') {
				$response = array('message' => 'Já existe um usuário com esse nome','status'  => 0);
			} else {
				$response = array('message' => 'Algo deu errado','status'  => 0);
			}
		} else {
			$response = array('message' => 'Preencha todos os campos','status'  => 0);
		}

		header('Content-Type: application/json');
		echo json_encode( $response );
	}

	public function firstLogin(){
		if($this->session->activated_user||!is_logado($this)) redirect(site_url());
		$this->load->view('user/activate_user');
	}

	public function activateUser(){
		test_login($this);
		$newpswd = $this->input->post('newpswd');
		$confpswd = $this->input->post('confpswd');
		$this->load->model('user_model');

		if(!empty($newpswd) && !empty($confpswd)){

			if($newpswd==$confpswd){
				if($this->user_model->activate($this->session->id_user,$newpswd)){

					$this->session->activated_user = 1;
					$response = array('message' => 'OK',
						'status'  => 1);
					
				}
			} else{
				$response = array('message' => 'As senhas não combinam',
					'status'  => 0);
			}
		} else{
			$response = array('message' => 'Erro no servidor',
				'status'  => 0);
		}

		header('Content-Type: application/json');
		echo json_encode( $response );
		

	}

	public function deleteUser(){
		test_login($this);
		if(is_admin($this)&&isset($_POST['id_user'])){

			$this->load->model('user_model');
			$id_user = (int) $this->input->post('id_user');
			$user = $this->user_model->getUserById($id_user);

			if($user['user_type'] != 1 || $user['id_user']== get_user_id($this)){



				$this->user_model->delete($id_user);
				$response = array('message'=>'Usuário exluído com sucesso', 'status'=>1);
				if($user['id_user'] == get_user_id($this)){
					return $this->logout();
				}


			} else $response = array('message'=>'Não foi possível exluir o usuário.', 'status'=>0);
		}	else if(!is_admin($this)){ 
				$response = array('message'=>'Você não tem permissão para isso!', 'status'=>0);
		}else $response = array('message'=>'Algo deu errado.', 'status'=>0);

		header('Content-Type: application/json');
		echo json_encode( $response );

	}

	public function resetUser(){
		test_login($this);
		if(is_admin($this)&&isset($_POST['id_user'])){

			$this->load->model('user_model');
			$id_user = (int) $this->input->post('id_user');
			$user = $this->user_model->getUserById($id_user);

			if($user['user_type'] != 1){

				$this->user_model->resetUser($id_user);
				$response = array('message'=>'Usuário resetado com sucesso. A sua senha foi alterada para "clinica"', 'status'=>1);
				if($user['id_user'] == get_user_id($this)){
					$this->logout();
				}


			} else $response = array('message'=>'Não foi possível resetar o usuário.', 'status'=>0);
		} else if(!is_admin($this)){ 
				$response = array('message'=>'Você não tem permissão para isso!', 'status'=>0);
		}else $response = array('message'=>'Algo deu errado.', 'status'=>0);

		header('Content-Type: application/json');
		echo json_encode( $response );
	}


}?>