<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovementEntry extends Model
{
    use HasFactory;

    protected $table = 'stock_movements_entries';

    protected $fillable = [
        'product_id',
        'previous_quantity',
        'quantity',
        'date',
        'invoice_number',
        'supplier',
    ];

    protected $dates = ['date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
