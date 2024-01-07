<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;
    protected $fillable = [
        "nis",
        "name",
        "rombel_id",
        "rayon_id",
    ];

    public function rombels()
    {
        return $this->belongsTo(rombels::class, 'rombel_id', 'id');
    }

    public function rayons()
    {
        return $this->belongsTo(rayons::class, 'rayon_id', 'id');
    }
    public function lates()
    {
        return $this->hasMany(lates::class, 'student_id', 'id');
    }
}


// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use App\Models\rombels;
// use App\Models\rayons;
// use App\Models\lates;

// class students extends Model
// {
//     use HasFactory;
//     protected $fillable = [
//         'id',
//         'nis',
//         'name',
//         'rombel_id',
//         'rayon_id',
//     ];

//     public function lates() {
//         return $this->hasMany(students::class);
//     }

//     public function rombel()
//     {
//         return $this->belongsTo(rombels::class, 'rombel_id');
//     }

//     public function rayon()
//     {
//         return $this->belongsTo(rayons::class, 'rayon_id');
//     }


//     public function student()
//     {
//         return $this->hasMany(lates::class);
//     }
// }
