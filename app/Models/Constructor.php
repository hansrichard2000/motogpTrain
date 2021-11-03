<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constructor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'nation',
        'engine',
        'logo',
    ];

    public function events(){
        return $this->hasMany(Constructor::class, 'engine', 'id');
    }

}
