<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    protected $fillable = ['name', 'description'];

    protected $appends = ['image_url'];

    public function attachment()
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->attachment->path);
    }
}
