<?php

namespace App\Services;

use App\Models\Education;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EducationRequest;
use Exception;
use App\Exception\ApplicationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EducationService
{

	/**
	* @var User
	*/ 
	private $authUser;

	private $education;


	public function __construct(Education $education )
	{
		$this->authUser = auth()->user();
		$this->$education = $education;
	}

	public function createEducation(EducationRequest $request)
	{ 
		  try {
		 	$data = $request->all();
			$data['user_id'] =  auth()->user()->id;
			$education = Education::create($data); 
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}

		return $education;
	}

	public function getEducations(): LengthAwarePaginator
	{
		$educationBuilder = Education::where('user_id',auth()->user()->id);
		return $educationBuilder->orderBy('id','DESC')->paginate(15);
	}

	public function updateEducation(Education $education, EducationRequest $request): Education
	{
		try {
			$education->update($request->validated());
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}

		return $education;
	}

	public function deleteEducation(Education $education): void
	{
		try {
			$education->delete();
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}
	}
}