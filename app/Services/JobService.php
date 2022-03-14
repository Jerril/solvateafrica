<?php

namespace App\Services;

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\JobRequest;
use Exception;
use App\Exception\ApplicationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class JobService
{

	/**
	* @var User
	*/ 
	private $authUser;

	private $job;


	public function __construct(Job $job )
	{
		$this->authUser = auth()->user();
		$this->$job = $job;
	}

	public function createJob(JobRequest $request)
	{ 
		  try {
		 	$data = $request->all();
			$data['user_id'] =  auth()->user()->id;
			$job = Job::create($data); 
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}

		return $job;
	}

	public function getAllJobs(): LengthAwarePaginator
	{
		return Job::orderBy('id','DESC')->with('user')->paginate(15);
	}

	public function getJobs(): LengthAwarePaginator
	{
		$jobBuilder = Job::where('user_id',auth()->user()->id);
		return $jobBuilder->orderBy('id','DESC')->paginate(15);
	}

	public function updateJob(Job $job, JobRequest $request): Job
	{
		try {
			$job->update($request->validated());
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}

		return $job;
	}

	public function deleteJob(Job $job): void
	{
		try {
			$job->delete();
		}
		catch(Exception $exception ) {
			Log::error($exception);
		}
	}
}