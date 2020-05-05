<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    //
    protected $table = 'rekening';
    protected $fillable = ['bank_name','atas_nama','no_rekening'];
}
