<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OldCandidate extends Model
{
    protected $table = 'old_candidates';

    protected $fillable = [
        'candidate_id',
        'name',
    ];
}
