<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Staff extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'staffs';
    protected $fillable = [
        'id',
        'name',
        'team_id',
        'role',
    ];
}
