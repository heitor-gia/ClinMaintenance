<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*teste de login*/
if ( ! function_exists('is_logado'))
{
	function is_logado($obj)
	{
		return $obj->session->logado;
	}   
}

/*teste de usuário administrador*/
if ( ! function_exists('is_admin'))
{
	function is_admin($obj)
	{
		return $obj->session->user_type==1;
	}   
}

/*teste de usuário responsável*/
if ( ! function_exists('is_responsable'))
{
	function is_responsable($obj)
	{
		return $obj->session->user_type==2;
	}   
}

/*teste de usuário manutenção*/
if ( ! function_exists('is_maintence'))
{
	function is_maintence($obj)
	{
		return $obj->session->user_type==3;
	}   
}

/*testa se o usuário está ativado ou não */
if ( ! function_exists('is_activated'))
{
	function is_activated($obj)
	{

		if($obj->session->activated_user){
			return true;
		} else return false;
	}   
}

/*teste de login e ativação*/
if ( ! function_exists('test_login'))
{
	function test_login($obj)
	{
		if($obj->session->logado){
			
			if(is_activated($obj)){
			
				return;
			
			} else header("location:".site_url('users/firstlogin'));

		} else header("location:".site_url('login'));
	}   
}

/*Retorna o id do usuário logado*/
if ( ! function_exists('get_user_id'))
{
	function get_user_id($obj){

		return $obj->session->id_user;
	}   
}



