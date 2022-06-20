<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Thread extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'tag_id', 'attachment'];
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        parent::creating(
            function ($thread) {
                $thread->user_id = Auth::id();
            }
        );
    }
    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function Tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }
    public function Reply()
    {
        return $this->hasMany('App\Models\Reply');
    }
}
