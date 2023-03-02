<?php

namespace App\Http\Controllers;
use App\Http\Services\Product\ProductService1;
use Illuminate\Http\Request;

class ProductController1 extends Controller
{
    protected $productService;

    public function __construct(ProductService1 $productService)
    {
        $this->productService = $productService;
    }

    public function index($id = '', $slug = '')
    {
        $product = $this->productService->show($id);
        $productsMore = $this->productService->more($id);

        return view('products.content', [
            'title' => $product->name,
            'product' => $product,
            'products' => $productsMore
        ]);
    }
}
