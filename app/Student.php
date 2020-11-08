<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Student extends Model
{
    use SoftDeletes, Sortable;

    protected $fillable = ['student_number', 'first_name', 'last_name'];

    public $sortable = ['student_number', 'first_name', 'last_name'];

    public function teacher()
    {
        return $this->belongsTo('App\User');
    }
}
