<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certification;
use App\Services\CertificationService;
use App\Http\Resources\CertificationResource;
use App\Http\Requests\CertificationRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificationController extends Controller
{
      /**
    * @var certificationService
    */

    private $certificationService;

    public function __construct(CertificationService $certificationService)
    {
    	$this->certificationService = $certificationService;
    }

 /**
     * @OA\Get(
     ** path="/certification",
     *   tags={"Certification"},
     *   summary="Get certifications of a user",
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
    	return CertificationResource::collection($this->certificationService->getCertifications());
    }

    /**
    * store certification 
    */

     /**
     * @OA\Post(
     ** path="/certification/store",
     *   tags={"Certification"},
     *   summary="Store certification",
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
     *      name="description",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="year",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="conferring_organization",
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
    public function store(CertificationRequest $request)
    {
     	return new CertificationResource($this->certificationService->createCertification($request));
    }

     /**
     * @OA\Put(
     ** path="/certification/{id}",
     *   tags={"Certification"},
     *   summary="Update certification",
     *   operationId="update",
     *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="certification id",
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
     *      name="description",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="year",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="conferring_organization",
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

    public function update(Certification $certification, CertificationRequest $request): CertificationResource
    {
    	return new CertificationResource($this->certificationService->updateCertification($certification, $request));
    }

  /**
     * @OA\Delete(
     ** path="/certification/{id}",
     *   tags={"Certification"},
     *   summary="delete certification",
     *   operationId="destroy",
      *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="certification id",
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

    public function destroy(Certification $certification):JsonResource
    {
    	$this->certificationService->deleteCertification($certification);
    	return (new JsonResource(null))->additional(["message" => "success! Certification deleted."]);
    }
}
