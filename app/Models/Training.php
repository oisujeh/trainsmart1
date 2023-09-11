<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Training extends Model
{
    use HasFactory;

    protected $table = 'trainings';
    public $timestamps = true;

    public $fillable = [
        'directorate_id',
        'training_title_id',
        'start_date',
        'end_date',
        'location',
        'method',
        'venue',

    ];

    public function directorate(): HasOne
    {
        return $this->hasOne('App\Models\Directorate', 'id','directorate_id');
    }

    public function title(): HasOne
    {
        return $this->hasOne('App\Models\TrainingTitle', 'id','training_title_id');
    }

    public function directorate1(): BelongsTo
    {
        return $this->belongsTo(Directorate::class, 'directorate_id');
    }

   /* public function section()
    {
        return $this->belongsTo(Section::class);
    }*/
}
