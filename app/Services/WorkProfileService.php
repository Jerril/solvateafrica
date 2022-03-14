<?php

namespace App\Services;

use App\Models\WorkProfile;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\WorkProfileRequest;
use Exception;
use App\Exception\ApplicationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class WorkProfileService
{

	/**
	* @var User
	*/ 
	private $authUser;

	private $workprofile;


	public function __construct(WorkProfile $workprofile )
	{
		$this->authUser = auth()->user();
		$this->$workprofile = $workprofile;
	}

	public function createWorkProfile(WorkProfileRequest $request)
	{ 
		  try {
		 	$data = $request->all();
			$data['user_id'] =  auth()->user()->id;
			$workprofiles = WorkProfile::create($data); 
		  	//$workprofiles =	$this->authUser->workprofiles()->create($request->all());
		}
		catch(Exception $exception ) {
			Log::error($exception);
		//	throw new ApplicationException('INTERNAL_SERVER_ERROR');
		}

		return $workprofiles;
	}

	public function getWorkProfiles(): LengthAwarePaginator
	{
		$workprofileBuilder = WorkProfile::where('user_id',auth()->user()->id);
		return $workprofileBuilder->orderBy('id','DESC')->paginate(15);
	}

	public function updateWorkProfile(WorkProfile $workprofile, WorkProfileRequest $request): WorkProfile
	{
		try {
			$workprofile->update($request->validated());
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}

		return $workprofile;
	}

	public function deleteWorkProfile(WorkProfile $workprofile): void
	{
		try {
			$workprofile->delete();
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}
	}
}