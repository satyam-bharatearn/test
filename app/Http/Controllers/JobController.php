<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::where('user_id', 1)->orderBy('created_at', 'desc')->get();
        $hasJobs = $jobs->count() > 0;
        
        return view('jobs', compact('jobs', 'hasJobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('new-job');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'client' => 'required|string|max:255',
            'job_number' => 'nullable|string|max:50',
            'salesperson' => 'nullable|string|max:255',
            'job_type' => 'required|in:one-off,recurring',
            'schedule_date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'repeats' => 'nullable|string|max:255',
            'visit_instructions' => 'nullable|string',
            'notes' => 'nullable|string',
            'total_cost' => 'nullable|numeric|min:0',
            'total_price' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get the next job number if not provided
        $jobNumber = $request->job_number;
        if (empty($jobNumber)) {
            $lastJob = Job::orderBy('id', 'desc')->first();
            $jobNumber = $lastJob ? $lastJob->id + 1 : 1;
        }

        // Process product items
        $productItems = [];
        if ($request->has('product_items')) {
            $productItems = json_decode($request->product_items, true);
        }

        // Process attachments
        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $attachments[] = [
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType()
                ];
            }
        }

        $job = Job::create([
            'user_id' => 1,
            'title' => $request->title,
            'client' => $request->client,
            'job_number' => $jobNumber,
            'salesperson' => $request->salesperson,
            'job_type' => $request->job_type,
            'schedule_date' => $request->schedule_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'schedule_later' => $request->has('schedule_later'),
            'anytime' => $request->has('anytime'),
            'repeats' => $request->repeats,
            'repeat_end_type' => $request->repeat_end_type,
            'repeat_end_after_number' => $request->repeat_end_after_number,
            'repeat_end_after_period' => $request->repeat_end_after_period,
            'repeat_end_on_date' => $request->repeat_end_on_date,
            'visit_instructions' => $request->visit_instructions,
            'email_team' => $request->has('email_team'),
            'send_invoice' => $request->has('send_invoice'),
            'product_items' => $productItems,
            'total_cost' => $request->total_cost ?? 0,
            'total_price' => $request->total_price ?? 0,
            'notes' => $request->notes,
            'attachments' => $attachments,
            'status' => 'pending'
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('job-details', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('new-job', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'client' => 'nullable|string|max:255',
            'job_number' => 'nullable|string|max:50',
            'salesperson' => 'nullable|string|max:255',
            'job_type' => 'required|in:one-off,recurring',
            'schedule_date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'repeats' => 'nullable|string|max:255',
            'visit_instructions' => 'nullable|string',
            'notes' => 'nullable|string',
            'total_cost' => 'nullable|numeric|min:0',
            'total_price' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Process product items
        $productItems = [];
        if ($request->has('product_items')) {
            $productItems = json_decode($request->product_items, true);
        }

        // Process attachments
        $attachments = $job->attachments ?? [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $attachments[] = [
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType()
                ];
            }
        }

        $job->update([
            'title' => $request->title,
            'client' => $request->client,
            'job_number' => $request->job_number,
            'salesperson' => $request->salesperson,
            'job_type' => $request->job_type,
            'schedule_date' => $request->schedule_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'schedule_later' => $request->has('schedule_later'),
            'anytime' => $request->has('anytime'),
            'repeats' => $request->repeats,
            'repeat_end_type' => $request->repeat_end_type,
            'repeat_end_after_number' => $request->repeat_end_after_number,
            'repeat_end_after_period' => $request->repeat_end_after_period,
            'repeat_end_on_date' => $request->repeat_end_on_date,
            'visit_instructions' => $request->visit_instructions,
            'email_team' => $request->has('email_team'),
            'send_invoice' => $request->has('send_invoice'),
            'product_items' => $productItems,
            'total_cost' => $request->total_cost ?? 0,
            'total_price' => $request->total_price ?? 0,
            'notes' => $request->notes,
            'attachments' => $attachments,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Job deleted successfully!'
        ]);
    }
}
