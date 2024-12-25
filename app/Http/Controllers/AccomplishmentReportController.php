<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccomplishmentReport;

class AccomplishmentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable|string',
            'workload' => 'nullable|string',
            'sort' => 'nullable|string|in:asc,desc',
        ]);
    
        // Fetch the authenticated user
        $user = auth()->user();
    
        // Start building the query for fetching accomplishment reports
        $query = AccomplishmentReport::with('user')
            ->where('user_id', $user->id);
    
        // Apply date filter if both start and end dates are provided
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = \Carbon\Carbon::parse($request->start_date)->startOfDay();
            $endDate = \Carbon\Carbon::parse($request->end_date)->endOfDay();
    
            $query->whereBetween('date', [$startDate, $endDate]);
        }
    
        // Apply status filter if it exists
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
    
        // Apply workload filter if it exists
        if ($request->has('workload')) {
            $workload = $request->get('workload');
            $query->where(function ($query) use ($workload) {
                $query->where('municipality', 'like', '%' . $workload . '%')
                    ->orWhere('barangay', 'like', '%' . $workload . '%')
                    ->orWhere('enumeration_area', 'like', '%' . $workload . '%');
            });
        }
    
        // Apply sorting by date (default to descending if not provided)
        $sortOrder = $request->get('sort', 'desc'); // Default to 'desc'
        $query->orderBy('date', $sortOrder);
    
        // Paginate the results
        $accomplishmentReports = $query->paginate(10); 

        return view('accomplishment_report.index', [
            'accomplishment_reports' => $accomplishmentReports, 
        ]);
    }

    public function show_counts() 
    {
        // Fetch the authenticated user
        $user = auth()->user();
    
        // Calculate the total of 'original_bsn' for the authenticated user
        $totalOriginalBsn = AccomplishmentReport::where('user_id', $user->id)->sum('original_bsn'); 
        // Calculate the total of 'processed_bsn' for the authenticated user
        $totalProcessedBsn = AccomplishmentReport::where('user_id', $user->id)->sum('processed_bsn'); 
        $totalEnumerationArea = AccomplishmentReport::where('user_id', $user->id)->count('enumeration_area'); 
    
        // Pass the total to the dashboard view
        return view('dashboard', [
            'total_original_bsn' => $totalOriginalBsn, 
            'total_processed_bsn' => $totalProcessedBsn,
            'total_enumeration_area' => $totalEnumerationArea,
        ]);
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
         // Validate the incoming data
         $validated = $request->validate([
             'date' => 'required|date',
             'municipality' => 'required|string|max:255',
             'barangay' => 'required|string|max:255',
             'enumeration_area' => 'required|string|max:255',
             'original_bsn' => 'required|string|max:255',
             'processed_bsn' => 'required|string|max:255',
             'remarks' => 'nullable|string',
             'status' => 'sometimes|string|in:Pending,Completed,In Progress', // Adjust as needed
         ]);
     
         // Fetch the authenticated user
         $user = auth()->user();
     
         // Create the new accomplishment report entry
         AccomplishmentReport::create([
             'user_id' => $user->id, // Ensure the user_id is set
             'date' => $validated['date'],
             'municipality' => $validated['municipality'],
             'barangay' => $validated['barangay'],
             'enumeration_area' => $validated['enumeration_area'],
             'original_bsn' => $validated['original_bsn'],
             'processed_bsn' => $validated['processed_bsn'],
             'remarks' => $validated['remarks'] ?? '', // Empty string if not provided
             'status' => $validated['status'] ?? 'Pending', // Default to 'Pending' if not provided
         ]);
     
         // Redirect back with a success message
         return redirect()->route('monitoring')->with('success', 'Accomplishment Report created successfully.');
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
        return view('accomplishment_report.edit', [ 
            //
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'date' => 'sometimes|date',
            'municipality' => 'sometimes|string|max:255',
            'barangay' => 'sometimes|string|max:255',
            'enumeration_area' => 'sometimes|string|max:255',
            'original_bsn' => 'sometimes|integer|min:0',
            'processed_bsn' => 'sometimes|integer|min:0',
            'remarks' => 'nullable|string|max:500',
            'status' => 'sometimes|string|in:Pending,Completed,In Progress', // Adjust as needed
        ]);
    
        $report = AccomplishmentReport::findOrFail($id);
        $report->update($validated);
    
        return response()->json(['message' => 'Updated successfully']);
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $report = AccomplishmentReport::findOrFail($id);
    
        // Authorization check: Ensure the user owns the report
        if ($report->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.'); 
        }
    
        $report->delete();
    
        return redirect()->route('monitoring')->with('success', 'Deleted successfully.');
    }
}
