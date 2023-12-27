<?php

namespace App\Http\Controllers;

use App\Models\WaktuMeeting;
use Illuminate\Http\Request;

class WaktuMeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:index-waktu-meeting')->only('index');
        $this->middleware('permission:create-waktu-meeting')->only(['create', 'store']);
        $this->middleware('permission:edit-waktu-meeting')->only(['edit', 'update']);
        $this->middleware('permission:destroy-waktu-meeting')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = WaktuMeeting::orderBy('nama', 'asc')->get();
        return view('waktu-meeting.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('waktu-meeting.create');
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
        ], [], [
            'nama' => 'Nama',
        ]);

        WaktuMeeting::create([
            'nama' => ucfirst($request->nama),
        ]);

        return redirect()->route('waktu-meeting.index')->with('success', 'Waktu Meeting berhasil ditambahkan.');
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
    public function edit(WaktuMeeting $waktu_meeting)
    {
        return view('waktu-meeting.edit', compact('waktu_meeting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WaktuMeeting $waktu_meeting)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ], [], [
            'nama' => 'Nama',
        ]);

        $waktu_meeting->update([
            'nama' => ucfirst($request->nama),
        ]);

        return redirect()->route('waktu-meeting.index')->with('success', 'Waktu Meeting berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaktuMeeting $waktu_meeting)
    {
        $waktu_meeting->delete();
        return redirect()->route('waktu-meeting.index')->with('success', 'Waktu Meeting berhasil dihapus.');
    }
}
