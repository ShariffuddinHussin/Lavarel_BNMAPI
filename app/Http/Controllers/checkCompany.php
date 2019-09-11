<?php
	namespace App\Http\Controllers;
	use App\Product;
	use App\Http\Requests as HttpRequest;
	use GuzzleHttp\Client;
	use GuzzleHttp\Message\Request;
	use GuzzleHttp\Message\Response;
	
	class checkCompany extends Controller{
	
	public function httpPost($url,$params){
		$postData = '';
		//create name value pairs seperated by &
		foreach($params as $k => $v){
			$postData .= $k . '='.$v.'&';
		}
		$postData = rtrim($postData, '&');

		$ch = curl_init();

		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_HTTPHEADER,  [
			'Accept: application/vnd.BNM.API.v1+json',
		]);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, count($postData));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

		$output=curl_exec($ch);

		curl_close($ch);
		
		return json_decode($output);
		}
		
	public function httpGet($url){
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_HTTPHEADER,  [
				'Accept: application/vnd.BNM.API.v1+json',
			]);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch,CURLOPT_HEADER, false);
			$output=curl_exec($ch);
			curl_close($ch);
			return json_decode($output);
		}
    
    public function check(){
        $client = new Client();
        $response = $client->get('https://api.bnm.gov.my/public/consumer-alert/{str}');
		dd($response);
		$response_data = $res->getBody()->getContents;
		//return the api value to variable
		return [
			'name'=> $this->name,
			'registration_number'=> $this->reg_num,
			'added_date'=> $this->d,
			'website'=> $this->web,
		];
    }
	
	//func for testing 
	public function search(){
		$name = '1234';
		$reg_num ='qq4234';
		$date = '23 June 2001';
		$web = ' http://example.com';
		return view('search', compact('name','reg_num','date','web'));
	}
}