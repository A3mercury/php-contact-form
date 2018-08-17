<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $table = 'contact_requests';

    protected $fillable = [
        'full_name',
        'email',
        'message',
        'phone',
    ];
}
