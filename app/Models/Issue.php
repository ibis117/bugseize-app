<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function exceptions()
    {
        return $this->hasMany(BugException::class);
    }
}
