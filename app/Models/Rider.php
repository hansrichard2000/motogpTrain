<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;
    protected $fillable = ([
        'name',
        'number',
        'team',
        'engine',
        'nation',
        'date',
        'place',
        'height',
        'weight',
        'podiums',
        'wins',
        'title',
        'description',
        'picture',
        'flag',
        'created_by',
        'updated_by',
    ]);

    public function creatorEngine(){
        return $this->belongsTo(Constructor::class, 'engine', 'id');
    }

    public function group(){
        return $this->belongsTo(Team::class, 'team', 'id');
    }

    public function creator(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updater(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
