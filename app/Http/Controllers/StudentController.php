<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Achievement;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::get();
        return response()->json(
            [
                'data' => $students,
                'message' => 'Success get data students',
            ],
            200,
        );
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
                'nim' => $request->nim,
                'name' => $request->name,
                'study_program_id' => $request->study_program_id,
                'user_id' => $request->user_id,
            ]);
            DB::commit();
            return response()->json(
                [
                    'data' => $students,
                    'message' => 'Success create student',
                ],
                201,
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(
                [
                    'message' => 'Failed create student',
                    'error' => $th->getMessage(),
                ],
                400,
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load(['studyProgram']);

        $achievementsByYear = Achievement::where('student_id', $student->id)
            ->orderByDesc('date')
            ->get()
            ->groupBy(function ($item) {
                return $item->date->year;
            });

        $achievementCount = Achievement::where('student_id', $student->id)->count();

        $achievementNasional = Achievement::where('student_id', $student->id)->where('grade', 'Nasional')->count();

        $achievementInternasional = Achievement::where('student_id', $student->id)->where('grade', 'Internasional')->count();

        return view('prestasi.show', compact('student', 'achievementsByYear', 'achievementInternasional', 'achievementNasional', 'achievementCount'));
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
                'nim' => $request->nim,
                'name' => $request->name,
                'study_program_id' => $request->study_program_id,
                'user_id' => $request->user_id,
            ]);
            DB::commit();
            return response()->json(
                [
                    'data' => $student,
                    'message' => 'Success update student',
                ],
                201,
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(
                [
                    'message' => 'Failed update student',
                    'error' => $th->getMessage(),
                ],
                400,
            );
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
            return response()->json(
                [
                    'message' => 'Success delete student',
                ],
                201,
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(
                [
                    'message' => 'Failed delete student',
                    'error' => $th->getMessage(),
                ],
                400,
            );
        }
    }

    public function studentAchievements(Request $request)
    {
        // dd($request->all());
        $studyPrograms = StudyProgram::get();
        $perPage = $request->input('per_page', 5);

        $students = Student::with([
            'studyProgram',
            'achievements'
        ])
            ->when($request->filled('grade'), function ($q) use ($request) {
                $q->whereHas('achievements', function ($achievement) use ($request) {
                    $achievement->where('grade', $request->grade);
                });
            })
            ->when($request->filled('year'), function ($q) use ($request) {
                $q->whereHas('achievements', function ($achievement) use ($request) {
                    $achievement->whereYear('date', $request->year);
                });
            })
            ->when($request->filled('study_program'), function ($q) use ($request) {
                $q->whereHas('studyProgram', function ($sp) use ($request) {
                    $sp->where('id', $request->study_program);
                });
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where('name', 'like', "%{$search}%")->orWhere('nim', 'like', "%{$search}%");
            })
            ->paginate($perPage)
            ->withQueryString();

        return view('prestasi.index', compact('students', 'studyPrograms'));
    }
}
