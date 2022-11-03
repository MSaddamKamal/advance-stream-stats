<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    const ACTIVE_SUBSCRIPTION = 'ACTIVE';
    const CANCELLED_SUBSCRIPTION = 'CANCELLED';

    protected $fillable= [
        'user_id','payment_method','braintree_subscription_id','braintree_plan_id','ends_at','cost','status'
    ];

    public function plan(){
        return $this->belongsTo(Plan::class,'braintree_plan_id','braintree_plan_id');
    }
}
