<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class BlogComment extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function post(){
    	return $this->belongsTo(BlogPost::class,'post_id','id');
    }
    public function user(){
    	return $this->belongsTo(User::class,'user_id','id');
    }
}
