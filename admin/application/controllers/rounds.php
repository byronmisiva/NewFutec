<?php
class Rounds extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('round','model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->set_rules('name', 'Nombre', 'required');
		$this->form_validation->set_rules('last', 'Anterior', '');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$config['upload_path']='./imagenes/rounds/';
   		$config['allowed_types']='gif|jpg|png|swf';
   		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['encrypt_name'] = TRUE;
   		$this->load->library('upload',$config);
   		$this->load->library('session');
	}
	
	function index()
	{
		$config['base_url']=base_url().'/rounds/index/'.$this->uri->segment(3);
		$row=current($this->db->query('SELECT COUNT(*) AS numrows FROM rounds where championship_id = '.$this->uri->segment(3))->result());
		$config['total_rows']=$row->numrows;
		$config['per_page']='10';
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "RONDAS ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    if(!$this->uri->segment(4)=='')
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
	    $data['query']=$this->db->query("SELECT r.*, o.name as oname
										 FROM (SELECT r.id, r.name, c.name as cname, r.image, r.priority, r.last 
      										   FROM (rounds as r, championships as c) 
      										   WHERE r.championship_id=c.id and c.id=".$this->uri->segment(3).') as r
											   LEFT JOIN rounds as o ON r.last=o.id 
											   ORDER BY r.priority DESC '.$pagina);
		$cn=$this->db->query("SELECT c.name
							  FROM championships as c
							  WHERE c.id=".$this->uri->segment(3))->result();
	    $data['from']=strtoupper($cn[0]->name);
		$this->view('rounds_view',$data);
	}	


	function insert()
	{
		$data['title'] = "RONDAS ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){	
			if($_POST['last']=='')
   				$_POST['last']=NULL;    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				if($this->upload->do_upload('image')){
		    		$upload=$this->upload->data();
					$_POST['image']='/imagenes/rounds/'.$upload['file_name'];
		    	}
		    	$this->session->set_flashdata('errors_image', $this->upload->display_errors());
	   			$_POST['priority']=$this->priority($_POST['championship_id'])+1;
	   			$this->db->insert('rounds', $_POST);
		    	redirect('rounds/index/'.$_POST['championship_id']);
		    }	
		}
		$this->db->where( 'championship_id',$this->uri->segment(3));
		$data['query']=$this->db->get('rounds');
		$this->view('rounds_vinsert',$data);
	}
	
	function ajax_insert(){
		unset($_POST['agregar']);
		
		$last_priority=$this->model->get_last_priority($_POST['championship_id']);
		
		$aux['championship_id']=$_POST['championship_id'];
		$aux['name']=$_POST['name'];
		$aux['image']="";
		$aux['priority']=$last_priority+1;
		$aux['last']=0;
		$this->db->insert('rounds',$aux);

    	$data['rounds']=$this->model->get_by_championship($_POST['championship_id']);
    	$data['anuncio']="La ronda: '".$aux['name']."' ha sido agregada.";
    	$data['championship']->id=$_POST['championship_id'];
    	
    	$this->load->view('rounds/ajax_view',$data);
	}
	
	function delete(){
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('rounds'); 
        if($this->db->_error_message()==""){
			$query=$this->db->query("SELECT id, priority
		   				         FROM rounds
		   				         WHERE championship_id=".$this->uri->segment(4)."
		   				         ORDER BY priority DESC");
	   		foreach($query->result() as $row):
				if($row->priority < $this->uri->segment(5)){
					$priority['priority']=$row->priority+1;
					$this->db->where( 'id',$row->id);
	   				$this->db->update('rounds', $priority);
				}
			endforeach;
		}
		else{
			$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
		redirect('rounds/index/'.$this->uri->segment(4));
	}
	
	function ajax_delete(){
		$id=$this->uri->segment(3);
		$champ=$this->uri->segment(4);
		$item=$this->model->delete($id);

		$data['rounds']=$this->model->get_by_championship($champ);
    	$data['anuncio']="La ronda: '".$item->name."' ha sido eliminada.";
    	$data['championship']->id=$champ;
    	
    	$this->load->view('rounds/ajax_view',$data);
	}
	
	function confirm_delete(){
		$this->load->view('rounds_confirm_delete');	
	}

	function update()
	{
		$data['title'] = "RODAS ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){
   			if($_POST['last']=='')
   				$_POST['last']=NULL;	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				if($this->upload->do_upload('image')){
	    			$upload=$this->upload->data();
					$_POST['image']='/imagenes/rounds/'.$upload['file_name'];
		    	}
		    	$this->session->set_flashdata('errors_image', $this->upload->display_errors());
		    	$this->db->where( 'id',$_POST['id']);
	   			$this->db->update('rounds', $_POST);
	   			redirect('rounds/index/'.$_POST['championship_id']);
		    }	
		}		
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=current( $this->db->get('rounds')->result() );		
		$this->db->where( 'championship_id',$this->uri->segment(4));
		$data['query2']=$this->db->get('rounds');
		$this->view('rounds_vupdate',$data);
	}	
	
	function priority($championship)
	{
		$row=$this->db->query("SELECT MAX(priority) as priority
		   				       FROM rounds
		   				       WHERE championship_id=".$championship)->result(0);
		return $row[0]->priority;
	}
	
	function priority_up()
	{
		$row=$this->db->query("SELECT MAX(priority) as priority
		   				       FROM rounds
		   				       WHERE championship_id=".$this->uri->segment(4))->result(0);
		$row2=$this->db->query("SELECT priority
								FROM rounds
								WHERE id=".$this->uri->segment(3))->result(0);
		$row3=$this->db->query("SELECT MIN(priority) as priority
		   				        FROM rounds
		   				        WHERE championship_id=".$this->uri->segment(4))->result(0);
		if($row2[0]->priority==$row[0]->priority)
		{
			$priority['priority']=$row3[0]->priority-1;
			$this->db->where( 'id',$this->uri->segment(3));
   		    $this->db->update('rounds', $priority);
		}
		else
		{
			$query=$this->db->query("SELECT id, priority
		   				       		 FROM rounds
		   				       		 WHERE championship_id=".$this->uri->segment(4)."
		   				       		 ORDER BY priority DESC");
			$aux=0;
			foreach($query->result() as $row):
				if($row->priority==$row2[0]->priority+1)
					$aux=1;
				if($row->priority!=$row2[0]->priority+1)
				{
					$priority['priority']=$row->priority+1+$aux;
					$this->db->where( 'id',$row->id);
   					$this->db->update('rounds', $priority);
   					$aux=0;	
				}
			endforeach;
		}
   		redirect('rounds/index/'.$this->uri->segment(4));
	}
	
	function priority_down()
	{
		$row=$this->db->query("SELECT MAX(priority) as priority
		   				       FROM rounds
		   				       WHERE championship_id=".$this->uri->segment(4))->result(0);
		$row2=$this->db->query("SELECT priority
								FROM rounds
								WHERE id=".$this->uri->segment(3))->result(0);
		$row3=$this->db->query("SELECT MIN(priority) as priority
		   				        FROM rounds
		   				        WHERE championship_id=".$this->uri->segment(4))->result(0);
		if($row2[0]->priority==$row3[0]->priority)
		{
			$priority['priority']=$row[0]->priority+1;
			$this->db->where( 'id',$this->uri->segment(3));
   		    $this->db->update('rounds', $priority);
		}
		else
		{
			$query=$this->db->query("SELECT id, priority
		   				       		 FROM rounds
		   				       		 WHERE championship_id=".$this->uri->segment(4)."
		   				       		 ORDER BY priority ASC");
			$aux=0;
			foreach($query->result() as $row):
				if($row->priority==$row2[0]->priority-1)
					$aux=-1;
				if($row->priority!=$row2[0]->priority-1)
				{
					$priority['priority']=$row->priority-1+$aux;
					$this->db->where( 'id',$row->id);
   					$this->db->update('rounds', $priority);
   					$aux=0;	
				}
			endforeach;
		}
   		redirect('rounds/index/'.$this->uri->segment(4));
	}
	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
}
?>