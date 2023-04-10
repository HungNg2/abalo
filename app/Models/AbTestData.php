<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AbTestData extends Model
{
    protected $table = 'ab_testdata';
    protected $primary_key = 'id';
    protected $fillable = [
        'test_testname'
    ];
}
