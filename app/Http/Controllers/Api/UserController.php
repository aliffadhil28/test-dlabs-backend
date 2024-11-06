<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;
        $offset = $request->get('offset') ? $request->get('offset') : 0;
        $data = User::skip($offset)->take($limit)->get();
        return response()->json([
            'message' => 'Sukses mendapatkan data',
            'limit' => $limit,
            'offset' => $offset,
            'user'=>$data
        ],200);
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
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'age' => 'required|integer|min:0',
                'role' => 'string'
            ]);
    
            $data = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'role' => $request->get('role'),
                'age' => $request->get('age')
            ];
    
            $user = User::create($data);
            return response()->json([
                'message' => 'User berhasil ditambahkan',
                'user' => $user
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $user = User::find($id);
            return response()->json([
                'message' => 'Sukses mendapatkan data',
                'user'=>$user
            ],200);
        }catch(\Throwable $th){
            return response()->json([
                'message' => $th->getMessage(),
            ],500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::find($id);
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'role' => 'string',
                'age' => 'required|integer|min:0',
            ]);
    
            $data = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $request->get('password') ? Hash::make($request->get('password')) : $user->password,
                'role' => $request->get('role'),
                'age' => $request->get('age'),
            ];

            $user->update($data);
            return response()->json([
                'message' => 'User berhasil diperbarui',
                'user' => $user
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return response()->json([
                'message' => 'User berhasil di hapus',
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ],500);
        }
    }
}
