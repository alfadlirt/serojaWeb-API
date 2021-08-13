<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'last_modified';

    protected $fillable = array(
        'id',
        'user_id',
        'event_name',
        'number_of_team',
        'elimination_type',
        'status',
        'is_saved'
    );

    public function brackets()
    {
        return $this->hasMany(\App\Models\MatchList::class);
    }
}
