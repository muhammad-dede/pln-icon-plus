<?php

namespace App\Http\Controllers;

use App\Models\JenisKonsumsi;
use Illuminate\Http\Request;

class JenisKonsumsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:index-jenis-konsumsi')->only('index');
        $this->middleware('permission:create-jenis-konsumsi')->only(['create', 'store']);
        $this->middleware('permission:edit-jenis-konsumsi')->only(['edit', 'update']);
        $this->middleware('permission:destroy-jenis-konsumsi')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JenisKonsumsi::all();
        return view('jenis-konsumsi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis-konsumsi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_waktu_meeting' => 'required|string|max:40',
        ], [], [
            'nama' => 'Nama',
            'id_waktu_meeting' => 'Waktu Meeting',
        ]);

        JenisKonsumsi::create([
            'nama' => ucfirst($request->nama),
            'id_waktu_meeting' => $request->id_waktu_meeting,
        ]);

        return redirect()->route('jenis-konsumsi.index')->with('success', 'Jenis Konsumsi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisKonsumsi $jenis_konsumsi)
    {
        return view('jenis-konsumsi.edit', compact('jenis_konsumsi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisKonsumsi $jenis_konsumsi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_waktu_meeting' => 'required|string|max:40',
        ], [], [
            'nama' => 'Nama',
            'id_waktu_meeting' => 'Waktu Meeting',
        ]);

        $jenis_konsumsi->update([
            'nama' => ucfirst($request->nama),
            'id_waktu_meeting' => $request->id_waktu_meeting,
        ]);

        return redirect()->route('jenis-konsumsi.index')->with('success', 'Jenis Konsumsi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisKonsumsi $jenis_konsumsi)
    {
        $jenis_konsumsi->delete();

        return redirect()->route('jenis-konsumsi.index')->with('success', 'Jenis Konsumsi berhasil dihapus.');
    }
}
