<?php

namespace App\Http\Controllers;

use App\Models\JenisKonsumsi;
use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:index-meeting')->only('index');
        $this->middleware('permission:create-meeting')->only(['create', 'store']);
        $this->middleware('permission:edit-meeting')->only(['edit', 'update']);
        $this->middleware('permission:destroy-meeting')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->roles->pluck('name')[0] == 'Super Admin') {
            $data = Meeting::orderBy('created_at', 'desc')->get();
        } else {
            $data = Meeting::where('id_user', auth()->id())->orderBy('created_at', 'desc')->get();
        }

        return view('meeting.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('meeting.create');
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
            'unit' => 'required|string|max:255',
            'id_ruang_meeting' => 'required|string',
            'tanggal_meeting' => 'date_format:Y-m-d',
            'id_waktu_meeting' => 'required|string',
            'jumlah_peserta' => 'required|numeric',
        ], [], [
            'unit' => 'Unit',
            'id_ruang_meeting' => 'Ruang Meeting',
            'tanggal_meeting' => 'Tanggal Meeting',
            'id_waktu_meeting' => 'Waktu meeting',
            'jumlah_peserta' => 'Jumlah Peserta',
        ]);

        $jenis_konsumsi = JenisKonsumsi::where('id_waktu_meeting', $request->id_waktu_meeting)->first();
        Meeting::create([
            'unit' => ucfirst($request->unit),
            'id_ruang_meeting' => $request->id_ruang_meeting,
            'tanggal_meeting' => $request->tanggal_meeting,
            'id_waktu_meeting' => $request->id_waktu_meeting,
            'jumlah_peserta' => $request->jumlah_peserta,
            'id_jenis_konsumsi' => $jenis_konsumsi->id,
            'id_user' => auth()->id(),
        ]);

        return redirect()->route('meeting.index')->with('success', 'Meeting berhasil ditambahkan.');
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
    public function edit(Meeting $meeting)
    {
        return view('meeting.edit', compact('meeting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {
        $request->validate([
            'unit' => 'required|string|max:255',
            'id_ruang_meeting' => 'required|string',
            'tanggal_meeting' => 'date_format:Y-m-d',
            'id_waktu_meeting' => 'required|string',
            'jumlah_peserta' => 'required|numeric',
        ], [], [
            'unit' => 'Unit',
            'id_ruang_meeting' => 'Ruang Meeting',
            'tanggal_meeting' => 'Tanggal Meeting',
            'id_waktu_meeting' => 'Waktu meeting',
            'jumlah_peserta' => 'Jumlah Peserta',
        ]);

        $jenis_konsumsi = JenisKonsumsi::where('id_waktu_meeting', $request->id_waktu_meeting)->first();

        $meeting->update([
            'unit' => ucfirst($request->unit),
            'id_ruang_meeting' => $request->id_ruang_meeting,
            'tanggal_meeting' => $request->tanggal_meeting,
            'id_waktu_meeting' => $request->id_waktu_meeting,
            'jumlah_peserta' => $request->jumlah_peserta,
            'id_jenis_konsumsi' => $jenis_konsumsi->id,
            'id_user' => auth()->id(),
        ]);

        return redirect()->route('meeting.index')->with('success', 'Meeting berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('meeting.index')->with('success', 'Meeting berhasil dihapus.');
    }

    public function status(Request $request, Meeting $meeting)
    {
        $meeting->update([
            'status' => $meeting->status == 1 ? 0 : 1,
        ]);

        return redirect()->route('meeting.index')->with('success', 'Meeting berhasil disimpan.');
    }
}
