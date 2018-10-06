<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts'; // bảng posts trong database
    protected $fillable = [
    		'title', 
    		'thumbnail', 
    		'description', 
    		'content',
    		'slug',
    		'user_id',
    		'category_id',
    		'view_count'
    	]; // một mảng tên các cột trong bảng posts ở database
    	// không cần thêm các cột như id, created_at, updated_at, deleted_at vào
    	// vì nó là những cột mặc định
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function tags(){
        return $this->belongsToMany('App\Tag', 'post_tags','post_id', 'tag_id');
    }
    // public function setSlugAttribute($value){
    //     $temp = str_slug($this->title, '-');
    //     if(!Post::all()->where('slug',$temp)->isEmpty()){
    //         $i = 1;
    //         $newslug = $temp . '-' . $i;
    //         while(!Post::all()->where('slug',$newurl)->isEmpty()){
    //             $i++;
    //             $newslug = $temp . '-' . $i;
    //         }
    //         $temp =  $newslug;
    //     }
    //     $this->attributes['slug'] = $temp;
    // }
}
