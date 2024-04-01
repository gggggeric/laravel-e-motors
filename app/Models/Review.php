<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'reviewid';

    protected $fillable = [
        'userid',
        'orderid',
        'commentername',
        'comments',
        'reviewphoto',
        'comment_date',
    ];
}
