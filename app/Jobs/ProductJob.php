<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public $header;
    public $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->data as $product) {
            $sku = $product[0];
            $productName = $product[1];
            if (!empty($productName)) {
                array_shift($product);
                unset($product[2]);
                $productInput = array_combine(array_keys($this->header), $product);
                $productModel = Product::create($productInput);
                $productModel->variants()->createMany([['sku' => $sku]]);
            } else {
                if (!empty($productModel)) {
                    $productModel->variants()->createMany([['sku' => $sku]]);
                }
            }
        }
    }
}
