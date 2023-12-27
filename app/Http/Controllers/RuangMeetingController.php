<?php

namespace App\Http\Controllers;

use App\Models\RuangMeeting;
use Illuminate\Http\Request;

class RuangMeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:index-ruang-meeting')->only('index');
        $this->middleware('permission:create-ruang-meeting')->only(['create', 'store']);
        $this->middleware('permission:edit-ruang-meeting')->only(['edit', 'update']);
        $this->middleware('permission:destroy-ruang-meeting')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RuangMeeting::orderBy('nama', 'asc')->get();
        return view('ruang-meeting.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ruang-meeting.create');
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
            'kapasitas' => 'required|numeric',
        ], [], [
            'nama' => 'Nama',
            'kapasitas' => 'Kapasitas',
        ]);

        RuangMeeting::create([
            'nama' => ucfirst($request->nama),
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('ruang-meeting.index')->with('success', 'Ruang Meeting berhasil ditambahkan.');
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
    public function edit(RuangMeeting $ruang_meeting)
    {
        return view('ruang-meeting.edit', compact('ruang_meeting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RuangMeeting $ruang_meeting)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|numeric',
        ], [], [
            'nama' => 'Nama',
            'kapasitas' => 'Kapasitas',
        ]);

        $ruang_meeting->update([
            'nama' => ucfirst($request->nama),
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('ruang-meeting.index')->with('success', 'Ruang Meeting berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RuangMeeting $ruang_meeting)
    {
        $ruang_meeting->delete();

        return redirect()->route('ruang-meeting.index')->with('success', 'Ruang Meeting berhasil dihapus.');
    }
}
