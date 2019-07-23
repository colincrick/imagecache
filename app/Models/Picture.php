<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $primaryKey = 'picture_id';

    protected $guarded = ['picture_id'];
}
