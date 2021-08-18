<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'email', 'country', 'phone', 'paymentinfo'
    ];

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function receipts()
    {
        return $this->hasMany('App\Receipt');
    }
}
