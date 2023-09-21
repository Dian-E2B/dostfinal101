<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sei extends Model
{
    use HasFactory;


    protected $fillable = [
        'spasno',
        'app_id',
        'strand',
        'gender_id',
        'municipality',
        'province',
        'program_id',
        'houseno',
        'street',
        'barangay',
        'zipcode',
        'district',
        'region',
        'hsname',
        'lacking',
        'remarks',
    ];


    public $timestamps = false;


    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    // public function province()
    // {
    //     return $this->belongsTo(Provinces::class);
    // }

    // public function municipality()
    // {
    //     return $this->belongsTo(Municipalities::class, 'municipal_id');
    // }

    public function program()
    {
        return $this->belongsTo(Programs::class);
    }
    public function scholars()
    {
        return $this->hasMany(Scholars::class, 'spasno', 'spasno');
    }
}
