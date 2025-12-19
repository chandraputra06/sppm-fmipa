<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudyProgramRequest;
use App\Http\Requests\UpdateStudyProgramRequest;
use Illuminate\Support\Facades\DB;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studyPrograms = StudyProgram::get();
        return response()->json([
            'data'=>$studyPrograms,
            'message'=>'Success get data study programs'
        ], 200);
        // return view('admin-page.study-programs.index', compact('studyPrograms'));
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
    public function store(StoreStudyProgramRequest $request)
    {
        DB::beginTransaction();
        try {
            $studyProgram = StudyProgram::create([
                'name'=>$request->name
            ]);
            DB::commit();
            return response()->json([
                'data'=>$studyProgram,
                'message'=>'Success create study program'
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message'=>'Failed create study program',
                'error'=>$th->getMessage()
            ], 400);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(StudyProgram $studyProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudyProgram $studyProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudyProgramRequest $request, StudyProgram $studyProgram)
    {
        DB::beginTransaction();
        try {
            $studyProgram->update([
                'name'=>$request->name
            ]);
            DB::commit();
            return response()->json([
                'data'=>$studyProgram,
                'message'=>'Success update study program'
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message'=>'Failed update study program',
                'error'=>$th->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyProgram $studyProgram)
    {
        DB::beginTransaction();
        try {
            $studyProgram->delete();
            DB::commit();
            return response()->json([
                'message'=>'Success delete study program'
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message'=>'Failed delete study program',
                'error'=>$th->getMessage()
            ], 400);
        }
    }
}
