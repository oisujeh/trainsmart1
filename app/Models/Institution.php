<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static first()
 */
class Institution extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'institutions';
    public $timestamps = true;


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $fillable = [
        'facility_name',
        'state',
        'lga',
        'datim_code',
    ];

    public function participants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Participant::class);
    }

}
