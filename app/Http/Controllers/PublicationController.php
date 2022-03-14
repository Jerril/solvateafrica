<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Services\PublicationService;
use App\Http\Resources\PublicationResource;
use App\Http\Requests\PublicationRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicationController extends Controller
{
      /**
    * @var publicationService
    */

    private $publicationService;

    public function __construct(PublicationService $publicationService)
    {
    	$this->publicationService = $publicationService;
    }

 /**
     * @OA\Get(
     ** path="/publication",
     *   tags={"Publication"},
     *   summary="Get publications of a user",
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
    	return PublicationResource::collection($this->publicationService->getPublications());
    }

    /**
    * store Publication 
    */
 
     /**
     * @OA\Post(
     ** path="/publication/store",
     *   tags={"Publication"},
     *   summary="Store publication",
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
     *      @OA\Parameter(
     *      name="publisher",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="description",
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
    public function store(PublicationRequest $request)
    {
     	return new PublicationResource($this->publicationService->createPublication($request));
    }

      /**
     * @OA\Put(
     ** path="/publication/store",
     *   tags={"Publication"},
     *   summary="update publication",
     *   operationId="store",
    *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="publication id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *      name="title",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="publisher",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="description",
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

    public function update(Publication $publication, PublicationRequest $request): PublicationResource
    {
    	return new PublicationResource($this->publicationService->updatePublication($publication, $request));
    }

  /**
     * @OA\Delete(
     ** path="/publication/{id}",
     *   tags={"Publication"},
     *   summary="delete publication",
     *   operationId="destroy",
      *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="publication id",
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

    public function destroy(Publication $publication):JsonResource
    {
    	$this->publicationService->deletePublication($publication);
    	return (new JsonResource(null))->additional(["message" => "success! Publication deleted."]);
    }
}
