<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Services\SkillService;
use App\Http\Resources\SkillResource;
use App\Http\Requests\SkillRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillController extends Controller
{
       /**
    * @var skillService
    */

    private $skillService;

    public function __construct(SkillService $skillService)
    {
    	$this->skillService = $skillService;
    }

 /**
     * @OA\Get(
     ** path="/skill",
     *   tags={"Skill"},
     *   summary="Get all Skills",
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
        return $this->skillService->getSkills();
    //	return SkillResource::collection($this->skillService->getSkills());
    }

    /**
    * store Skill 
    */

     /**
     * @OA\Post(
     ** path="/skill/store",
     *   tags={"Skill"},
     *   summary="Store skill",
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
     *      name="slug",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
      *  @OA\Parameter(
     *      name="category_id",
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
    public function store(SkillRequest $request)
    {
        return $this->skillService->createSkill($request);
     	// return new SkillResource();
    }

     /**
     * @OA\Put(
     ** path="/skill/{id}",
     *   tags={"Skill"},
     *   summary="Update Skill",
     *   operationId="update",
     *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="skill id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
     *      name="category_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="slug",
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

    public function update(Skill $skill, SkillRequest $request)
    {
        return $this->skillService->updateSkill($skill, $request);
    //	return new SkillResource();
    }

  /**
     * @OA\Delete(
     ** path="/skill/{id}",
     *   tags={"Skill"},
     *   summary="delete skill",
     *   operationId="destroy",
      *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Skill id",
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

    public function destroy(Skill $skill)
    {
    	return $this->skillService->deleteSkill($skill);
    	// return (new JsonResource(null))->additional(["message" => "success! Skill deleted."]);
    }

     /**
    * attach Skill To User
    */

     /**
     * @OA\Post(
     ** path="/skill/attachskilltouser",
     *   tags={"Skill"},
     *   summary="attach skill to user",
     *   operationId="attachSkillToUser",
    *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="skillId",
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
    public function attachSkillToUser(Request $request)
    {
     	return $this->skillService->attachSkillToUser($request);
     	// return (new JsonResource(null))->additional(["message" => "success! skills attached to user"]);
    }

    /**
    * detach Skill To User
    */

     /**
     * @OA\Post(
     ** path="/skill/detachskilltouser",
     *   tags={"Skill"},
     *   summary="detach skill to user",
     *   operationId="detachSkillToUser",
    *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="skillId",
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
    public function detachSkillToUser(Request $request)
    {
        return $this->skillService->detachSkillToUser($request);
        // return (new JsonResource(null))->additional(["message" => "success! skills attached to user"]);
    }

    /**
     * @OA\Get(
     ** path="/skill/getalluserskills",
     *   tags={"Skill"},
     *   summary="Get my Skills",
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

    public function getallUserSkills()
    {
        return $this->skillService->getallUserSkills();
    	// return SkillResource::collection($this->skillService->getallUserSkills());
    	// 
    }
}
