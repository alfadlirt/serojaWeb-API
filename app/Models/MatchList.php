<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchList extends Model
{
    use HasFactory;

    protected $table = 'match_list';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'last_modified';
}
