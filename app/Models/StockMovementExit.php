<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovementExit extends Model
{
    use HasFactory;

    protected $table = 'stock_movements_exits';

    protected $fillable = [
        'product_id',
        'previous_quantity',
        'quantity',
        'date',
        'control_number',
        'destination',
    ];

    protected $dates = ['date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
