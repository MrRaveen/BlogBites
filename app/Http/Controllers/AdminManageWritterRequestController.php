<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WritterRequest;
use App\Models\BlogUser;

class AdminManageWritterRequestController extends Controller
{
    public function index()
    {
        $requests = WritterRequest::with('user')->where('requestSatus', 'pending')->get();
        return view('adminCheckWritterRequestView', compact('requests'));
    }

    public function approve($id)
    {
        $request = WritterRequest::findOrFail($id);
        $request->requestSatus = 'approved';
        $request->save();

        $user = BlogUser::find($request->userID);
        $user->assignRole('writter');

        return redirect()->back()->with('success', 'Writer request approved.');
    }

    public function reject($id)
    {
        $request = WritterRequest::findOrFail($id);
        $request->requestSatus = 'rejected';
        $request->save();

        return redirect()->back()->with('success', 'Writer request rejected.');
    }
}

