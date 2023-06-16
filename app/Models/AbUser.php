<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbUser extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'ab_user';

    protected $fillable =[
        'ab_name',
        'ab_password',
        'ab_mail',
    ];

}
