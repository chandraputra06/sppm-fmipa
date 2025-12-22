<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::get();
        return response()->json([
            'data'=>$students,
            'message'=>'Success get data students'
        ], 200);
        // return view('admin-page.students.index', compact('students'));
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
    public function store(StoreStudentRequest $request)
    {
        DB::beginTransaction();
        try {
            $students = Student::create([
                'nim'=>$request->nim,
                'name'=>$request->name,
                'study_program_id'=>$request->study_program_id,
                'user_id'=>$request->user_id,
            ]);
            DB::commit();
            return response()->json([
                'data'=>$students,
                'message'=>'Success create student'
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message'=>'Failed create student',
                'error'=>$th->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        DB::beginTransaction();
        try {
            $student->update([
                'nim'=>$request->nim,
                'name'=>$request->name,
                'study_program_id'=>$request->study_program_id,
                'user_id'=>$request->user_id,
            ]);
            DB::commit();
            return response()->json([
                'data'=>$student,
                'message'=>'Success update student'
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message'=>'Failed update student',
                'error'=>$th->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        DB::beginTransaction();
        try {
            $student->delete();
            DB::commit();
            return response()->json([
                'message'=>'Success delete student'
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message'=>'Failed delete student',
                'error'=>$th->getMessage()
            ], 400);
        }
    }
}
