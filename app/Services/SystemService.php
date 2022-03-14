<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Exception\ApplicationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;


class SystemService
{

	public function __construct()
	{

	}

	public function createSystemSettings(Request $request)
	{ 
		try {
		 	if($system_name = $request->system_name){
			Setting::updateOrCreate(['key' => 'system_name'],['value' => $system_name]);
		}

		if($system_title = $request->system_title){
			Setting::updateOrCreate(['key' => 'system_title'],['value' => $system_title]);
		}

		if($system_email = $request->system_email){
			Setting::updateOrCreate(['key' => 'system_email'],['value' => $system_email]);
		}

		if($address = $request->address){
			Setting::updateOrCreate(['key' => 'address'],['value' => $address]);
		}

		if($phone = $request->phone){
			Setting::updateOrCreate(['key' => 'phone'],['value' => $phone]);
		}

		if($request->paystack_active || $request->paystack_mode  || $request->sandbox_client_id || $request->sandbox_secret_key || $request->production_client_id || $request->sandbox_secret_key ||$request->production_client_id || $request->production_secret_key){

		$paystack_info = array();
        $paystack['active'] = $request->paystack_active;
        $paystack['mode'] = $request->paystack_mode;
        $paystack['sandbox_client_id'] = $request->sandbox_client_id;
        $paystack['sandbox_secret_key'] = $request->sandbox_secret_key;

        $paystack['production_client_id'] = $request->production_client_id;
        $paystack['production_secret_key'] = $request->production_secret_key;

        array_push($paystack_info, $paystack);

        $data   =   json_encode($paystack_info);

			Setting::updateOrCreate(['key' => 'paystack'],['value' => $data]);
		}

		if($system_currency = $request->system_currency){
			Setting::updateOrCreate(['key' => 'system_currency'],['value' => $system_currency]);
		}

		if($website_description = $request->website_description){
			Setting::updateOrCreate(['key' => 'website_description'],['value' => $website_description]);
		}

		if($footer_text = $request->footer_text){
			Setting::updateOrCreate(['key' => 'footer_text'],['value' => $footer_text]);
		}

		if($footer_link = $request->footer_link){
			Setting::updateOrCreate(['key' => 'footer_link'],['value' => $footer_link]);
		}
		
		}
		catch(Exception $ex) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}

		return response()->json([ 'success' => true, 'settings' => Setting::all() ]);
	}	


	public function getSystemSettings()
	{ 
		$data = array();
		$data['system_name'] = Setting::where('key','system_name')->first()->value ?? '' ;
		$data['system_title'] = Setting::where('key','system_title')->first()->value ?? '' ;
		$data['system_email'] = Setting::where('key','system_email')->first()->value ?? '' ;
		$data['address'] = Setting::where('key','address')->first()->value ?? '' ;
		$data['phone'] = Setting::where('key','phone')->first()->value ?? '' ;
		$data['system_currency'] = Setting::where('key','system_currency')->first()->value ?? '' ;
		$data['website_description'] = Setting::where('key','website_description')->first()->value ?? '' ;
		$data['footer_text'] = Setting::where('key','footer_text')->first()->value ?? '' ;
		$data['footer_link'] = Setting::where('key','footer_link')->first()->value ?? '' ;
		$data['paystack'] = Setting::where('key','paystack')->first()->value ?? '' ;

		return $data;
	}	
}
