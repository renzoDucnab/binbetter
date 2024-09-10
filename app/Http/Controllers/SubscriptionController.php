<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Subscriptions";
        return view('pages.back.v_subscription', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subscriptions = Subscription::whereNull('deleted_at')->get();

        $formattedData = $subscriptions->map(function ($item) {
            return [
                'type' => $item->subscription_type,
                'description' => $item->subscription_desc,
                'actions' =>
                '<a class="edit-btn" href="javascript:void(0)" 
                        data-id="' . $item->id . '"
                        data-type="' . $item->subscription_type . '"
                        data-description="' . $item->subscription_desc . '"
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
            'subscription_type' => 'required|string',
            'subscription_description' => 'required'
        ]);

        Subscription::create([
            'subscription_type' => $request->subscription_type,
            'subscription_desc' => $request->subscription_description,
        ]);

        return response()->json([
            'message' => 'Subscription saved successfully',
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

        $subscription = Subscription::find($id);

        if (!$subscription) {
            return response()->json(['error' => 'Subscription not found'], 404);
        }

        // Validate incoming request data
        $request->validate([
            'subscription_type' => 'required|string',
            'subscription_description' => 'required'
        ]);

        $subscription->update([
            'subscription_type' => $request->subscription_type,
            'subscription_desc' => $request->subscription_description,
        ]);

        return response()->json(['message' => 'Subscription updated successfully', 'type' => 'success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscription = Subscription::find($id);
        $subscription->delete();

        return response()->json(['message' => 'Subscription deleted successfully', 'type' => 'success']);
    }
}
