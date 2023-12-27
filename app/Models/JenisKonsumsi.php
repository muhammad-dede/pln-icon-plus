<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKonsumsi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'jenis_konsumsi';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = [];

    public function waktuMeeting()
    {
        return $this->belongsTo(WaktuMeeting::class, 'id_waktu_meeting', 'id');
    }
}
