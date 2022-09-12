<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


class Participant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'participants';
    public $timestamps = true;


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $fillable = [
        'name',
        'email',
        'designation',
        'sex',
        'phone',
        'photo_consent',
        'category',
        'institution_id',
        'directorate_id',
    ];


    public function institution(): HasOne
    {
        return $this->hasOne('App\Models\Institution','id','institution_id');
    }
}
