<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PostReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Post Reports";
        return view('pages.back.v_postreport', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postreport = PostReport::whereNull('deleted_at')->get();

        $formattedData = $postreport->map(function ($item) {
            return [
                'type' => $item->type,
                'address' => $item->address,
                'photo' => $item->photo,
                'description' => $item->description,
                'status' => $item->status,
                'actions' =>
                '<a class="edit-btn" href="javascript:void(0)" 
                        data-id="' . $item->id . '"
                        data-type="' . $item->type . '"
                        data-address="' . $item->address . '"
                        data-photo="' . $item->photo . '"
                        data-description="' . $item->description . '"
                        data-modaltitle="Edit">
                    <i class="bi bi-pencil-square fs-3"></i>
                    </a>

                    <a class="delete-btn" href="javascript:void(0)" data-id="' . $item->id . '">
                    <i class="bi bi-trash fs-3"></i>
                    </a>'
            ];
        });

        return response()->json(['data' => $formattedData]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'type' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'address' => 'required_if:type,Garbage', // Validate address only if type is Garbage
            'description' => 'required'
        ]);

        $imagePath = null;

        if ($request->hasFile('photo')) {
            $imgFile = $request->file('photo');
            $filename = time() . '_' . $imgFile->getClientOriginalName();
            $imagePath = 'assets/uploads/' . $filename;
            $imgFile->move(public_path('assets/uploads'), $filename);
        }

        $user = User::getCurrentUser();

        PostReport::create([
            'resident_id' => $user->id,
            'type' => $request->type,
            'photo' => $imagePath,
            'address' => $request->address,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Post report saved successfully',
            'type' => 'success'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $postreport = PostReport::find($id);

        if (!$postreport) {
            return response()->json(['error' => 'Post report not found'], 404);
        }

        $request->validate([
            'type' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'address' => 'required',
            'description' => 'required'
        ]);

        $imagePath = $postreport->photo;

        if ($request->hasFile('photo')) {

            if ($postreport->photo && file_exists(public_path($postreport->photo))) {
                unlink(public_path($postreport->photo));
            }

            $imgFile = $request->file('photo');
            $filename = time() . '_' . $imgFile->getClientOriginalName();
            $imagePath = 'assets/uploads/' . $filename;
            $imgFile->move(public_path('assets/uploads'), $filename);
        }

        $postreport->update([
            'type' => $request->type,
            'photo' => $imagePath,
            'address' => $request->address,
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Post report updated successfully', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postreport = PostReport::find($id);

        if ($postreport) {
            if ($postreport->photo && file_exists(public_path($postreport->photo))) {
                unlink(public_path($postreport->photo));
            }
        }

        $postreport->delete();

        return response()->json(['message' => 'Post report deleted successfully', 'type' => 'success']);
    }
}
