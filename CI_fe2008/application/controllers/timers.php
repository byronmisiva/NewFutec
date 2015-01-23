<?php
class Timers extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->model('timer');
		$this->load->model('statistic');
	}
	
	function index()
	{
		$config['base_url']=base_url().'/timers/index/'.$this->uri->segment(3);
		$row=$this->db->query('SELECT COUNT(*) AS numrows FROM timers where match_id = '.$this->uri->segment(3))->result(0);
		$config['total_rows']=$row[0]->numrows;
		$config['per_page']='10';
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "CRON&Oacute;METRO ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    if(!$this->uri->segment(4)=='')
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
		$data['query']=$this->db->query("SELECT *
										 FROM timers
										 WHERE timers.match_id =".$this->uri->segment(3)." ".$pagina);
		$data['query2']=$this->db->query('SELECT group_id
						  				  FROM matches 
						  				  WHERE id='.$this->uri->segment(3));
		$this->load->view('timers_view',$data);
	}	

	function timers_vinsert()
	{
		$data['title'] = "CRON&Oacute;METRO ";
		$data['heading'] = "INGRESO";
		$this->load->view('timers_vinsert',$data);
	}
	
	function insert(){
		$sts=$this->db->query('SELECT state,live 
							   FROM matches
							   WHERE id='.$this->uri->segment(3))->result();
		
		$lst2=$this->db->query('SELECT id, action
							   FROM timers
							   WHERE match_id='.$this->uri->segment(3).'
							   ORDER BY id desc');
		
		if($sts[0]->live==0)
			$this->db->query('Update matches set live=1 where id='.$this->uri->segment(3));
		$_POST['action']=0;
		if($lst2->num_rows()>0){
			$lst=$lst2->result();
			if($lst[0]->action!=$this->uri->segment(4)){
				if($lst[0]->action==1)	
					$_POST['action']=2;
				else
					$_POST['action']=1;
			}
		}
		else{
			if($this->uri->segment(4)==1)
				$_POST['action']=1;
		}
		if($_POST['action']!=0){
			$_POST['id']=0;
			$_POST['match_id']=$this->uri->segment(3);
			$_POST['time']=mdate("%Y-%m-%d  %h:%i:%s",time());				
			$_POST['play_time']=$sts[0]->state;
			$this->db->insert('timers',$_POST);
		}
	}
	
	function timers_delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('timers'); 
		redirect('timers/index/'.$this->uri->segment(4));
	}
	
	function timers_vupdate()
	{	
		$data['title'] = "CRON&Oacute;METRO ";
		$data['heading'] = "ACTUALIZAR";
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('timers');								
		$this->load->view('timers_vupdate',$data);
	}	
	
	function timers_update()
	{
   		$this->db->where( 'id',$_POST['id']);
   		$this->db->update('timers', $_POST);
   		redirect('timers/index/'.$_POST['match_id']);
	}	
	
	function cal_time(){
		$this->config->set_item('compress_output', 'FALSE');
		
		if($this->config->item("encryption_key")==$this->uri->segment(4)){
			$data['name']='XML Calculo del Tiempo de Juego';
			$data['views']=1;
			$this->statistic->sum($data);
			
			header('Content-type: text/xml');
			print "<?xml version='1.0' standalone='yes'?>
				   <timer>
				   ".$this->timer->cal_time($this->uri->segment(3))."
				   </timer>";
		}
	}
}
?>