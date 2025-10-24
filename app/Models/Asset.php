<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Asset extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'code', 'category_id', 'unit_id', 'vendor_id',
    'status', 'purchase_date', 'purchase_price', 'warranty_expiry'];

    /**
     * 
     * Event model booted
     * Menghasilkan kode aset otomatis dengan format: INV/XXXX/MM/YYYY.
     */
    protected static function booted()
    {
        static::creating(function ($asset) {
            if (empty($asset->code)) {
                $month = now()->format('m');
                $year = now()->format('Y');

                $lastCode = self::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->latest('id')
                    ->value('code');

                if($lastCode) {
                    $lastNumber = (int) explode('/', $lastCode)[1];
                    $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $newNumber = '0001';
                }

                $asset->code = "INV/{$newNumber}/{$month}/{$year}";
            }
        });
    }
    /**
     * 
     * Relasi ke katagori aset
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke unit atau lokasi penyimpanan aset
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Relasi ke vendor atau pemasok aset
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
