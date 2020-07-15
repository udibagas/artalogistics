<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['filename', 'path', 'user_id', 'title', 'description', 'tags'];
}
