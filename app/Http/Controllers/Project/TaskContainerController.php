<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gig;
use App\Http\Requests\Project;
use App\Http\Requests\TaskContainer;
use Illuminate\Http\Request;
use App\Repository\TaskContainerRepositoryInterface;
use Exception;
use Illuminate\Support\Arr;
use DB;

class TaskContainerController extends Controller
{

    private $containerInterface;

    public function __construct(TaskContainerRepositoryInterface $containerInterface)
    {
        $this->containerInterface = $containerInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/taskcontainer/get/{projectId}",
     *   tags={"Task Container Management"},
     *   summary="Get User Projects",
     *   operationId="getuserprojects",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="projectId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *   ),
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
    public function index($id)
    {
        try{
            $taskcontainer = $this->containerInterface->GetById('projectId',$id, ['tasks']);
            return response()->json(['success' => true, 'taskcontainers' => $taskcontainer ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => true, 'error' => array('message' => $ex->getMessage() ) ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Post(
     ** path="/taskcontainer/store",
     *   tags={"Task Container Management"},
     *   summary="Create New Task Container",
     *   operationId="createnewtaskcontainer",
     *   security={{"bearer_token":{}}},
     *
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="To Do"
     *                 ),
     *                 @OA\Property(
     *                     property="projectId",
     *                     type="integer"
     *                 ),
     *             )
     *         )
     *     ),
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
    public function store(TaskContainer $request)
    {
        try{
            $input = $request->all();
            $input["userId"] = auth()->user()->id;
            $taskcontainer = $this->containerInterface->create($input);

            return response()->json(['success' => true, 'taskcontainer' => $taskcontainer ]);

        }catch(Exception $ex)
        {
            return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     /**
     * @OA\Put(
     ** path="/taskcontainer/{containerId}",
     *   tags={"Task Container Management"},
     *   summary="Edit Task Container Management",
     *   operationId="editcontainer",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="containerId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *   ),
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="projectId",
     *                     type="integer"
     *                 ),
     *             )
     *         )
     *     ),
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
    public function update(TaskContainer $request, $id)
    {
        try{
            $exist = $this->containerInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $taskcontainer = $this->containerInterface->update($id, $request->all());
            return response()->json(['success' => true, 'taskcontainer' => $taskcontainer ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Delete(
     ** path="/taskcontainer/{containerId}",
     *   tags={"Task Container Management"},
     *   summary="Delete Task Container",
     *   operationId="deletetaskcontainer",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="containerId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *   ),
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
    public function destroy($id)
    {
        try{

            $exist = $this->containerInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $status = $this->containerInterface->deleteById($id);
            return response()->json(['success' => $status ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);

        }
    }
}
