<?php

namespace CodeEduStore\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'date_launch',
        'price',
        'user_id',
        'invoice_id'
    ];

    public function orderable()
    {
        return $this->morphTo();
    }
}
