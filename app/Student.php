<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name'];

    public function teacher()
    {
        return $this->belongsTo('App\User');
    }
}
