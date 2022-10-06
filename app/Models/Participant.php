<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    /*public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }*/

    public function setAttribute($key, $value)
    {
        if(in_array($key, ['name', 'email'])){
            $this->attributes[$key] = strtolower($value);
            return $this;
        }
        return parent::setAttribute($key, $value);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value)
        );
    }


    public function institution(): HasOne
    {
        return $this->hasOne('App\Models\Institution','id','institution_id');
    }

    public function directorate(): HasOne
    {
        return $this->hasOne('App\Models\Directorate','id','directorate_id');
    }
}
