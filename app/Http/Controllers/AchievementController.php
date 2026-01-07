<?php

namespace App\Http\Controllers;

use App\Exports\AchievementTemplateExport;
use App\Exports\ReportAchievementExport;
use App\Models\Achievement;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAchievementRequest;
use App\Http\Requests\UpdateAchievementRequest;
use App\Imports\AchievementImport;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AchievementController extends Controller
{
    public function index(Request $request)
    {
        $achievements = Achievement::with('students')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('students', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('nim', 'like', "%{$search}%");
                    });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderByDesc('date')
            ->paginate(5)
            ->withQueryString();

        $totalAchievements = Achievement::count();
        $totalAchievementyear = Achievement::whereYear('date', now()->year)->count();
        $totalPublished = Achievement::where('status', 'Publish')->count();
        $totalVerified = Achievement::where('status', 'Verified')->count();
        return view('admin-page.dashboard.index', compact('achievements', 'totalAchievements', 'totalAchievementyear', 'totalPublished', 'totalVerified'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        return view('admin-page.prestasi.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAchievementRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['title', 'category', 'grade', 'date', 'description', 'status', 'student_id']);

            if ($request->hasFile('proof')) {
                $data['proof'] = $request->file('proof')->store('achievements/proofs', 'public');
            }

            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('achievements/photos', 'public');
            }

            Achievement::create($data);

            DB::commit();
            return redirect()->route('admin.dashboard')->with('success', 'Achievement created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('achievements.create')
                ->with('error', 'Failed to create achievement: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Achievement $achievement)
    {
        // return response()->json($achievement);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Achievement $achievement)
    {
        $students = Student::orderBy('name')->get();
        $achievement->load('students');
        return view('admin-page.prestasi.edit', compact('achievement', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAchievementRequest $request, Achievement $achievement)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['title', 'category', 'grade', 'date', 'description', 'status', 'student_id']);

            if ($request->hasFile('proof')) {
                if ($achievement->proof) {
                    Storage::disk('public')->delete($achievement->proof);
                }
                $data['proof'] = $request->file('proof')->store('achievements/proofs', 'public');
            }

            if ($request->hasFile('photo')) {
                if ($achievement->photo) {
                    Storage::disk('public')->delete($achievement->photo);
                }
                $data['photo'] = $request->file('photo')->store('achievements/photos', 'public');
            }

            $achievement->update($data);
            DB::commit();
            return redirect()->route('admin.dashboard')->with('success', 'Achievement updated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('achievements.edit', $achievement->id)
                ->with('error', 'Failed to edit achievement: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement)
    {
        try {
            if ($achievement->proof) {
                Storage::disk('public')->delete($achievement->proof);
            }

            if ($achievement->photo) {
                Storage::disk('public')->delete($achievement->photo);
            }

            $achievement->delete();

            return redirect()->route('admin.dashboard')->with('success', 'Achievement deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('achievements.edit', $achievement->id)
                ->with('error', 'Failed to delete achievement: ' . $th->getMessage());
        }
    }

    public function indexUpload()
    {
        return view('admin-page.prestasi.upload');
    }

    public function downloadTemplate()
    {
        return Excel::download(
            new AchievementTemplateExport,
            'template_prestasi.xlsx'
        );
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $import = new AchievementImport();
        Excel::import($import, $request->file('file'));

        //cek eror pada baris import pada bagian headernya untuk kesesuaian data
        if ($import->failures()->isNotEmpty()) {
            $messages = [];
            foreach ($import->failures() as $failure) {
                foreach ($failure->errors() as $error) {
                    $messages["row_{$failure->row()}_{$failure->attribute()}"] =
                        "Baris {$failure->row()} ({$failure->attribute()}): {$error}";
                }
            }

            return back()->withErrors($messages)->withInput();
        }

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Data prestasi berhasil diimport');
    }

    public function userHompage()
    {
        $achievements = Achievement::with('students')
            ->where('status', 'Publish')
            ->orderByDesc('date')
            ->limit('3')
            ->get();

        return view('homepage', compact('achievements'));
    }

    public function exportReport()
    {
        $endDate   = Carbon::now();
        $startDate = Carbon::now()->subMonths(3);

        return Excel::download(
            new ReportAchievementExport,
            "report_prestasi_{$startDate->format('M-Y')}_sd_{$endDate->format('M-Y')}.xlsx"
        );
    }
}
