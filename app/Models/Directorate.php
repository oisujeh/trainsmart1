<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directorate extends Model
{
    use HasFactory;

    protected $table = 'directorates';
    public $timestamps = true;
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
    ];

    public function setAttribute($key, $value)
    {
        //if(in_array($key, ['name']))
        if($key == 'name'){
            $this->attributes[$key] = strtolower($value);
            return $this;
        }
        return parent::setAttribute($key, $value);
    }

    public function getNameAttribute($value): string
    {
        return ucwords($value);
    }
}
