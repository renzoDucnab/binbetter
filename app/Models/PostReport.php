<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    use HasFactory;

    protected $table = 'post_reports';

    protected $fillable = [
        'resident_id',
        'type',
        'address',
        'photo',
        'description'
    ];
}
