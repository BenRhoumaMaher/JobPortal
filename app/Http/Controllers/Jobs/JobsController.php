<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Job\Application;
use App\Models\Job\Job;
use App\Models\Job\JobSaved;
use App\Models\Job\Search;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function single(Job $job, JobSaved $jobSaved, Application $application, Category $category)
    {
        $jobs = $job->where('category', $job->category)->where('id', '!=', $job->id)->take(5)->orderBy('category', 'desc')->get();
        $jobCount = $jobs->count();
        $categories = $category->get();
        if(auth()->check()) {
            $savedJob = $jobSaved->where('job_id', $job->id)->where('user_id', auth()->user()->id)->count();
            $appliedJob = $application->where('job_id', $job->id)->where('user_id', auth()->user()->id)->count();

            return view('jobs.single')->with([
                'job' => $job,
                'jobs' => $jobs,
                'jobCount' => $jobCount,
                'savedJob' => $savedJob,
                'appliedJob' => $appliedJob,
                'categories' => $categories,
            ]);
        } else {
            return view('jobs.single')->with([
                'job' => $job,
                'jobs' => $jobs,
                'jobCount' => $jobCount,
                'categories' => $categories,
            ]);
        }

    }
    public function saveJob(JobSaved $jobSaved, Request $request)
    {
        $saveJob = $jobSaved->create([
            'job_id' => $request->job_id,
            'user_id' => $request->user_id,
            'job_image' => $request->job_image,
            'job_title' => $request->job_title,
            'job_region' => $request->job_region,
            'job_type' => $request->job_type,
            'company' => $request->company,
        ]);
        return redirect()->to('/jobs/single/'.$request->job_id.'')->with('create', 'job was saved');
    }
    public function jobApply(Request $request, Application $application)
    {
        if($request->cv == 'no cv') {
            return redirect()->to('/jobs/single/'.$request->job_id.'')->with('save', 'upload your cv first please');
        } else {
            $applyJob = $application->create([
            'cv' => auth()->user()->cv,
            'job_id' => $request->job_id,
            'user_id' => auth()->user()->id,
            'job_image' => $request->job_image,
            'job_title' => $request->job_title,
            'job_region' => $request->job_region,
            'job_type' => $request->job_type,
            'company' => $request->company,
        ]);
        }
        return redirect()->to('/jobs/single/'.$request->job_id.'')->with('apply', 'Congrats ! youve applied for the job !');
    }
    public function search(Request $request, Job $job, Search $search)
    {

        $search->create([
            'keyword' => $request->job_title,
        ]);

        $job_title = $request->get('job_title');
        $job_region = $request->get('job_region');
        $job_type = $request->get('job_type');

        $searches = $job->where('job_title', 'like', "%$job_title%")
        ->where('job_region', 'like', "%$job_region%")
        ->where('job_type', 'like', "%$job_type%")
        ->get();

        return view('jobs.search')->with([
            'searches' => $searches,
        ]);
    }
}
