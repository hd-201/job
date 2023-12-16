<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\File;
use Illuminate\Http\UploadedFile;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $job = new Job();
        $job->name = $data['name'];
        $job->desc = $data['desc'];
        $job->content = $data['content'];

        $start_time = Carbon::createFromFormat('d-m-Y', $data['start_time']);
        $job->start_time =  $start_time;

        $end_time = Carbon::createFromFormat('d-m-Y', $data['end_time']);
        $job->end_time = $end_time;
        $job->prioritize = $data['prioritize'];
        $job->status = '1';

        // $file = $data['start_file'];
        // $job->start_file =  $file;
        $job->save();
        return redirect('/')->with('success', 'Thêm công việc thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $job = Job::find($id);

        $job->status = $data['status'];
        $job->comment = $data['comment'];

        $file = $request->file('complete_file');

        // Tạo đường dẫn lưu trữ dựa trên tháng và năm hiện tại
        $storagePath = 'jobs/' . date('FY');

        // Lưu tệp vào thư mục lưu trữ (storage) với tên gốc
        $filePath = $file->storeAs($storagePath, $file->getClientOriginalName());

        // Lưu thông tin tệp vào cơ sở dữ liệu
        // Job::create([
        //     'download_link' => $filePath,
        //     'original_name' => $file->getClientOriginalName(),
        // ]);[{"download_link":"jobs\\December2023\\vin777.cx-refdomains-subdomains__2023-12-14_14-23-56.csv"}]
        $job->complete_file = $filePath;
        $job->save();
        return redirect('/')->with('success', 'Lưu thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
