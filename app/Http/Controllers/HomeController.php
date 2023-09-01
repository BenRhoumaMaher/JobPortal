<?php

namespace App\Http\Controllers;

use App\Models\Job\Job;
use App\Models\Job\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Job $job, Search $search)
    {

        $duplicates = $search->select('keyword', DB::raw('COUNT(*) as `count`'))
        ->groupBy('keyword')->havingRaw('COUNT(*) > 1')->take(3)->orderBy('count', 'asc')->get();

        $jobs = $job->take(5)->orderBy('id', 'desc')->get();
        $totalJobs = $job->count();
        return view('home')->with([
            'jobs' => $jobs,
            'totalJobs' => $totalJobs,
            'duplicates' => $duplicates,
        ]);
    }
    public function about()
    {
        return view('pages.about');
    }
    public function contact()
    {
        return view('pages.contact');
    }
}