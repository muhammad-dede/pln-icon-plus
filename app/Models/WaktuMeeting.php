<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuMeeting extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'waktu_meeting';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = [];

    public function jenisKonsumsi()
    {
        return $this->hasOne(JenisKonsumsi::class, 'id_waktu_meeting', 'id');
    }
}
