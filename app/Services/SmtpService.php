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


class SmtpService
{

	public function __construct()
	{

	}

	public function createSmtp(Request $request)
	{ 
		 try {
		 	if($protocol = $request->protocol){
			Setting::updateOrCreate(['key' => 'protocol'],['value' => $protocol]);
		}

		if($smtp_host = $request->smtp_host){
			Setting::updateOrCreate(['key' => 'smtp_host'],['value' => $smtp_host]);
		}

		if($smtp_port = $request->smtp_port){
			Setting::updateOrCreate(['key' => 'smtp_port'],['value' => $smtp_port]);
		}

		if($smtp_user = $request->smtp_user){
			Setting::updateOrCreate(['key' => 'smtp_user'],['value' => $smtp_user]);
		}

		if($smtp_pass = $request->smtp_pass){
			Setting::updateOrCreate(['key' => 'smtp_pass'],['value' => $smtp_pass]);
		}
		
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}

		return Setting::first();
	}	


	public function getSmtp()
	{ 
		$data = array();
		$data['protocol'] = Setting::where('key','protocol')->first()->value;
		$data['smtp_host'] = Setting::where('key','smtp_host')->first()->value;
		$data['smtp_port'] = Setting::where('key','smtp_port')->first()->value;
		$data['smtp_user'] = Setting::where('key','smtp_user')->first()->value;
		$data['smtp_pass'] = Setting::where('key','smtp_pass')->first()->value;

		return $data;
	}	
}
