<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

use Illuminate\Support\Facades\Mail;
//use GuzzleHttp\Exception\GuzzleException;

class xxxUserController extends Controller
{
	public function login(){
		return view('admin.login');
	}

	

    public function getLogout(Request $request)
    {
			Auth::logout();
			return redirect('/login');
	}

	public function postSignin(Request $request)
	{
		// dd($request);
	/*	$request->validate([
        'email' => 'email|required',
		'password' => 'required|4',
    ]); */


		if(Auth::attempt([
			'email' => $request->input('email'),
			'password' => $request->input('password')
		]))
		{
			$user = User::find(Auth::id());

			switch($user->user_type)
			{
				case 'admin':
				return redirect()->route('dashboard.index');
			}
		}
		return redirect()->back()->with('message','invalid login details');
	}

/*	public function staffTripRequest(Request $request)
	{ 
		 $formInput['business_code'] = Auth::user()->business_code; 
		 $formInput['company'] = Auth::user()->company; 
		 $formInput['tripRequest'] = 'pending'; 
		 $formInput['staffId'] = Auth::id(); 

		   $tripcheck = Trip::where(['staffId'=>Auth::id(),'tripRequest' => 'pending'])->orderBy('id', 'desc')->first();
      if(!is_null($tripcheck))
      {
        return redirect()->back()->with('message','You have a pending Trip request');
      }

		Trip::create($formInput);

		$user = User::where('unique_code',Auth::user()->business_code)->first();
		$email = $user->email;
		$name =   $user->name;

		if(Auth::user()->phone)
		{
			 $this->sendSmsMessage(Auth::user()->phone,'Trip Request was successful');
		}

		if($user->phone)
		{
			$this->sendSmsMessage($user->phone,'Kindly approve a staff trip request');
		}

		 Mail::send('emails.stafftriprequest',  [
            'email' => $email, 
            'name' => $name,
            ], function ($message) use ($email) {
                $message->to($email);
                $message->subject('SmoothRide: Trip Request');
            });


		return redirect()->back()->with('message','trip request made ');

	}

 	public function emailTest()
 	{
 			try{
		 		Mail::send('emails.test',[], function ($message) {
		                $message->to('francollimassociates@gmail.com');
		                $message->from('info@preventpro.ng','SmoothRide');
		                $message->subject('SmoothRide: TEST');
		            });

				return 1;
				}catch(\Exception $e){
					 return $e;
			}
 	}

     function sendSmsMessage($to,$message)
    {
       // $to = '08066289557';
      //  $message = 'You are doing good';

          $headers = [
            'Content-Type' => 'application/json',
            'apiKey' => '53f177068392eb223a0e480d44f86c78330a1bb5a611f64fd6a0cc625e950c98',
        ];

        $client = new \GuzzleHttp\Client([
            'headers' => $headers
        ]);
    $response = $client->request('POST', 'https://api.africastalking.com/version1/messaging', [
        'form_params' => [
             "username" => 'smoothride',
             "to" => $to,
             "message" => $message,
             "from" => 'SmoothRide',
        ]
    ]);

    $response = $response->getBody()->getContents();
    }

*/

}
