<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings'; // Specify the table name

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'service',
        'date',
        'time',
        'status',
    ]; // Specify which attributes are mass assignable
}
