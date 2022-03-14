<?php

namespace App\Services;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PublicationRequest;
use Exception;
use App\Exception\ApplicationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PublicationService
{

	/**
	* @var User
	*/ 
	private $authUser;

	private $publication;


	public function __construct(Publication $publication )
	{
		$this->authUser = auth()->user();
		$this->$publication = $publication;
	}

	public function createPublication(PublicationRequest $request)
	{ 

		try {
		 	$data = $request->all();
			$data['user_id'] =  auth()->user()->id;
			$publication = Publication::create($data); 
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}

		return $publication; 
	}

	public function getPublications(): LengthAwarePaginator
	{
		$publicationBuilder = Publication::where('user_id',auth()->user()->id);
		return $publicationBuilder->orderBy('id','DESC')->paginate(15);
	}

	public function updatePublication(Publication $publication, PublicationRequest $request): Publication
	{
		try {
			$publication->update($request->validated());
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}

		return $publication;
	}

	public function deletePublication(Publication $publication): void
	{
		try {
			$publication->delete();
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}
	}
}