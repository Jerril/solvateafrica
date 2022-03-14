<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Exception\ApplicationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class ProfileService
{

	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	*
	*
	*
	*/

	public function getProfiles(Request $request)
	{ 
		$userBuilder = $this->user->with('workprofiles','educations','skills','languages');

		if( $request->has("name"))
			$userBuilder->where('name', 'LIKE', "%$request->name%");

		if( $request->has("email"))
			$userBuilder->where('email', 'LIKE', "%$request->email%");

		if($request->has("userdetail")) {
			$userBuilder->whereHas("userdetail", function (Builder $builder) use ($request) {
				$builder->where("gender", $request->input("gender"));
			});
		}

		if($request->has("workprofiles")) {
			$userBuilder->whereHas("workprofiles", function (Builder $builder) use ($request) {
				$builder->where("title",'LIKE',"%$request->input('workprofile_title')%");
			});
		}

		if($request->has("educations")) {
			$userBuilder->whereHas("educations", function (Builder $builder) use ($request) {
				$builder->where("title",'LIKE',"%$request->input('education_title')%");
			});
		}

	/*	if($request->has("skills")) {
			$userBuilder->whereHas("skills", function ($query) use ($request) {
				$query->where("skill_user.name", $request->skill_name);
			});
		}

		if($request->has("languages")) {
			$userBuilder->whereHas("languages", function (Builder $builder) use ($request) {
				$builder->where("name",'LIKE',"%$request->input('language_name')%");
			});
		} */

		return $userBuilder->orderBy('id','DESC')->paginate(15);
		 
	}	

}
