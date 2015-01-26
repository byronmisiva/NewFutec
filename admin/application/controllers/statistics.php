<?php
class Statistics extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('statistic');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('fusioncharts') ;
        $this->swfCharts=base_url().'Charts/Line.swf' ;
        $this->template->add_js('js/calendar.js');
        $this->template->add_js('js/FusionCharts.js');
		$this->template->add_css('css/calendar.css');
		
		//Validacion ACL
		if(!$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2),FALSE)){
			redirect('admin');
		}
	}
	
	function index(){
		$data['title'] = "ESTADISTICAS";
		$data['heading'] = "";
		
		$query=$this->statistic->get_statistic();
		
		$total=0;
		foreach($query->result() as $row):
			$total=$total+$row->views;
		endforeach;
		
		$i=0;
		foreach($query->result() as $row):
			$stat[$i]['id']=$row->id;
			$stat[$i]['name']=$row->name;
			$stat[$i]['view']=$row->views;
			$stat[$i]['percent']=round($row->views*100/$total,2);
			$i+=1;
		endforeach;
			$stat[$i]['id']='';
			$stat[$i]['name']='Total';
			$stat[$i]['view']=$total;
			$stat[$i]['percent']=100;
		$data['stat']=$stat;
		$this->view('statistics_view',$data);	
	}
	
	function statistics_vdate(){
		$data['title']='ESTADISTICAS';
		$data['heading']=' POR D&Iacute;A';
		if(isset($_POST['submit'])){
   			$id=$_POST['id'];
			$fechah=$_POST['fechah'];
   			$fechaa=$_POST['fechaa'];	
   			unset($_POST['submit']);
		}
		else{
			$id=$this->uri->segment(3);
			$fechah=mdate('%Y-%m-%d',time());
			$fechaa=$this->statistic->calcularFecha($fechah,-30);	
		}
		
		$query=$this->statistic->get_statistic_days($id,$fechah,$fechaa);
		$paso=1;
		
		if($query->num_rows()>10){
			$paso=round($query->num_rows()/10,0);
		}
		
		$q2=$this->db->query('Select * 
							  From statistics
							  Where id='.$id)->result();
			
		$request="<chart caption='Grafica de Vistas ".$q2[0]->name."' subcaption='Desde ".$fechaa." Hasta ".$fechah."' xAxisName='Dia' yAxisName='Vistas' yAxisMinValue='0' showValues='0' alternateHGridColor='FCB541' alternateHGridAlpha='20' divLineColor='FCB541' divLineAlpha='50' canvasBorderColor='666666' baseFontColor='666666' lineColor='FCB541' labelStep='".$paso."' labelDisplay='Rotate' slantLabels='1' >";
		
		
		foreach($query->result() as $row):
			$request=$request."<set label='".$row->date."' value='".$row->views."'/>";
		endforeach;
		
		$request=$request."<styles><definition><style name='Anim1' type='animation' param='_xscale' start='0' duration='1'/><style name='Anim2' type='animation' param='_alpha' start='0' duration='0.6'/><style name='DataShadow' type='Shadow' alpha='40'/></definition><application><apply toObject='DIVLINES' styles='Anim1'/><apply toObject='HGRID' styles='Anim2'/><apply toObject='DATALABELS' styles='DataShadow,Anim2'/></application></styles></chart>";
		
		$data['graph'] = $this->fusioncharts->renderChart($this->swfCharts,'',$request,"productSales", 600, 400, false, false) ;
		$data['id']=$this->uri->segment(3);
		$_POST['fechah']=$fechah;
		$_POST['fechaa']=$fechaa;
		
		$total=0;
		foreach($query->result() as $row):
			$total=$total+$row->views;
		endforeach;
		
		$i=0;
		foreach($query->result() as $row):
			$stat[$i]['date']=$row->date;
			$stat[$i]['view']=$row->views;
			$stat[$i]['percent']=round($row->views*100/$total,2);
			$i+=1;
		endforeach;

		$stat[$i]['date']='Total';
		$stat[$i]['view']=$total;
		$stat[$i]['percent']=100;
		$data['stat']=$stat;
			
		
		$this->view('statistics_vdate',$data);
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