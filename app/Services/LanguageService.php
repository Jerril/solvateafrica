<?php

namespace App\Services;

use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LanguageRequest;
use Exception;
use App\Exception\ApplicationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class LanguageService
{

	/**
	* @var User
	*/ 
	private $authUser;

	private $language;


	public function __construct(Language $language )
	{
		$this->authUser = auth()->user();
		$this->$language = $language;
	}

	public function createLanguage(LanguageRequest $request)
	{ 
	 try {
		 	$data = $request->all();
			$language = Language::create($data); 
			return response()->json([ 'success' => true, 'languages' => $language ]);
		}
		catch(Exception $ex) {
		 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
	}

	public function getLanguages(): LengthAwarePaginator
	{
		
		return Language::orderBy('id','DESC')->paginate(15);
	}

	public function updateLanguage(Language $language, LanguageRequest $request)
	{
		try {
			$language->update($request->validated());
			return response()->json([ 'success' => true, 'language' => $language ]);
		}
		catch(Exception $ex ) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
	}

	public function deleteLanguage(Language $language)
	{
		try {
			$language->delete();
			return response()->json([ 'success' => true ]);
		}
		catch(Exception $ex ) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
	}

	public function attachLanguageToUser(Request $request)
	{
		
		try {
			auth()->user()->languages()->sync([$request->languageId => [ 'proficiency' => $request->proficiency] ], false);
			return response()->json([ 'success' => true ]);

		}
		catch(Exception $ex ) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
	}

	public function detachLanguageToUser(Request $request)
	{
		
		try {
			auth()->user()->languages()->detach($request->languageId);
			return response()->json([ 'success' => true ]);

		}
		catch(Exception $ex ) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
	}

	public function getallUserLanguages()
	{
	 	try {
	 		$languages = auth()->user()->languages()->get();
	 		$data = array();
	 		foreach($languages as $key=> $language){
	 			$data[$key]['id'] = $language->id;
	 			$data[$key]['name'] = $language->name;
	 			$data[$key]['iso2'] = $language->iso2;
	 			$data[$key]['iso3'] = $language->iso3;
	 			$data[$key]['is_active'] = $language->is_active;
	 			$data[$key]['proficiency'] = $language->pivot->proficiency;
	 		}
			return response()->json([ 'success' => true, 'languages' => $data ]);
		}
		catch(Exception $ex ) {
			 return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}

	}

}