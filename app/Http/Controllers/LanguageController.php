<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Services\LanguageService;
use App\Http\Resources\LanguageResource;
use App\Http\Requests\LanguageRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageController extends Controller
{
      /**
    * @var languageService
    */

    private $languageService;

    public function __construct(LanguageService $languageService)
    {
    	$this->languageService = $languageService;
    }

 /**
     * @OA\Get(
     ** path="/language",
     *   tags={"Language"},
     *   summary="Get all languages",
     *   operationId="index",
      *   security={{"bearer_token":{}}},
     * 
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function index()
    {
    	// return $this->languageService->getLanguages();with('podcasts')
    	return Language::orderBy('id','DESC')->paginate(15);
    	// return LanguageResource::collection($this->languageService->getLanguages()); AnonymousResourceCollection
    }

    /**
    * store language 
    */
 
     /**
     * @OA\Post(
     ** path="/language/store",
     *   tags={"Language"},
     *   summary="Store language",
     *   operationId="store",
    *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="iso2",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="iso3",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function store(LanguageRequest $request)
    {
    	return $this->languageService->createLanguage($request);
     //	return new LanguageResource($this->languageService->createLanguage($request));
    }

     /**
     * @OA\Put(
     ** path="/language/{id}",
     *   tags={"Language"},
     *   summary="Update language",
     *   operationId="update",
     *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Language id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
      *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="iso2",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="iso3",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function update(Language $language, LanguageRequest $request)
    {
    	return $this->languageService->updateLanguage($language, $request);
    	// return new LanguageResource();
    }

  /**
     * @OA\Delete(
     ** path="/language/{id}",
     *   tags={"Language"},
     *   summary="delete Language",
     *   operationId="destroy",
      *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Language id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function destroy(Language $language)
    {
    	return $this->languageService->deleteLanguage($language);
    	//return (new JsonResource(null))->additional(["message" => "success! Language deleted."]);
    }

    /**
    * attach Language To User
    */

     /**
     * @OA\Post(
     ** path="/language/attachlanguagetouser",
     *   tags={"Language"},
     *   summary="attach language to user",
     *   operationId="attachLanguageToUser",
    *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="languageId",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
      *  @OA\Parameter(
     *      name="proficiency",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function attachLanguageToUser(Request $request)
    {
     	return  $this->languageService->attachLanguageToUser($request);
     //	return (new JsonResource(null))->additional(["message" => "success! language attached to user"]);
    }

    /**
     * @OA\Post(
     ** path="/language/detachlanguagetouser",
     *   tags={"Language"},
     *   summary="detach language to user",
     *   operationId="detachLanguageToUser",
    *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="languageId",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function detachLanguageToUser(Request $request)
    {
     	return  $this->languageService->detachLanguageToUser($request);
     //	return (new JsonResource(null))->additional(["message" => "success! language attached to user"]);
    }

    /**
     * @OA\Get(
     ** path="/language/getalluserlanguages",
     *   tags={"Language"},
     *   summary="Get my languages",
     *   operationId="index",
      *   security={{"bearer_token":{}}},
     * 
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function getallUserLanguages()
    {
    	return $this->languageService->getallUserLanguages();
    	// return LanguageResource::collection($this->languageService->getallUserLanguages());
    }

}
