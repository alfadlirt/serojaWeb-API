<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'team';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'last_modified';

    protected $fillable = array(
        'id',
        'event_id',
        'team_name',
        'instance'
    );
}
