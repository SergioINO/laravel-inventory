<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'document_type', 'document_id','giro'
    ];

    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
}
