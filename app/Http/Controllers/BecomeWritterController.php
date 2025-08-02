<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WritterRequest;
use Illuminate\Support\Facades\Auth;

class BecomeWritterController extends Controller
{
    public function index()
    {
        $existing = WritterRequest::where('userID', Auth::id())->where('requestSatus','PENDING')->first();
        return view('becomeWritterRequest', compact('existing'));
    }
    public function store(Request $request)
    {
        $userId = Auth::id();
        $user = Auth::user();
        $roles = $user->getRoleNames();
        $user = Auth::user();
        $exists = WritterRequest::where('userID', $userId)->where('requestSatus','PENDING')->first();
        //$existsApproved = WritterRequest::where('userID', $userId)->where('requestStatus','APPROVED')->first();
        if($roles == ['reader'] && $exists) {
            // return back()->with('error', 'You are already a writer.');
            return back()->with('error', 'You have already submitted a writer request.');
        }else{
             WritterRequest::create([
            'userID' => $userId,
            'requestSatus' => 'pending',
            ]);
            return redirect()->route('dashboard')->with('success', 'Your request has been submitted to the admin.');
        }
        // else if($roles == ['reader'] && $existsApproved){
        //      WritterRequest::create([
        //     'userID' => $userId,
        //     'requestSatus' => 'pending',
        //     ]);
        //     return redirect()->route('dashboard')->with('success', 'Your request has been submitted to the admin.');
        // }
    }
}

