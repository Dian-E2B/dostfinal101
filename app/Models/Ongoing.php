<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongoing extends Model
{
    use HasFactory;
     // Specify the table name
     protected $table = 'ongoing';

     // Specify the primary key column
     protected $primaryKey = 'NUMBER';

     // Specify that the primary key is not an auto-incrementing integer
     public $incrementing = false;

}
