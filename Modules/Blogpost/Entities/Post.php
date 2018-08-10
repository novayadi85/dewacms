<?php

namespace Modules\Blogpost\Entities;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [];

    public function posts()
    {
        return $this->hasMany("Modules\Blogpost\Entities\Postlang", "post_id", "id");
    }

}
