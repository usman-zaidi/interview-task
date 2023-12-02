<?php

namespace App\Models;

use App\Events\SkuExists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class ProductVariant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function boot()
    {
        try {
            parent::boot();

            static::creating(function ($model) {
                $existingSku = self::where('sku', $model->sku)->first();

                if ($existingSku) {
                    // Trigger the email event if SKU already exists, please un-comment these lines of code. to send email. At the moment i have commented this code.
//                    event(new SkuExists($model->sku));
                }
            });

        } catch (Exception $exception) {
            Log::error($exception);//fast fast login. :-p
        }
    }
}
