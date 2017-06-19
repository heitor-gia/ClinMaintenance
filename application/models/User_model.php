<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	//Checa o login retornando o usuário a ser logado ou FALSE
	public function checklogin($nome,$senha){
		$this->db->from('users');
		$this->db->where('name_user',$nome);
		$user = $this->db->get()->result_array();
		if($user){
			$user = $user[0];
			if ($user['password_user']==md5($senha)){
				return $user;
			} else return FALSE;
			
		} else return FALSE;
	}

	//Altera senha do usuário para uma senha determinada
	public function changePassword($id,$senha,$novasenha){
		$this->db->from('users');
		$this->db->where('id_user',$id);
		$user = $this->db->get()->result_array();
		if($user){
			
			$user = $user[0];
			if ($user['password_user']==md5($senha)){
				
				return  $this->db->set('password_user', md5($novasenha))
				->where('id_user', $user['id_user'])
				->update('users');
				
				
			} else return FALSE;
		} else return FALSE;
	}

	public function getUserById($id_user){
		$this->db->from('users');
		$this->db->where('id_user',$id_user);
		return $this->db->get()->result_array()[0];	
		

	}

	public function createUser($user_name,$user_type){
		

			$data = array(
				'name_user' => $user_name,
				'user_type' => $user_type,
				'password_user' => md5('clinica')
			);
			return $this->db->insert('users',$data);

		
	}

	public function getUserTypes(){
		$this->db->from('user_types');
		$types = $this->db->get();
		return $types->result_array() ;
	}

	public function getAllUsers(){
		$this->db->from('users');
		$this->db->join('user_types','users.user_type = user_types.id_user_type');
		return $this->db->get()->result_array();
	}

	public function activate($id_user, $password){
		
		if ($password){

			return  $this->db->set('password_user', md5($password))
			->set('activated_user',TRUE)
			->where('id_user', $id_user)
			->update('users');

		} else return FALSE;
	}

	public function delete($id_user){

		if(is_numeric($id_user)){
			$this->db->where('id_user',$id_user);
			return  $this->db->delete('users');
		} else return FALSE;
	}

	public function resetUser($id_user){
		if($id_user){
			return  $this->db
			->set('activated_user',FALSE)
			->where('id_user', $id_user)
			->update('users');
		}
	}

}
?>