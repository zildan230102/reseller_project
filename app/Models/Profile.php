<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 
        'phone_number', 
        'email', 
        'instagram', 
        'facebook', 
        'linkedin', 
        'twitter', 
        'profile_picture'
    ];
}
