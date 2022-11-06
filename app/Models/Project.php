<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $data = now()->toDateTimeString().$model->name;
            $model->user_id = auth()->user()->id;
            $model->key = hash('sha256', $data);
        });
    }

    public function exception()
    {
        return $this->hasMany(BugException::class);
    }

    public function readException()
    {
        return $this->exception()->where('status', 'unread');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
