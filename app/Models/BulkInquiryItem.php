<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BulkInquiryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulk_inquiry_id',
        'product_id',
        'product_name',
        'quantity',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
        ];
    }

    public function bulkInquiry(): BelongsTo
    {
        return $this->belongsTo(BulkInquiry::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
