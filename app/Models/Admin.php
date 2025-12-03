<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin'; // your table name

    protected $fillable = ['name','password']; // actual columns

    protected $hidden = ['password', 'remember_token'];
}
