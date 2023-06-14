<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestData extends Model
{
    use HasFactory;
    protected $guarded = ['*'];
    protected $fillable =['name','class','level','parent_number']; //fillable value in the database by user
}
