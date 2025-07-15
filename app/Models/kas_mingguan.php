<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kas_mingguan extends Model
{
    public $fillable = ['user_id', 'status', 'minggu_ke', 'bulan', 'jumlah', 'tanggal_bayar'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
