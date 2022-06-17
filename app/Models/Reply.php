<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'thread_id'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        parent::creating(
            function ($reply) {
                $reply->user_id = Auth::id();
            }
        );
    }

    public function Thread()
    {
        return $this->belongsTo('App\Model\Thread');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
}
