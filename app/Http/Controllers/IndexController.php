<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Staff;
use App\Team;
use Illuminate\Support\Facades\Redirect;


class IndexController extends Controller
{
    public function home(){
        $jobs =  Job::orderBy('prioritize', 'desc')
                ->orderBy(function ($query) {
                    $query->selectRaw('DATEDIFF(end_time, NOW()) as days_remaining');
                }, 'desc')
                ->paginate(10);
        return view('home', compact('jobs'));
    }
    public function getJobDetail($id){
        $job = Job::find($id);
        if (isset($job->start_file)) {
            $fileInfoStart = json_decode($job->start_file, true);
            $job->file_name = $fileInfoStart[0]['original_name'] ? $fileInfoStart[0]['original_name'] : 'None';
            $job->file_link = $fileInfoStart[0]['download_link'] ? $fileInfoStart[0]['download_link'] : '#';
        }  
        else {
            $job->file_name = 'No File';
            $job->file_link = '#';
        }
        if (isset($job->complete_file)) {
            $fileInfoComp = json_decode($job->complete_file, true);
            $job->file_name_comp = isset($fileInfoComp[0]['original_name']) ? $fileInfoComp[0]['original_name'] : 'None';
            $job->file_link_comp = isset($fileInfoComp[0]['download_link']) ? $fileInfoComp[0]['download_link'] : '#';
        }  
        else {
            $job->file_name_comp = 'No File';
            $job->file_link_comp = '#';
        }
        return view('modal.job_modal', compact('job'));
    }
    public function jobEdit($id){
        $job = Job::find($id);
        if (isset($job->start_file)) {
            $fileInfoStart = json_decode($job->start_file, true);
            $job->file_name = $fileInfoStart[0]['original_name'] ? $fileInfoStart[0]['original_name'] : 'None';
            $job->file_link = $fileInfoStart[0]['download_link'] ? $fileInfoStart[0]['download_link'] : '#';
        }  
        else {
            $job->file_name = 'No File';
            $job->file_link = '#';
        }
        return view('modal.edit_modal', compact('job'));
    }
    public function getReport($id){
        $job = Job::find($id);
        return view('modal.report_modal', compact('job'));
    }
    public function staff(){
        $staffs = Staff::orderBy('id', 'DESC')->paginate(10);
        return view('staff', compact('staffs'));
    }
    public function team(){
        $teams = Team::orderBy('id', 'DESC')->paginate(10);
        return view('team', compact('teams'));
    }
    public function filter($value){
        if ($value==6) {
            return Redirect::to('/');
        } else {
            $jobs = Job::where('status', $value)->paginate(10);
        }
        return view('home', compact('jobs'));
    }
}
