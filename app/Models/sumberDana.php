<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sumberDana extends Model
{
    use HasFactory;
    public $table = "sumberDana";
    protected $fillable = ['sumber_dana','program','keterangan'];
}
