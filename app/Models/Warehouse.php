<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code_no',
        'status',
        'selling_price',
        'last_price',
        'price_type',
        'commission',
        'owner_name',
        'owner_contact',
        'contact_person',
        'cp_number',
        'email',
        'fb_link',
        'referrer_agent',
        'exact_address',
        'vicinity',
        'city_municipality',
        'lot_area',
        'floor_area',
        'description',
        'condition',
        'payment_mode',
        'reservation_fee',
        'downpayment',
        'dp_terms',
        'inclusions',
        'buyer_expense',
        'move_in_fee',
        'misc_fees',
        'remarks',
        'ext_photos',
        'int_photos',
        'v_videos',
        'h_videos',
    ];

    /**
     * Optional: Casting
     * This ensures numbers are treated as decimals/floats in PHP.
     */
    protected $casts = [
        'selling_price' => 'decimal:2',
        'last_price' => 'decimal:2',
        'lot_area' => 'double',
        'floor_area' => 'double',
        'reservation_fee' => 'decimal:2',
        'downpayment' => 'decimal:2',
    ];
}