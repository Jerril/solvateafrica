<?php

namespace App\Services;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SkillRequest;
use Exception;
use App\Exception\ApplicationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;


class SkillService
{

	/**
	* @var User
	*/ 
	private $authUser;

	private $skill;


	public function __construct(Skill $skill )
	{
		$this->authUser = auth()->user();
		$this->$skill = $skill;
	}

	public function createSkill(SkillRequest $request)
	{ 
		  try {
		 	$data = $request->all();
			$skill = Skill::create($data); 
			return response()->json([ 'success' => true, 'skill' => $skill ]);
		}
		catch(Exception $ex) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
	}

	public function getSkills(): LengthAwarePaginator
	{
		return Skill::orderBy('id','DESC')->paginate(15); 
	}

	public function updateSkill(Skill $skill, SkillRequest $request)
	{
		try {
			$skill->update($request->validated());
			return response()->json([ 'success' => true, 'skill' => $skill ]);
		}
		catch(Exception $ex) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
	}

	public function deleteSkill(Skill $skill)
	{
		try {
			$skill->delete();
			return response()->json([ 'success' => true ]);
		}
		catch(Exception $ex) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
	}

	public function attachSkillToUser(Request $request)
	{
		
		try {
		//	$data = explode(',', $request->skillIds);
		//	auth()->user()->skills()->sync($data);
			auth()->user()->skills()->sync([$request->skillId => [ 'proficiency' => $request->proficiency] ], false);
			return response()->json([ 'success' => true ]);
		}
		catch(Exception $ex) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
	}

	public function detachSkillToUser(Request $request)
	{
		
		try {
			auth()->user()->skills()->detach($request->skillId);
			return response()->json([ 'success' => true ]);
		}
		catch(Exception $ex) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
	}

   /*	public function dettachSkillToUser(Request $request)
	{
		try {
			$data = explode(',', $request->skillIds);
			$this->authUser->skills()->attach($data);
			return response()->json([ 'success' => true ]);
		}
		catch(Exception $ex) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
		return $this->authUser->skills();
	} */

	public function getallUserSkills()
	{ 
			try {
	 		$skills = auth()->user()->skills()->get();
	 		$data = array();
	 		foreach($skills as $key=> $skill){
	 			$data[$key]['id'] = $skill->id;
	 			$data[$key]['name'] = $skill->name;
	 			$data[$key]['slug'] = $skill->slug;
	 			$data[$key]['is_active'] = $skill->is_active;
	 			$data[$key]['proficiency'] = $skill->pivot->proficiency;
	 		}
			return response()->json([ 'success' => true, 'skills' => $data ]);
		}
		catch(Exception $ex ) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
	}
	
}