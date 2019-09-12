<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Cache;
	use App\Product;
	use App\Http\Requests as Requests;
	use GuzzleHttp\Client;
	use GuzzleHttp\Message\Response;

	class CheckCompany extends Controller {

		public function httpPost ($url , $params) {
			$postData = '';
			//create name value pairs seperated by &
			foreach ($params as $k => $v) {
				$postData .= $k . '='.$v.'&';
			}

			$postData = rtrim ($postData , '&');
			$ch = curl_init();
			curl_setopt ($ch , CURLOPT_URL,$url);
			curl_setopt ($ch , CURLOPT_HTTPHEADER,  [
				'Accept: application/vnd.BNM.API.v1+json',
			]);

			curl_setopt ($ch , CURLOPT_RETURNTRANSFER , true);
			curl_setopt ($ch , CURLOPT_HEADER , false);
			curl_setopt ($ch , CURLOPT_POST , count($postData));
			curl_setopt ($ch , CURLOPT_SSL_VERIFYHOST , false);
			curl_setopt ($ch , CURLOPT_SSL_VERIFYPEER , false);
			curl_setopt ($ch , CURLOPT_POSTFIELDS , $postData);
			$output = curl_exec ($ch);
			curl_close ($ch);
			return json_decode ($output);
		}

		public function httpGet ($url) {

			$ch = curl_init();
			curl_setopt ($ch , CURLOPT_URL , $url);
			curl_setopt ($ch , CURLOPT_HTTPHEADER ,  [
				'Accept: application/vnd.BNM.API.v1+json',
			]);

			curl_setopt ($ch , CURLOPT_RETURNTRANSFER,true);
			curl_setopt ($ch , CURLOPT_HEADER, false);
			curl_setopt ($ch , CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt ($ch , CURLOPT_SSL_VERIFYPEER, false);
			$output = curl_exec ($ch);

			if (curl_errno ($ch)) {
				echo curl_error ($ch);
			}
			curl_close ($ch);
			return json_decode ($output);
		}

		public function check (Request $request) {

			$response = Cache::remember('response', 10, function () {
    return $this -> httpGet ('https://api.bnm.gov.my/public/consumer-alert/' . $request -> input ('name'));
	});
			//dd ($response);
			return view ('search' , compact ('response'));
			}
		}
