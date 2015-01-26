<?php
class Images extends CI_Controller {

	var $tmpl;
	
	function __construct(){
		parent::__construct();
		$this->load->model('image','model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Nombre', 'required');
		$this->form_validation->set_rules('text', 'Texto', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$config['upload_path']='./imagenes/images/original/';
		$config['allowed_types']='gif|jpg|png|swf';
		$config['max_size']	= '100000';
		$config['max_width']  = '4000';
		$config['max_height']  = '4000';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload',$config);
		$this->load->library('image_lib');
		 
		$this->tmpl = array (
                    'table_open'          => '<table class="listing_images" cellpadding="0" cellspacing="0">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr class="altrow">',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td align="center">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td align="center">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
                    );
                    
		//Validacion ACL
		$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
	}

	function index()
	{
		$this->load->library('table');
		$this->template->add_js('js/calendar.js');
		
		
		if($this->uri->segment(3)!='')
			$result=$this->model->get_all_letter($this->uri->segment(3));
		else
			$result=$this->model->get_all_letter('A');

		$datos=array();
		foreach($result as $row){
			$image_size=getimagesize("http://www.futbolecuador.com/" .$row->thumb640);
			$height=$image_size[1]+80;
			$width=$image_size[0]+80;
			$aux ="\n<table class='item' width='110' cellpadding='0' cellspacing='0'>\n";
			$aux.="<tr><td colspan='4'>".anchor('images/update/'.$row->id,img(array('src'=>$row->thumb100,'border'=>'0')), array('title' => 'Cambiar Imagen'))."</td><tr>\n";
			
			$aux.="<tr><td colspan='4'>".$row->name."</td><tr>\n";
			$aux.="<tr>\n";
			$aux.="<td>";
			if($row->thumbh160!="")
			$aux.=anchor('images/view_thumbh/'.$row->id,img(array('src'=>'imagenes/icons/thome1.gif','border'=>'0')), array('title' => 'Home Thumbnail','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 180}); return false;'));
			$aux.="</td>\n";
			$aux.="<td>".anchor('images/view_thumb/'.$row->id,img(array('src'=>'imagenes/icons/thumb1.gif','border'=>'0')), array('title' => 'Thumbnail','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 450}); return false;'))."</td>\n";
			$aux.="<td>".anchor('images/edit_thumb/'.$row->id,img(array('src'=>'imagenes/icons/cortar1.gif','border'=>'0')), array('title' => 'Recortar','onclick'=>'abrir_popup(this.href,\'no\',\'no\',\'no\',\'no\',\'no\',\'yes\',\'no\','.$width.','.$height.',100,10,0); return false;'))."</td>\n";
			$aux.="<td>".anchor('images/confirm_delete/'.$row->id,img(array('src'=>'imagenes/icons/borrar1.gif','border'=>'0')), array('title' => 'Eliminar','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'))."</td>\n";
			$aux.="</tr>\n";
			$aux.="</table>\n";
			$datos[]=$aux;
		}

		$this->table->set_template($this->tmpl);

		$new_list = $this->table->make_columns($datos, 7);


		$data['title'] = "IM&Aacute;GENES ";
		$data['heading'] = "ACCESO";
		$data["table"]= $this->table->generate($new_list);
		$this->view($this->model->name.'/view',$data);
	}

	function view_thumbh(){
		$imagen=$this->model->get($this->uri->segment(3));
		$data['thumb']=$imagen->thumbh160;
		$data['tam']=getimagesize($data['thumb']);
		$data['name']=$imagen->name;
		$data['descripcion']=$imagen->text;
		$this->load->view($this->model->name.'/view_thumb',$data);
	}

	function view_thumb(){
		$imagen=$this->model->get($this->uri->segment(3));
		$data['thumb']=$imagen->thumb400;
		$data['tam']=getimagesize($data['thumb']);
		$data['name']=$imagen->name;
		$data['descripcion']=$imagen->text;
		$this->load->view($this->model->name.'/view_thumb',$data);
	}

	function insert(){
		$this->config->set_item('compress_output', 'FALSE');
		$data['title'] = "IM&Aacute;GENES ";
		$data['heading'] = "INGRESO";

		if(isset($_POST['submit'])){
			if($this->form_validation->run()==TRUE){
				$letter=substr($_POST['name'],0,1);
				unset($_POST['submit']);
				if($this->upload->do_upload('original')){
					$upload=$this->upload->data();
					$_POST['original']='imagenes/images/original/'.$upload['file_name'];
					$_POST['thumb640']="imagenes/images/thumb640/".$upload['file_name'];
					$_POST['thumb500']="imagenes/images/thumb500/".$upload['file_name'];
					$_POST['thumb400']="imagenes/images/thumb400/".$upload['file_name'];
					$_POST['thumb300']="imagenes/images/thumb300/".$upload['file_name'];
					$_POST['thumb150']="imagenes/images/thumb150/".$upload['file_name'];
					$_POST['thumb100']="imagenes/images/thumb100/".$upload['file_name'];
					$_POST['thumbh160']="";
					$_POST['thumbh120']="";
					$_POST['thumbh80']="";
					$_POST['thumbh50']="";
					$_POST['created']=mdate("%Y-%m-%d  %h:%i:%s ",time());
					$this->db->insert('images', $_POST);
					$dimension['file_name']=$upload['full_path'];
					$dimension['width']=640;
					$this->images_thumb($dimension);
					$dimension['width']=500;
					$this->images_thumb($dimension);
					$dimension['width']=400;
					$this->images_thumb($dimension);
					$dimension['width']=300;
					$this->images_thumb($dimension);
					$dimension['width']=150;
					$this->images_thumb($dimension);
					$dimension['width']=100;
					$this->images_thumb($dimension);
					redirect($this->model->name.'/index/'.$letter);
				}
			}
		}
		$this->view($this->model->name.'/insert',$data);
	}

	function delete(){
		if($this->model->delete($_POST['id']))
		redirect($this->model->name);
	}

	function confirm_delete(){
		$data['id']=$this->uri->segment(3);
		$this->load->view($this->model->name.'/confirm_delete',$data);
	}

	function update($id)
	{
		$data['title'] = "IM&Aacute;GENES ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){
			if($this->form_validation->run()==TRUE){
				$letter=substr($_POST['name'],0,1);
				unset($_POST['submit']);
				if($this->upload->do_upload('original')){
					$upload=$this->upload->data();
					$_POST['original']='imagenes/images/original/'.$upload['file_name'];
					$_POST['thumb640']="imagenes/images/thumb640/".$upload['file_name'];
					$_POST['thumb500']="imagenes/images/thumb500/".$upload['file_name'];
					$_POST['thumb400']="imagenes/images/thumb400/".$upload['file_name'];
					$_POST['thumb300']="imagenes/images/thumb300/".$upload['file_name'];
					$_POST['thumb150']="imagenes/images/thumb150/".$upload['file_name'];
					$_POST['thumb100']="imagenes/images/thumb100/".$upload['file_name'];
					$_POST['thumbh160']="";
					$_POST['thumbh120']="";
					$_POST['thumbh80']="";
					$_POST['thumbh50']="";
					
					$this->db->where( 'id',$_POST['id']);
					$this->db->update('images', $_POST);
					$dimension['file_name']=$upload['full_path'];
					$dimension['width']=640;
					$this->images_thumb($dimension);
					$dimension['width']=500;
					$this->images_thumb($dimension);
					$dimension['width']=400;
					$this->images_thumb($dimension);
					$dimension['width']=300;
					$this->images_thumb($dimension);
					$dimension['width']=150;
					$this->images_thumb($dimension);
					$dimension['width']=100;
					$this->images_thumb($dimension);
				}
				else{
					$data = array('name' => $_POST['name'], 'text' => $_POST['text']);
					$this->db->where( 'id',$_POST['id']);
					$this->db->update('images', $data);
				}
				redirect($this->model->name.'/index/'.$letter);
			}
		}
		$this->db->where('id',$id);
		$data['row']=current($this->db->get('images')->result());
		$this->view($this->model->name.'/update',$data);
	}

	function images_thumb($dimension,$prefix='')
	{
		$this->image_lib->clear();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $dimension['file_name'];
		$config['new_image']='./imagenes/images/thumb'.$prefix.$dimension['width'].'/';
		//$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = $dimension['width'];
		$config['height'] = $dimension['width'];
		$config['master_dim']='width';
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}

	function oldest(){
		$this->load->library('table');
		
		$result=$this->model->get_not_used();
		$datos=array();
		foreach($result as $row){
			$image_size=getimagesize($row->thumb640);
			$height=$image_size[1]+80;
			$width=$image_size[0]+80;
			$aux ="\n<table class='item' width='110' cellpadding='0' cellspacing='0'>\n";
			$aux.="<tr><td colspan='4'>".anchor('images/update/'.$row->id,img(array('src'=>$row->thumb100,'border'=>'0')), array('title' => 'Cambiar Imagen'))."</td><tr>\n";
				
			$aux.="<tr><td colspan='4'>".$row->name."</td><tr>\n";
			$aux.="<tr>\n";
			$aux.="<td>";
			if($row->thumbh160!="")
				$aux.=anchor('images/view_thumbh/'.$row->id,img(array('src'=>'imagenes/icons/thome1.gif','border'=>'0')), array('title' => 'Home Thumbnail','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 180}); return false;'));
			$aux.="</td>\n";
			$aux.="<td>".anchor('images/view_thumb/'.$row->id,img(array('src'=>'imagenes/icons/thumb1.gif','border'=>'0')), array('title' => 'Thumbnail','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 450}); return false;'))."</td>\n";
			$aux.="<td>".anchor('images/edit_thumb/'.$row->id,img(array('src'=>'imagenes/icons/cortar1.gif','border'=>'0')), array('title' => 'Recortar','onclick'=>'abrir_popup(this.href,\'no\',\'no\',\'no\',\'no\',\'no\',\'yes\',\'no\','.$width.','.$height.',100,10,0); return false;'))."</td>\n";
			$aux.="<td>".anchor('images/confirm_delete/'.$row->id,img(array('src'=>'imagenes/icons/borrar1.gif','border'=>'0')), array('title' => 'Eliminar','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'))."</td>\n";
			$aux.="</tr>\n";
			$aux.="</table>\n";
			$datos[]=$aux;
		}
		
		$this->table->set_template($this->tmpl);
		
		$new_list = $this->table->make_columns($datos, 7);
		
		
		$data['title'] = "IM&Aacute;GENES ";
		$data['heading'] = "ACCESO";
		$data["table"]= $this->table->generate($new_list);
		$this->view($this->model->name.'/oldest',$data);
		
	}
	/*
	 *  FUNCION PARA LIMPIAR LAS CARPETAS DE IMAGENES GENERADAS
	 *  /imagenes/images/*
	 */
	function cleanup(){
		$result=$this->db->get('images')->result();
		echo count($result)."\n";
		
		if ($handle = opendir('./imagenes/images/thumbh80')) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					echo "$entry\n";
				}
				}
				closedir($handle);
		}
		
		
	}
	
	function view($ver,$data)
	{
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}

	function get_path(){
		$this->config->set_item('compress_output', 'FALSE');
		$id=$this->uri->segment(3);
		$this->db->where( 'id',$id);
		$row=current($this->db->get('images')->result());
		if($row->thumbh120 != "")
			echo $row->thumbh120;
		else
			echo $row->thumb100;
	}

	function edit_thumb(){
		$id=$this->uri->segment(3);
		$imagen=$this->model->get($id);

		$data['id']=$id;
		$data['path']=base_url();
		$data['name']=$imagen->name;
		$data['thumb']=$imagen->thumb640;
		$data['tam']=getimagesize($data['thumb']);

		$this->load->view($this->model->name.'/edit_thumb',$data);
	}

	function crop(){
		
		$this->config->set_item('compress_output', 'FALSE');
		$imagen=$this->model->get($_POST['id']);
		
		// now crop the image from the center
		$config['image_library']        = 'GD2';
		$config['source_image']         = $imagen->thumb640;
		$config['new_image']			='./imagenes/images/crop/';
		$config['width']                = $_POST['width'];
		$config['height']               = $_POST['height'];
		$config['x_axis']               = $_POST['x1'];
		$config['y_axis']               = $_POST['y1'];
		$config['maintain_ratio']       = false;
		
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		if ( ! $this->image_lib->crop()){
			echo $this->image_lib->display_errors();
		}
		else{
			$filename='./imagenes/images/crop/'.$this->image_lib->source_image;
			$dimension['file_name']=$filename;
			$dimension['width']=160;
			$this->images_thumb($dimension,'h');
			$dimension['width']=120;
			$this->images_thumb($dimension,'h');
			$dimension['width']=80;
			$this->images_thumb($dimension,'h');
			$dimension['width']=50;
			$this->images_thumb($dimension,'h');
			
			$update_data['thumbh160']='imagenes/images/thumbh160/'.$this->image_lib->source_image;
			$update_data['thumbh120']='imagenes/images/thumbh120/'.$this->image_lib->source_image;
			$update_data['thumbh80']='imagenes/images/thumbh80/'.$this->image_lib->source_image;
			$update_data['thumbh50']='imagenes/images/thumbh50/'.$this->image_lib->source_image;
			
			$this->db->where( 'id',$_POST['id']);
			$this->db->update($this->model->name, $update_data);
		}
		echo "<script type='text/javascript' charset='utf-8'> opener.location.reload(true); self.close(); </script>";
	}
	
	function no_thumb(){
		$this->load->library('table');
		
		$result=$this->model->get_no_thumb();
	
		$datos=array();
		foreach($result as $row){
			$height=getimagesize('/' . $row->thumb640);
			$height=$height[1]+80;
			$aux ="\n<table class='item' width='110' cellpadding='0' cellspacing='0'>\n";
			$aux.="<tr><td colspan='4'>".anchor('images/update/'.$row->id,img(array('src'=>$row->thumb100,'border'=>'0')), array('title' => 'Cambiar Imagen'))."</td><tr>\n";
			
			$aux.="<tr><td colspan='4'>".$row->name."</td><tr>\n";
			$aux.="<tr>\n";
			$aux.="<td>";
			if($row->thumbh160!="")
			$aux.=anchor('images/view_thumbh/'.$row->id,img(array('src'=>'imagenes/icons/thome1.gif','border'=>'0')), array('title' => 'Home Thumbnail','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 180}); return false;'));
			$aux.="</td>\n";
			$aux.="<td>".anchor('images/view_thumb/'.$row->id,img(array('src'=>'imagenes/icons/thumb1.gif','border'=>'0')), array('title' => 'Thumbnail','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 450}); return false;'))."</td>\n";
			$aux.="<td>".anchor('images/edit_thumb/'.$row->id,img(array('src'=>'imagenes/icons/cortar1.gif','border'=>'0')), array('title' => 'Recortar','onclick'=>'abrir_popup(this.href,\'no\',\'no\',\'no\',\'no\',\'no\',\'yes\',\'no\',700,'.$height.',100,10,0); return false;'))."</td>\n";
			$aux.="<td>".anchor('images/confirm_delete/'.$row->id,img(array('src'=>'imagenes/icons/borrar1.gif','border'=>'0')), array('title' => 'Eliminar','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'))."</td>\n";
			$aux.="</tr>\n";
			$aux.="</table>\n";
			$datos[]=$aux;
		}

		$this->table->set_template($this->tmpl);

		$new_list = $this->table->make_columns($datos, 7);


		$data['title'] = "IM&Aacute;GENES ";
		$data['heading'] = " SIN THUMB";
		$data["table"]= $this->table->generate($new_list);
		$this->view('images_no_pic_view',$data);
	}
	
	function thumb500(){
		$query=$this->db->query('Select id,original,thumb640 from images');
		
		foreach($query->result() as $row){
			$data['thumb500']='imagenes/images/thumb500/'.strrchr($row->thumb640,'/');
			$dimension['file_name']="/var/www/vhosts/futbolecuador.com/subdomains/new/httpdocs/".$row->thumb640;
			
			$dimension['width']=500;
			$this->images_thumb($dimension);
			$this->db->where( 'id',$row->id);
			$this->db->update('images', $data);
		}
	}
	
	function images_review(){
		$this->load->library('pagination');		
		$selectImagesToDelete = 'SELECT id, name, thumb300 
				FROM fe2008.images
				WHERE created < (NOW() - INTERVAL 1 YEAR) and id not in (
				SELECT distinct image_id
				FROM fe2008.stories
				WHERE created > (NOW() - INTERVAL 1 YEAR) and image_id IS NOT NULL order by created desc)';		
		if( !$this->uri->segment(3) ){
			$selectImagesToDelete = $selectImagesToDelete . " limit 80";						
		}
		else{
			$selectImagesToDelete = $selectImagesToDelete . " limit 80, ".$this->uri->segment(3);
		}		
		$data['images'] = $this->db->query( $selectImagesToDelete )->result();	
		$data['ini_row'] = $this->uri->segment(3);
		$data['total_rows'] = $this->db->query('SELECT count(*) as valor
				FROM fe2008.images
				WHERE created < (NOW() - INTERVAL 1 YEAR) and id not in (
				SELECT distinct image_id
				FROM fe2008.stories
				WHERE stories.image_id = images.id   AND created > (NOW() - INTERVAL 1 YEAR) and image_id IS NOT NULL order by created desc)')->result();
		$config['base_url'] = base_url().'images/images_review/';
		$config['total_rows'] = current( $data['total_rows'] )->valor;
		$config['per_page'] = 80;	
		$config['num_links'] = 30;
		$this->pagination->initialize($config);				
		$this->view( 'images/images_review', $data );
	}
	
	function images_review_load( $page ){
		$this->load->library('pagination');
		$selectImagesToDelete = 'SELECT id, name, thumb300
		FROM fe2008.images
		WHERE created < (NOW() - INTERVAL 1 YEAR) and id not in (
		SELECT distinct image_id
		FROM fe2008.stories
		WHERE created > (NOW() - INTERVAL 1 YEAR) and image_id IS NOT NULL order by created desc)';
		if( !$page ){
			$selectImagesToDelete = $selectImagesToDelete . " limit 80";
		}
		else{
			$selectImagesToDelete = $selectImagesToDelete . " limit 80, ".$page;
		}
		$data['images'] = $this->db->query( $selectImagesToDelete )->result();
		$data['ini_row'] = $page;
		$data['total_rows'] = $this->db->query('SELECT count(*) as valor
				FROM fe2008.images
				WHERE created < (NOW() - INTERVAL 1 YEAR) and id not in (
				SELECT distinct image_id
				FROM fe2008.stories
				WHERE stories.image_id = images.id   AND  created > (NOW() - INTERVAL 1 YEAR) and image_id IS NOT NULL order by created desc)')->result();
		$config['base_url'] = base_url().'images/images_review/';
		$config['total_rows'] = current( $data['total_rows'] )->valor;
		$config['per_page'] = 80;
		$config['num_links'] = 30;
		$this->pagination->initialize($config);
		$this->load->view( 'images/images_review', $data );
	}
	
	function delete_images_files(){		
		$image_to_delete = $this->model->get( $_POST['data'] );	
		unlink( "/var/www/vhosts/futbolecuador.com/subdomains/new/httpdocs/".$image_to_delete->thumb640 );		
		unlink( "/var/www/vhosts/futbolecuador.com/subdomains/new/httpdocs/".$image_to_delete->thumb500 );
		unlink( "/var/www/vhosts/futbolecuador.com/subdomains/new/httpdocs/".$image_to_delete->thumb400 );
		unlink( "/var/www/vhosts/futbolecuador.com/subdomains/new/httpdocs/".$image_to_delete->thumb300 );
		unlink( "/var/www/vhosts/futbolecuador.com/subdomains/new/httpdocs/".$image_to_delete->thumb150 );
		unlink( "/var/www/vhosts/futbolecuador.com/subdomains/new/httpdocs/".$image_to_delete->thumb100 );
		unlink( "/var/www/vhosts/futbolecuador.com/subdomains/new/httpdocs/".$image_to_delete->thumbh160 );
		unlink( "/var/www/vhosts/futbolecuador.com/subdomains/new/httpdocs/".$image_to_delete->thumbh120 );
		unlink( "/var/www/vhosts/futbolecuador.com/subdomains/new/httpdocs/".$image_to_delete->thumbh80 );
		unlink( "/var/www/vhosts/futbolecuador.com/subdomains/new/httpdocs/".$image_to_delete->thumbh50 );		
		$this->db->delete( 'images', array( 'id' => $_POST['data'] ) );
		$this->images_review_load( $this->uri->segment(3) );
	}
}
?>