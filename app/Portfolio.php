<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Portfolio extends Model
{
    protected $fillable = ['title', 'description', 'tags', 'user_id'];

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
