<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAchievementRequest;
use App\Http\Requests\UpdateAchievementRequest;
use Illuminate\Http\Request;

class AchievementController extends Controller
{

    public function index()
    {
        $achievements = Achievement::with('students')->orderByDesc('created_at')->paginate(10);

        return view('admin-page.dashboard.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin-page.prestasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim_mahasiswa'   => 'nullable|string|max:20',
            'nama_mahasiswa'  => 'required|string|max:100',
            'program_studi'   => 'required|string|max:50',
            'judul_kegiatan'  => 'required|string|max:200',
            'jenis_prestasi'  => 'required|in:Akademik,Non-Akademik',
            'tingkat'         => 'required|in:Lokal,Nasional,Internasional',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi'       => 'nullable|string',
            'file_bukti'      => 'nullable|file|mimes:pdf|max:2048',
            'file_foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nim_mahasiswa',
            'nama_mahasiswa',
            'program_studi',
            'judul_kegiatan',
            'jenis_prestasi',
            'tingkat',
            'tanggal_kegiatan',
            'deskripsi',
        ]);

        if ($request->hasFile('file_bukti')) {
            $data['file_bukti'] = $request->file('file_bukti')->store('bukti', 'public');
        }

        if ($request->hasFile('file_foto')) {
            $data['file_foto'] = $request->file('file_foto')->store('foto', 'public');
        }

        $achievement = Achievement::create($data);

        return response()->json([
            'message'  => 'Prestasi berhasil dibuat',
            'data'     => $achievement,
        ], 201);
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
        // return view('admin-page.prestasi.edit', compact('achievement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAchievementRequest $request, Achievement $achievement)
    {
        $request->validate([
            'nim_mahasiswa'   => 'nullable|string|max:20',
            'nama_mahasiswa'  => 'required|string|max:100',
            'program_studi'   => 'required|string|max:50',
            'judul_kegiatan'  => 'required|string|max:200',
            'jenis_prestasi'  => 'required|in:Akademik,Non-Akademik',
            'tingkat'         => 'required|in:Lokal,Nasional,Internasional',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi'       => 'nullable|string',
            'file_bukti'      => 'nullable|file|mimes:pdf|max:2048',
            'file_foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nim_mahasiswa',
            'nama_mahasiswa',
            'program_studi',
            'judul_kegiatan',
            'jenis_prestasi',
            'tingkat',
            'tanggal_kegiatan',
            'deskripsi',
        ]);

        if ($request->hasFile('file_bukti')) {
            $data['file_bukti'] = $request->file('file_bukti')->store('bukti', 'public');
        }

        if ($request->hasFile('file_foto')) {
            $data['file_foto'] = $request->file('file_foto')->store('foto', 'public');
        }

        $achievement->update($data);

        return response()->json([
            'message'  => 'Prestasi berhasil diperbarui',
            'data'     => $achievement,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement)
    {
        $achievement->delete();

        return response()->json([
            'message' => 'Prestasi berhasil dihapus',
        ]);
    }
}
