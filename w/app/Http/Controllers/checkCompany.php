<?php


namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests as HttpRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;



class checkCompany extends Controller{
    
    public function check(){
        $client = new Client();
        $response = $client->get('https://api.bnm.gov.my/public/consumer-alert/{str}');
		dd($response);
    }


	public function search(){
		$name = '1234';
		$reg_num ='qq4234';
		$date = '23 June 2001';
		$web = ' http://example.com';
		return view('search', compact('name','reg_num','date','web'));
	}



}
