<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
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

    public function directorate(){
        return $this->hasOne('App\Models\Directorate', 'id','directorate_id');
    }

    /*public function directorate(){
        return $this->hasOne('App\Models\Directorate', 'id','directorate_id');
    }*/
}
