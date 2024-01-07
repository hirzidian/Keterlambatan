<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\rayons;


class users extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public function rayon()
    {
        return $this->hasOne(rayons::class, 'user_id');
    }
}