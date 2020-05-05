<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderstatus extends Model
{
    //
    protected $table = 'status_order';
    protected $fillable = ['name'];
}
