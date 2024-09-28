<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Profile $profile)
    {
        $user = Auth::user();        
        $profile = Profile::where('user_id', $user->id)->first();    
        return view('profile', compact('profile','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('UpdateProfile');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::transaction(function () use($request){
            if($request->hasFile('image')){                
                $file = $request->file('image');
                $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
                $userId = Auth::id();
                Storage::disk('local')->put('public/' . $path, file_get_contents($file));
                Profile::create([
                    'username'=>$request->username,
                    'bio'=>$request->bio,
                    'dateBirth'=>$request->dateBirth,
                    'Gender'=>$request->Gender,
                    'image'=>$path,
                    'user_id'=>$userId
                ]);
            }
        });

        return Redirect::route('indexProfile');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
