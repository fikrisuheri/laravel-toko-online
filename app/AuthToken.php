<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthToken extends Model
{
    public $table = 'auth_token';

    protected $fillable = ['token', 'user_id'];
    
    /**
     * create relationship between AuthToken and User
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
