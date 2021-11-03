<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'principal',
        'engine',
        'entry',
        'logo',
        'bg_image',
        'created_by',
        'updated_by',
    ];

    public function constructor(){
        return $this->belongsTo(Constructor::class, 'engine', 'id');
    }

    public function crew(){
        return $this->hasMany(Rider::class, 'team', 'id');
    }

    public function creator(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updater(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
