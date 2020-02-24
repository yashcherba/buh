<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $dates = [
        'date', 'created_at', 'updated_at'
    ];

    protected $fillable = [
        'userid', 'date', 'categoryid', 'sum'
    ];
}
