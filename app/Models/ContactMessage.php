<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'surName',
        'email',
        'phone',
        'streetAddress',
        'orderNumber',
        'postcode',
        'country',
        'city',
        'message'
    ];
}
