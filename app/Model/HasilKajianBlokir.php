<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HasilKajianBlokir extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [''];
}
