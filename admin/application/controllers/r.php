<?php
class R extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}

	function _remap($url){
		
		$this->load->library('user_agent');
		$mobiles=array('Apple iPhone','Apple iPod Touch','Android','Windows CE','Symbian S60','Apple iPad');
		//Redirecciono de acuerdo al browser
		if ($this->agent->is_mobile()){
			$m=$this->agent->mobile();
			
			if($m == "Android" and preg_match('/\bAndroid\b.*\bMobile/i',$this->agent->agent) == 0)
				$m = "Android Tablet";
			
			switch($m){
				case 'Apple iPad':
					break;
					
				case 'Android Tablet':
					break;
		
				case in_array($m,$mobiles):
					redirect('moviles/read/'.$url.'/1');
					exit;
					break;
						
				case 'BlackBerry':
					redirect('blackberries/read/'.$url.'/1/Noticias');
					exit;
					break;
						
				default:
					redirect('waps/read/'.$url);
					exit;
			}
				
		}
		else{
			redirect('stories/publica/'.$url);
		}	
		
	}
	
	

}
?>
