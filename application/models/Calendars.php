<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendars extends CI_Model{
	public function personals(){
		$myid=$this->session->userdata('id');
		$branch=$this->uri->segment(2);
		$persnId=$this->uri->segment(3);
		$this->db->select('firstname,avatar,personal.id as personalId,role,lastname,spec');
		$this->db->where('branch',$branch);
		if($persnId){
			$this->db->where('id !=',$persnId);
		}
		$this->db->where('role = 3');
		if($this->session->userdata('role')==3)$this->db->where('id',$myid);
		if($this->session->userdata('role')==2){
			$branch=$this->session->userdata('branch');
			$this->db->where('branch',$branch);
		}
		$rows=$this->db->get('personal')->result_array();
		$selectPerson='';
		if($persnId){
			$this->db->select('firstname,avatar,personal.id as personalId,role,lastname,spec');
			$this->db->where('id',$persnId);
			$this->db->where('role','3');
			$this->db->where('branch',$branch);
			$selectPerson=$this->db->get('personal')->row_array();

			$this->db->where('role','3');
			$pers=$this->db->get('personal')->row_array();
			if($selectPerson)array_unshift($rows,$selectPerson);	
			else{
				if($this->session->userdata('role')==1)redirect('office/1/'.$pers['id']);
			}
		}
		return $rows;
	}
	public function personalRole(){
		$this->db->select('id,role');
		$this->db->where('id',$this->session->userdata('id'));
		return $this->db->get('personal')->row_array()['role'];
	}
	public function branches(){
		$this->db->where('company_id',$this->session->userdata('company'));
		return $this->db->get('branches')->result_array();		
	}
}
