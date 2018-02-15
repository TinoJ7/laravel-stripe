<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['stripe_payment_id','user_id','amount', 'status', 'failure_reason'];
}
