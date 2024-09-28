<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $hidden = ["banned","updated_at"];
    protected $fillable = ["name","gender","birth_date"];
}
