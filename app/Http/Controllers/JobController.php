<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Services\JobService;
use App\Http\Resources\JobResource;
use App\Http\Requests\JobRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\JobUser;
use App\Models\SubmitJob;

class JobController extends Controller
{
      /**
    * @var jobService  
    */

    private $jobService;

    public function __construct(JobService $jobService)
    {
    	$this->jobService = $jobService;
    }

 /**
     * @OA\Get(
     ** path="/getalljobs",
     *   tags={"Job"},
     *   summary="Get all posted jobs",
     *   operationId="getAllJobs",
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
    public function getAllJobs():AnonymousResourceCollection
    {
    	return JobResource::collection($this->jobService->getAllJobs());
    }

     /**
     * @OA\Get(
     ** path="/job",
     *   tags={"Job"},
     *   summary="Get jobs posted by a user",
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
        return JobResource::collection($this->jobService->getJobs());
    }

    /**
    * store job 
    */
 
     /**
     * @OA\Post(
     ** path="/job/store",
     *   tags={"Job"},
     *   summary="Store job",
     *   operationId="store",
    *   security={{"bearer_token":{}}},
     *
     * @OA\Parameter(
     *      name="title",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="job_description",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="milestone",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="price_budget",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="category",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="job_type",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="skill",
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
    public function store(JobRequest $request)
    {
     	return new JobResource($this->jobService->createJob($request));
    }

     /**
     * @OA\Put(
     ** path="/job/{id}",
     *   tags={"Job"},
     *   summary="Update job",
     *   operationId="update",
     *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="job id",
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
     *  @OA\Parameter(
     *      name="job_description",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="milestone",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="price_budget",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="category",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="job_type",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="skill",
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

    public function update(Job $job, JobRequest $request): JobResource
    {
    	return new JobResource($this->jobService->updateJob($job, $request));
    }

  /**
     * @OA\Delete(
     ** path="/job/{id}",
     *   tags={"Job"},
     *   summary="delete job",
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
    public function destroy(Job $job):JsonResource
    {
    	$this->jobService->deleteJob($job);
    	return (new JsonResource(null))->additional(["message" => "success! Job deleted."]);
    }

     /**
     * @OA\Post(
     ** path="/job/applyforjob",
     *   tags={"Job"},
     *   summary="apply for job",
     *   operationId="applyForJob",
    *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="job_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="accept_price",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="price_to_accept",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="pitch",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="text"
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
    public function applyForJob(Request $request)
    {      
         try{
           $job_user =  JobUser::create([
                'user_id' => auth()->user()->id,
                'job_id' => $request->job_id,
                'accept_price' => $request->accept_price,
                'price_to_accept' => $request->price_to_accept,
                'pitch' => $request->pitch
            ]);

            return response()->json([ 'success' => true, 'job_user' => $job_user->load('user','job') ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }

    /**
     * @OA\Post(
     ** path="/job/rejectbid/{id}",
     *   tags={"Job"},
     *   summary="reject bid",
     *   operationId="rejectbid",
    *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="rejection_reason",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="text"
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
    public function rejectbid(Request $request, $id)
    {
          try{
            $bid = JobUser::where('id', $id)->update([ 'accept_bid' => 'no', 'rejection_reason' => $request->rejection_reason ]);
            
            return response()->json([ 'success' => true, 'bid' => $bid ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }


     /**
     * @OA\Get(
     ** path="/job/getallsentjoboffers/{id}",
     *   tags={"Job"},
     *   summary="get all sent job offers",
     *   operationId="getAllSentJobOffers",
     *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="job id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
    public function getAllSentJobOffers($id)
    {
          try{
            $joboffers = JobUser::where('job_id', $id)->get();
            return response()->json([ 'success' => true, 'joboffers' => $joboffers->load('user','job') ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }


    /**
     * @OA\Get(
     ** path="/job/getopenjobs",
     *   tags={"Job"},
     *   summary="get list of open jobs with bids",
     *   operationId="getOpenJobs",
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
     public function getOpenJobs()
    {
          try{
            $openjobs = Job::where(['job_type' => 'open', 'user_id' => auth()->user()->id ])->get();
            return response()->json([ 'success' => true, 'openjobs' => $openjobs->load('user','job_bids') ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }

 
   /**
     * @OA\Post(
     ** path="/job/acceptagreement",
     *   tags={"Job"},
     *   summary="accept agreement",
     *   operationId="acceptAgreement",
    *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="creative_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * *  @OA\Parameter(
     *      name="bid_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="start_date",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="datetime"
     *      )
     *   ),
      *      @OA\Parameter(
     *      name="end_date",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="datetime"
     *      )
     *   ),
       *      @OA\Parameter(
     *      name="job_type",
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
      public function acceptAgreement(Request $request)
    {
          try{
            JobUser::where('job_id', $request->id)->update(['accept_bid' => 'no']);
            JobUser::where('id', $request->bid_id)->update(['accept_bid' => 'yes']);

            $job = Job::where('id',$request->id)->update([
            'creative_id' => $request->creative_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'job_type' => $request->job_type,
            'status' => 'pending'
            ]);

            return response()->json([ 'success' => true, 'job' => $job ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }

     /**
     * @OA\Get(
     ** path="/gethunterorders",
     *   tags={"Job"},
     *   summary="get list of closed jobs for hunter",
     *   operationId="getHunterOrders",
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
     public function getHunterOrders()
    {
          try{
            $closedjobs = Job::where(['job_type' => 'close', 'user_id' => auth()->user()->id ])->get();
            return response()->json([ 'success' => true, 'closedjobs' => $closedjobs->load('user','job_bids') ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }

 /**
     * @OA\Get(
     ** path="/getcreativeorders",
     *   tags={"Job"},
     *   summary="get list of closed jobs for creative",
     *   operationId="getCreativeOrders",
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
     public function getCreativeOrders()
    {
          try{
            // $closedjobs = Job::where(['job_type' => 'close', 'creative_id' => auth()->user()->id ])->get();
            $closedjobs = Job::where([
                ['job_type', '=', 'close'],
                ['creative_id', '=', auth()->user()->id] 
            ])->get();
            return response()->json([ 'success' => true, 'closedjobs' => $closedjobs->load('user','job_bids') ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }

    /**
     * @OA\Get(
     ** path="/job/getappliedjobs/{id}",
     *   tags={"Job"},
     *   summary="get list of job a particular talent applied for",
     *   operationId="getAppliedJobs",
     *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="user id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
    public function getAppliedJobs($id)
    {   
        try{
           $appliedjobs = DB::table('job_users')
                    ->join('jobs', 'jobs.id', '=', 'job_users.job_id')
                    ->join('users', 'users.id', '=', 'jobs.user_id')
                    ->select('job_users.*', 'jobs.*','users.*', 'jobs.created_at as jobs_created_at', 'job_users.created_at as job_users_created_at', 'users.created_at as users_created_at')
                    ->where('job_users.user_id', $id)
                    ->get();

            return response()->json([ 'success'=>true, 'appliedjobs' => $appliedjobs ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }

    /**
     * @OA\Get(
     ** path="/job/getacceptedbids/{id}",
     *   tags={"Job"},
     *   summary="get list of talent job-bids accepted by hunter/won bids",
     *   operationId="getAcceptedBids",
     *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="user id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
    public function getAcceptedBids($id)
    {
          try{
            $acceptedBids = Job::where([
                ['creative_id', '=', $id],
                ['status', '=', 'pending'],
            ])->get();
            return response()->json([ 'success' => true, 'acceptedBids' => $acceptedBids ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }

    /**
     * @OA\Put(
     ** path="/job/startjob",
     *   tags={"Job"},
     *   summary="Accept hunter's offer/start job",
     *   operationId="startJob",
    *   security={{"bearer_token":{}}},
     *  @OA\Parameter(
     *       name="id",
     *       description="job id",
     *       required=true,
     *       in="path",
     *       @OA\Schema(
     *           type="integer"
     *       )
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
    public function startJob(Request $request, $id)
    {
          try{

            $job = Job::where('id', $id)->update([
                'status' => 'active'
            ]);

            return response()->json([ 'success' => true, 'job' => $job ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }

    /**
     * @OA\Get(
     ** path="/job/getactivejobs/{id}",
     *   tags={"Job"},
     *   summary="get user's ongoing jobs",
     *   operationId="getActiveJobs",
     *   security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="user id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
    public function getActiveJobs(Request $request, $id)
    {
          try{
            $activeJobs = Job::where([
                ['user_id', '=', $id],
                ['status', '=', 'active'],
            ])->orWhere([
                ['creative_id', '=', $id],
                ['status', '=', 'active']
            ])->get()->load('user', 'creative');
            return response()->json([ 'success' => true, 'activeJobs' => $activeJobs ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }

    /**
    * Submit Job 
    */
 
     /**
     * @OA\Post(
     ** path="/job/submitjob{id}",
     *   tags={""},
     *   summary="Submit job",
     *   operationId="submitjob",
    *   security={{"bearer_token":{}}},
     *
     * * @OA\Parameter(
     *      name="job_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     *  @OA\Parameter(
     *      name="comment",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="text"
     *      )
     *   ),
     * 
     *  @OA\Parameter(
     *      name="path",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
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
    public function submitJob(Request $request, $id)
    { 
      try {
            $job = Job::find($id);

            if(!$job)
                return response()->json([ 'success' => true, 'message' => 'Job Not Found' ]);

            // Handle File Upload
            $request->validate([
                'path' => 'mimes:pdf,csv,docx,doc,ppt,png,jpg,jpeg,mp4|max:2048'
            ]);
            
            $filePath = '';

            if($request->file()){
                $fileName = time().'_'.$request->file('path')->getClientOriginalName();
                $filePath = $request->file('path')->storeAs('uploads', $fileName, 'public');
                $filePath = '/storage/' . $filePath;
            }

            $submission = SubmitJob::create([
                'job_id' => $id,
                'hunter_id' => $job->user_id,
                'creative_id' => $job->creative_id,
                'comment' => $request->comment,
                'path' => $filePath
            ]);

            $job->status = 'submitted';
            $job->save();

            return response()->json([ 'success' => true, 'submission' => $submission  ]);
      }
      catch(Exception $ex)
      {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage()) ]);
      }
    }

    /**
     * @OA\Get(
     ** path="/job/getsubmittedjobs",
     *   tags={""},
     *   summary="Get Submitted jobs",
     *   operationId="getsubmittedjobs",
    *   security={{"bearer_token":{}}},
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
    public function getSubmittedJobs()
    { 
        try {
            // Get jobs that have one or more submissions
            $submitted_jobs = SubmitJob::where('hunter_id', auth()->user()->id)
                                ->orWhere('creative_id', auth()->user()->id)
                                ->groupBy('job_id')
                                ->get()
                                ->load('job');

            return response()->json([ 'success' => true, 'submittedjobs' => $submitted_jobs  ]);
            
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage()) ]);
        }
    }

    /**
     * @OA\Get(
     ** path="/job/getsubmittedjob/{submission_id}",
     *   tags={""},
     *   summary="Get Submitted job",
     *   operationId="getsubmittedjob",
    *   security={{"bearer_token":{}}},
     * 
     *  @OA\Parameter(
     *      name="job_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   )
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
    public function getSubmittedJob($id)
    { 
        try {
            // $submission = SubmitJob::where('job_id', $id)
            //                     ->get()
            //                     ->load('job', 'hunter', 'creative');

            // return response()->json([ 'success' => true, 'submission' => $submission ]);

            $submission = Job::where('id', $id)
                                ->get()
                                ->load('job_submissions', 'user', 'creative');

            return response()->json([ 'success' => true, 'submission' => $submission ]);
            
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage()) ]);
        }
    }

    /**
    * Accept Submitted Job 
    */
 
     /**
     * @OA\Put(
     ** path="/job/acceptsubmittedjob/{id}",
     *   tags={""},
     *   summary="Accept Submitted Job",
     *   operationId="acceptSubmittedJob",
    *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="job_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   )
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
    public function acceptSubmittedJob(Request $request, $id)
    { 
      try {
            $job = Job::find($id);

            if(!$job)
                return response()->json([ 'success' => true, 'message' => 'Job Not Found' ]);

            $job->status = 'accepted';
            $job->save();

            return response()->json([ 'success' => true, 'job' => $job  ]);
      }
      catch(Exception $ex)
      {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage()) ]);
      }
    }

    /**
     * @OA\Get(
     ** path="/job/getacceptedjobs",
     *   tags={""},
     *   summary="Get Accepted Jobs",
     *   operationId="getacceptedjobs",
    *   security={{"bearer_token":{}}},
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
    public function getAcceptedJobs()
    { 
        try {
            $accepted_jobs = Job::where([
                ['user_id', '=', auth()->user()->id],
                ['status', '=', 'accepted']
            ])->orWhere([
                ['creative_id', '=', auth()->user()->id],
                ['status', '=', 'accepted']
            ])->get()->load('user', 'creative', 'review');

            return response()->json([ 'success' => true, 'acceptedjobs' => $accepted_jobs  ]);
            
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage()) ]);
        }
    }
}
