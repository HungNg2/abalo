<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbUser extends Model
{
    use HasFactory;

    protected $table = 'ab_user';
    protected $primaryKey = 'id';

    protected $fillable = [
        'ab_name',
        'ab_password',
        'ab_mail'
    ];

    public $timestamps = FALSE;
}
