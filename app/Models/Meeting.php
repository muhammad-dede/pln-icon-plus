<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'meeting';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function ruangMeeting()
    {
        return $this->belongsTo(RuangMeeting::class, 'id_ruang_meeting', 'id');
    }

    public function waktuMeeting()
    {
        return $this->belongsTo(WaktuMeeting::class, 'id_waktu_meeting', 'id');
    }

    public function jenisKonsumsi()
    {
        return $this->belongsTo(JenisKonsumsi::class, 'id_jenis_konsumsi', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
