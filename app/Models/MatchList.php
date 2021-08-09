<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchList extends Model
{
    use HasFactory;

    protected $table = 'match_bracket';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'last_modified';

    protected $fillable = array(
        'id',
        'event_id',
        'team_a',
        'team_b',
        'skor_a',
        'skor_b',
        'winner',
        'next_branch',
        'is_end',
        'is_wo',
        'is_addition',
        'stage_number',
        'index_number',
        'stage_type',
        'status'
    );
}
