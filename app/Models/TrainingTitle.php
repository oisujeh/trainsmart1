<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static find($id)
 * @method static whereHas(string $string, \Closure $param)
 */
class TrainingTitle extends Model
{
    use HasFactory;

    protected $table = 'training_titles';
    public $timestamps = true;
    protected $fillable = ['directorate_id','title'];


    public function setAttribute($key, $value)
    {
        //if(in_array($key, ['name']))
        if($key == 'title'){
            $this->attributes[$key] = strtolower($value);
            return $this;
        }
        return parent::setAttribute($key, $value);
    }

    public function getNameAttribute($value): string
    {
        return ucwords($value);
    }

    public function directorate(): HasOne
    {
        return $this->hasOne('App\Models\Directorate', 'id','directorate_id');
    }

}
