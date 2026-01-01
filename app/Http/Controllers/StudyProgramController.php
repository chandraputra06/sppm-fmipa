<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudyProgramRequest;
use App\Http\Requests\UpdateStudyProgramRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $studyPrograms = StudyProgram::when($request->filled('search'), function ($query) use ($request) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        })
            ->paginate(5);

        return view('admin-page.study-programs.index', compact('studyPrograms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-page.study-programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudyProgramRequest $request)
    {
        DB::beginTransaction();
        try {
            $studyProgram = StudyProgram::create([
                'name' => $request->name
            ]);
            DB::commit();
            return redirect()
                ->route('study-programs.index')
                ->with('success', 'Study program created successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('study-programs.create')
                ->with('error', 'Failed to create study program: ' . $th->getMessage());
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
        return view('admin-page.study-programs.edit', compact('studyProgram'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudyProgramRequest $request, StudyProgram $studyProgram)
    {
        DB::beginTransaction();
        try {
            $studyProgram->update([
                'name' => $request->name
            ]);
            DB::commit();
            return redirect()
                ->route('study-programs.index')
                ->with('success', 'Study program updated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('study-programs.update', $studyProgram->id)
                ->with('error', 'Failed to updated study program: ' . $th->getMessage());
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
            return redirect()
                ->route('study-programs.index')
                ->with('success', 'Study program deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('study-programs.index')
                ->with('error', 'Failed to delete study program: ' . $th->getMessage());
        }
    }
}
