<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter{
	
	private $consumer_key;
	private $consumer_secret;
	var $connection;
	

	public function __construct(){
		
		require APPPATH.'libraries/twitterAPI/twitteroauth/twitteroauth.php';
		/*
		$this->consumer_key="d1wQ8qv1oQMRJtIgb2wUFQ";
		$this->consumer_secret="3CurQo9LHUcQZltWpmh9lCjwoAnrZAQwdvgbfoqQ";

		$this->getConnectionWithAccessToken("37717733-QwCqhFLNrwvlfJimO3eDsDCMBQYcEMRUxO3dQFvQG", "KwBBBjhuFSHfNn6629uJ0wgFJGsccX13Ndju9MyRlio");
        */

        //Pruebas
		$this->consumer_key="kIfBd567lG78jkKXauvK4A";
		$this->consumer_secret="RaGDbaZqomjQKIpwpUcdW1w7TBY3Ntl4S0K6YfR5vA";

		$this->getConnectionWithAccessToken("1857511056-1P6IyN3QN9vlUCwSZzhUOma7BtI1SfE5epyHbFw", "RAOn5XvSUO6hv3SFIWVmnWWhMdtw7egdIQdSEFKm8k3i8");

	}
	
	public function getConnectionWithAccessToken($oauth_token, $oauth_token_secret){
		$this->connection =new TwitterOAuth($this->consumer_key,$this->consumer_secret,$oauth_token, $oauth_token_secret);
	}
	
	public function get($string="statuses/user_timeline"){
		$content=$this->connection->get($string);
		return $content;
	}

	private function post($url,$parameters){
		$content=$this->connection->post($url,$parameters);
		return $content;
	}

    public function update($text){
        return $this->post('statuses/update',array('status'=>$text));
    }


	private function upload($url,$parameters){
		$content=$this->connection->upload($url,$parameters);
		return $content;
	}


    public function update_image($text, $image){
        return $this->upload('statuses/update_with_media',array('status'=>$text, 'media[]' => file_get_contents($image)));
    }

}