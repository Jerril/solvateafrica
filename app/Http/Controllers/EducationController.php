<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use App\Services\EducationService;
use App\Http\Resources\EducationResource;
use App\Http\Requests\EducationRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationController extends Controller
{
      /**
    * @var educationService
    */

    private $educationService;

    public function __construct(EducationService $educationService)
    {
    	$this->educationService = $educationService;
    }

 /**
     * @OA\Get(
     ** path="/education",
     *   tags={"Education"},
     *   summary="Get educations of a user",
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

    public function index():AnonymousResourceCollection
    {
    	return EducationResource::collection($this->educationService->getEducations());
    }

    /**
    * store education 
    */
 
     /**
     * @OA\Post(
     ** path="/education/store",
     *   tags={"Education"},
     *   summary="Store education",
     *   operationId="store",
    *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="title",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="country_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="from_year",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="to_year",
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
    public function store(EducationRequest $request)
    {
     	return new EducationResource($this->educationService->createEducation($request));
    }

     /**
     * @OA\Put(
     ** path="/education/{id}",
     *   tags={"Education"},
     *   summary="Update education",
     *   operationId="update",
     *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="education id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
        *  @OA\Parameter(
     *      name="title",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="country_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="from_year",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="to_year",
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

    public function update(Education $education, EducationRequest $request): EducationResource
    {
    	return new EducationResource($this->educationService->updateEducation($education, $request));
    }

  /**
     * @OA\Delete(
     ** path="/education/{id}",
     *   tags={"Education"},
     *   summary="delete educaiton",
     *   operationId="destroy",
      *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="workprofile id",
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

    public function destroy(Education $education):JsonResource
    {
    	$this->educationService->deleteEducation($education);
    	return (new JsonResource(null))->additional(["message" => "success! Education deleted."]);
    }
}
