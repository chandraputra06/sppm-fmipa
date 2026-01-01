<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::when($request->filled('search'), function ($query) use ($request) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })
            ->when($request->filled('role'), function ($query) use ($request) {
                $query->where('role', $request->role);
            })
            ->orderByDesc('id')
            ->get();
        return view('admin-page.users.index', compact('users'));
        // return response()->json([
        //     'message' => 'Success get data user',
        //     'data' => $user,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $studyPrograms = StudyProgram::get();
        return view('admin-page.users.create', compact('studyPrograms'));
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

            if ($request->role == '2') {
                Lecture::create([
                    'name' => $request->name,
                    'study_program_id' => $request->study_program_id,
                    'user_id' => $user->id,
                ]);
            }

            if ($request->role == '3') {
                Student::create([
                    'nim' => $request->nim,
                    'name' => $request->name,
                    'study_program_id' => $request->study_program_id,
                    'user_id' => $user->id,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('users.index')
                ->with('success', 'User created successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('users.create')
                ->with('error', 'Failed to create user: ' . $th->getMessage());
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
        $user->load(['lecture', 'student']);
        $studyPrograms = StudyProgram::get();
        return view('admin-page.users.edit', compact('user', 'studyPrograms'));
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
                // hapus data lama (pakai model instance agar event deleting terpicu)
                optional($user->lecture)->delete();
                optional($user->student)->delete();
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

            return redirect()
                ->route('users.index')
                ->with('success', 'User updated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('users.update', $user->id)
                ->with('error', 'Failed to update user: ' . $th->getMessage());
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
            optional($user->lecture)->delete();
            optional($user->student)->delete();

            $user->delete();
            DB::commit();
            return redirect()
                ->route('users.index')
                ->with('success', 'User deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('users.index')
                ->with('error', 'Failed to delete user: ' . $th->getMessage());
        }
    }
}
