<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;
    protected $fillable = ["tittle", "slug"];

    protected  $appends=["thumb"];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'tittle'
            ]
        ];
    }

    public function image()
    {
        return $this->morphOne("App\Image","imageable");

    }

    public function getThumbAttribute()
    {
        $filePath=$this->image["name"];
        $deletePath = substr($filePath, 8);
        $image = asset("uploads/thumb_" . $deletePath);
        return '<img src="' . $image . '"class="img-thumbnail img-fluid"  />';
    }
}
