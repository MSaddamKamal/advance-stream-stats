<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    const FREE = 'FREE';
    const PAID = 'PAID';
    use HasFactory;
}
