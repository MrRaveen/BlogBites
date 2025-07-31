<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WritterRequest;
use Illuminate\Support\Facades\Auth;

class BecomeWritterController extends Controller
{
    public function index()
    {
        $existing = WritterRequest::where('userID', Auth::id())->first();

        return view('becomeWritterRequest', compact('existing'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $exists = WritterRequest::where('userID', $userId)->first();
        if ($exists) {
            return back()->with('error', 'You have already submitted a writer request.');
        }

        WritterRequest::create([
            'userID' => $userId,
            'requestSatus' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Your request has been submitted to the admin.');
    }
}

