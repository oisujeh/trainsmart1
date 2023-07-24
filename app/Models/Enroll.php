<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Enroll extends Model
{
    use HasFactory;
    protected $table = 'enroll_trainings';
    protected $fillable = [
        'participant_id',
        'training_id',
    ];



    public function participant(): HasOne
    {
        return $this->hasOne('App\Models\Participant','id','participant_id');
    }

    public function training(): HasOne
    {
        return $this->hasOne('App\Models\Training','id','training_id');
    }
}
