<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Sluggable;
    protected $guarded = [];

    protected $appends = ["thumb"];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function category()
    {
        return $this->belongsTo("App\Category");
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function image()
    {
        return $this->morphOne("App\Image", "imageable");

    }

    public function getThumbAttribute()
    {
        $filePath = $this->image["name"];
        $deletePath = substr($filePath, 8);
        $image = asset("uploads/thumb_" . $deletePath);
        return '<img src="' . $image . '"class="img-thumbnail img-fluid"  />';
    }
}
