<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notulensi;
use App\Models\DaftarHadir;
use App\Models\Agenda;

class NotulensiController extends Controller
{
    public function index()
    {
        $notulensi = Notulensi::with('daftar_hadir', 'agenda')->get();
        return view('notulensi.index', compact('notulensi'));
    }

    public function create()
    {
        return view('notulensi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'tempat' => 'required|string|max:255',
            'pemimpin_musyawarah' => 'required|string|max:255',
            'notulis' => 'required|string|max:255',
            'daftar_hadir' => 'required|array|min:1',
            'daftar_hadir.*.nama' => 'required|string|max:255',
            'daftar_hadir.*.jabatan' => 'required|string|max:255',
            'agenda' => 'required|array|min:1',
            'agenda.*.judul_agenda' => 'required|string|max:255',
            'agenda.*.pembahasan' => 'required|string',
            'agenda.*.keputusan_bersama' => 'required|string',
        ]);

        $notulensi = Notulensi::create([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'pemimpin_musyawarah' => $request->pemimpin_musyawarah,
            'notulis' => $request->notulis,
        ]);

        foreach ($request->daftar_hadir as $hadir) {
            $notulensi->daftarHadir()->create([
                'nama' => $hadir['nama'],
                'jabatan' => $hadir['jabatan'],
                'paraf' => $hadir['paraf'] ?? null,
            ]);
        }

        foreach ($request->agenda as $agenda) {
            $notulensi->agenda()->create([
                'judul_agenda' => $agenda['judul_agenda'],
                'pembahasan' => $agenda['pembahasan'],
                'keputusan_bersama' => $agenda['keputusan_bersama'],
                'keterangan' => $agenda['keterangan'] ?? null,
            ]);
        }

        return redirect()->route('notulensi.index')->with('success', 'Notulensi berhasil disimpan!');
    }
}
