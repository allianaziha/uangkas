<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksikas extends Model
{
    public $fillable = ['user_id', 'jenis', 'jumlah', 'keterangan', 'tanggal'];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
