<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbArticleCategory extends Model
{
    use HasFactory;

    protected $table = 'ab_article_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ab_name',
        'ab_description',
        'ab_parent'
    ];

    public $timestamps = FALSE;

}
