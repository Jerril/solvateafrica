<?php

namespace App\Services;

use App\Models\Certification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CertificationRequest;
use Exception;
use App\Exception\ApplicationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CertificationService
{

	/**
	* @var User
	*/ 
	private $authUser;

	private $certification;


	public function __construct(Certification $certification )
	{
		$this->authUser = auth()->user();
		$this->$certification = $certification;
	}

	public function createCertification(CertificationRequest $request)
	{ 
		  try {
		 	$data = $request->all();
			$data['user_id'] =  auth()->user()->id;
			$certification = Certification::create($data); 
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}

		return $certification;
	}

	public function getCertifications(): LengthAwarePaginator
	{
		$certificationBuilder = Certification::where('user_id',auth()->user()->id);
		return $certificationBuilder->orderBy('id','DESC')->paginate(15);
	}

	public function updateCertification(Certification $certification, CertificationRequest $request): Certification
	{
		try {
			$certification->update($request->validated());
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}

		return $certification;
	}

	public function deleteCertification(Certification $certification): void
	{
		try {
			$certification->delete();
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}
	}
}