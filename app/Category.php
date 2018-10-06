<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    protected $fillable = ['title', 'parent_id', 'thumbnail', 'slug', 'description'];
    public function posts(){
        return $this->hasMany('App\Post');
    }
    public function setSlugAttribute($value){
        $temp = str_slug($this->description, '-');
        if(!Category::all()->where('slug',$temp)->isEmpty()){
            $i = 1;
            $newslug = $temp . '-' . $i;
            while(!Category::all()->where('slug',$newurl1)->isEmpty()){
                $i++;
                $newslug = $temp . '-' . $i;
            }
            $temp =  $newslug;
        }
        $this->attributes['slug'] = $temp;
    }

}
