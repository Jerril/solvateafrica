<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    private $taskInterface;

    public function __construct(TaskRepositoryInterface $taskInterface)
    {
        $this->taskInterface = $taskInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/task/get/{containerId}",
     *   tags={"Task Management (Project Management)"},
     *   summary="Get Tasks ",
     *   operationId="gettasks",
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
    public function index($id)
    {
        try{
            // $tasks = $this->taskInterface->GetById('taskcontainerId',$id);
            $tasks = $this->taskInterface->GetById('projectId',$id);
            return response()->json(['success' => true, 'tasks' => $tasks ]);
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
     ** path="/task/store",
     *   tags={"Task Management (Project Management)"},
     *   summary="Create New Task",
     *   operationId="createnewtask",
     *   security={{"bearer_token":{}}},
     *
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="Buy Gala"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="start_date",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="end_date",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="taskcontainerId",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="projectId",
     *                     type="integer"
     *                 ),
     *
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
    public function store(Task $request)
    {
        try{

            $input = $request->all();
            $input['userId'] = auth()->user()->id;
            $input['status'] = 'todo';

            $task = $this->taskInterface->create($input);

            return response()->json(['success' => true, 'task' => $task ]);

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
     ** path="/task/{taskId}",
     *   tags={"Task Management (Project Management)"},
     *   summary="Edit Task Management",
     *   operationId="edittask",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="taskId",
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
     *                     type="string",
     *                     example="Buy Gala"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="start_date",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="end_date",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="taskcontainerId",
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
    public function update(Task $request, $id)
    {
        try{
            $exist = $this->taskInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $task = $this->taskInterface->update($id, $request->all());
            return response()->json(['success' => true, 'task' => $task ]);
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
     ** path="/task/{taskId}",
     *   tags={"Task Management (Project Management)"},
     *   summary="Delete Task",
     *   operationId="deletetask",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="taskId",
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

            $exist = $this->taskInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $status = $this->taskInterface->deleteById($id);
            return response()->json(['success' => $status ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);

        }
    }
}
