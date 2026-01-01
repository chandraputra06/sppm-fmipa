<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::get();
        return response()->json([
            'message' => 'Success get data user',
            'data' => $user,
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
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('sppm2025'),
                'role' => $request->role,
                'email_verified_at' => now(),
            ]);

            if ($request->role == 2) {
                Lecture::create([
                    'name' => $request->name,
                    'study_program_id' => $request->study_program_id,
                    'user_id' => $user->id,
                ]);
            }

            if ($request->role == 3) {
                Student::create([
                    'nim' => $request->nim,
                    'name' => $request->name,
                    'study_program_id' => $request->study_program_id,
                    'user_id' => $user->id,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Success create user',
                'data' => $user,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed create user',
                'error' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'message' => 'Success',
            'data' => $user->load(['lecture', 'student'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {

            $oldRole = (int) $user->role;
            $newRole = (int) $request->role;

            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
                'role'  =>  $request->role,
            ]);

            if ($oldRole != $newRole) {
                // hapus data lama
                $user->lecture()?->delete();
                $user->student()?->delete();
            }

            if ($newRole === 2) {
                Lecture::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'name' => $request->name,
                        'study_program_id' => $request->study_program_id,
                    ]
                );
            }

            if ($newRole === 3) {
                Student::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'nim' => $request->nim,
                        'name' => $request->name,
                        'study_program_id' => $request->study_program_id,
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'message' => 'Success update user',
                'data' => $user->fresh(['lecture', 'student']),
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed update user',
                'error' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            //User Delete Relation
            $user->lecture()?->delete();
            $user->student()?->delete();

            $user->delete();
            DB::commit();
            return response()->json([
                'message' => 'Success delete user'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed delete user',
                'error' => $th->getMessage()
            ], 400);
        }
    }
}