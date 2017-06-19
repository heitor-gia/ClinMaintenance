<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_model extends CI_Model {

	public function getTicketsByItemBox($id_item,$id_box){
		$this->db->from('tickets');
		$this->db->where('id_item',$id_item);
		$this->db->where('id_box',$id_box);
		$tickets = $this->db->get();
		if($tickets){
			return $tickets->result_array();
		} else return FALSE;

	}

	public function getAllTickets($full=FALSE){
		if($full){
			
			$tickets = $this->db->query("SELECT t . * , f.item, f.num_box
				FROM tickets t
				INNER JOIN full_itens f ON ( f.id = t.id_item
				AND t.id_box = f.id_box ) 
				ORDER BY t.creation_ticket DESC");
			
			if($tickets){
				return $tickets->result_array();
			} else return FALSE;
		} else {
			$this->db->from('tickets');
			$tickets = $this->db->get();
			if($tickets){
				return $tickets->result_array();
			} else return FALSE;
		}
	}


	public function fetchTickets($limit,$start){
		$tickets = $this->db->query("SELECT t . * , f.item, f.num_box
			FROM tickets t
			INNER JOIN full_itens f ON ( f.id = t.id_item
			AND t.id_box = f.id_box )
			ORDER BY t.id_ticket DESC
			LIMIT ".$start.",".$limit);

		if($tickets){
			return $tickets->result_array();
		} else return FALSE;
	}

	public function getTicketsByBox($id_box){
		$this->db->from('tickets');
		$this->db->where('id_box',$id_box);
		$tickets = $this->db->get();
		if($tickets){
			return $tickets->result_array();
		} else return FALSE;

	}

	public function createTicket($id_item,$id_box,$description){
		if(empty($id_item)||empty($id_box)||empty($description)) return FALSE;
		$data = array(
			'id_item' 	  => $id_item,
			'id_box'  	  => $id_box,
			'description_ticket' => $description
			);
		if($this->db->insert('tickets',$data)){
			return TRUE;
		} else return FALSE;
	}

	public function closeTicket($id_ticket){
		
		if(empty($id_ticket)||!is_numeric($id_ticket)) return FALSE;
		$ticket = $this->db->select('close_ticket')
		->from('tickets')
		->where('id_ticket',$id_ticket)
		->get()->result_array();

		if (count($ticket)>0) {
			if($ticket[0]['close_ticket'] == NULL){	
				$this->db->set('close_ticket','NOW()',FALSE);
				$this->db->where('id_ticket',$id_ticket);
				$this->db->update('tickets');
				return $this->db->select('close_ticket')
				->from('tickets')
				->where('id_ticket',$id_ticket)
				->get()
				->result_array()[0]['close_ticket'];

			}else return FALSE;
		} else return FALSE;
	}

	public function getTicketByID($id_ticket){
		
		if(empty($id_ticket)||!is_numeric($id_ticket)) return FALSE;

		$this->db->where('id_ticket',$id_ticket);
		$this->db->from('tickets');
		return $this->db->get()->result_array()[0];
	}

	public function getTicketsAtDate($min,$max){
		 $this->db->select('t.id_ticket, f.item,f.num_box,t.creation_ticket,t.close_ticket,t.description_ticket')
				 ->from('full_itens f')
				 ->join('tickets t','(t.id_box=f.id_box AND t.id_item=f.id)','right');
				 if($min!=''&&$max!=''){
				 	$this->db->where('t.creation_ticket between "'.$min.' 00:00:00" and "'.$max.' 23:59:59"');
				 } elseif($min!=''){
				 	$this->db->where('t.creation_ticket >"'.$min.' 00:00:00"');
				 } elseif($max!=''){
				 	$this->db->where('t.creation_ticket <"'.$max.' 23:59:59"');
				 }
				$query = $this->db->order_by('t.id_ticket desc') ->get()->result_array();
		return $query;
	}
	
	public function recordBoxes(){
		 $this->db->select('f.item, f.num_box, f.operating, b.tickets as box_tickets')
				 ->from('full_itens f')
				 ->join('boxes_maintence b',"b.id_box = f.id_box");
				$query = $this->db->get()->result_array();

		foreach ($query as $item) {
			$boxes[$item['num_box']][] = $item;
		}
		return $boxes;
	}
	public function recordItens(){
		 $this->db->select('f.id,f.item, f.num_box, f.operating, t.tickets as item_tickets')
				 ->from('full_itens f')
				 ->join('tickets_item t',"(f.id = t.id_item and f.id_box=t.id_box)");
				$query = $this->db->get()->result_array();

		foreach ($query as $item) {
			$boxes[$item['id']][] = $item;
		}
		return $boxes;
	}
	


}