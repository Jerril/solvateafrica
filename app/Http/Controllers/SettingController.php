<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Services\SmtpService;
use App\Http\Resources\SkillResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingController extends Controller
{
    /**
    * @var smtpService
    */

    private $smtpService;

    public function __construct(SmtpService $smtpService)
    {
    	$this->smtpService = $smtpService;
    }

 /**
     * @OA\Get(
     ** path="/smtp",
     *   tags={"Smtp"},
     *   summary="Get Smtp",
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
    	return $this->smtpService->getSmtp();
    }

    /**
    * store Smtp 
    */

     /**
     * @OA\Post(
     ** path="/smtp/store",
     *   tags={"Smtp"},
     *   summary="Store smtp",
     *   operationId="store",
    *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="protocol",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="smtp_host",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="smtp_port",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="smtp_user",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
      *  @OA\Parameter(
     *      name="smtp_pass",
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
    public function store(Request $request)
    {
     	return $this->smtpService->createSmtp($request);
    }

}
