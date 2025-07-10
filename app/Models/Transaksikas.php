<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksikas extends Model
{
    public $fillable = [ 'jenis', 'jumlah', 'keterangan', 'tanggal'];

}
