<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        if($request->hasFile('file')) {
            $file = $request->file('file')->store('resume','public');
            User::where('id', auth()->user()->id)->update([
                'resume' => $file
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'error']);
    }
}
