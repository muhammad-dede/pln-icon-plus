<?php

use App\Models\JenisKonsumsi;
use App\Models\RuangMeeting;
use App\Models\WaktuMeeting;
use Spatie\Permission\Models\Role;

function role()
{
    $data = Role::all();
    return $data;
}

function waktuMeeting()
{
    $data = WaktuMeeting::all();
    return $data;
}

function ruangMeeting()
{
    $data = RuangMeeting::all();
    return $data;
}

function jenisKonsumsi()
{
    $data = JenisKonsumsi::all();
    return $data;
}
