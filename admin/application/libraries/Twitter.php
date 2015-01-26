<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter{
	
	private $consumer_key;
	private $consumer_secret;
	var $connection;
	

	public function __construct(){
		
		require APPPATH.'libraries/twitterAPI/twitteroauth/twitteroauth.php';
		
		$this->consumer_key="d1wQ8qv1oQMRJtIgb2wUFQ";
		$this->consumer_secret="3CurQo9LHUcQZltWpmh9lCjwoAnrZAQwdvgbfoqQ";

		$this->getConnectionWithAccessToken("37717733-QwCqhFLNrwvlfJimO3eDsDCMBQYcEMRUxO3dQFvQG", "KwBBBjhuFSHfNn6629uJ0wgFJGsccX13Ndju9MyRlio");
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
	
}