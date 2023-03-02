<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService= $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.list',[
            'title'=> 'Danh sách sản phẩm mới nhất',
            'products' => $this->productService->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.add',[
            'title'=>'Thêm sản phẩm mới',
            'menus'=> $this->productService->getParent()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productService->create($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.edit',[
            'title'=> 'Chỉnh sửa sản phẩm: '. $product->name,
            'product' => $product,
            'menus'=> $this->productService->getMenu()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, ProductRequest $request)
    {
        $result = $this->productService->update($request,$product);
        if ($result)
        {
            return redirect('admin/products/list');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy (Request $request)
    {
        $result = $this->productService->delete($request);
        if($result)
        {
            return response()->json([
                'error'=> false,
                'message'=> 'Xóa thành công sản phẩm'
            ]);
        }
        return response()->json([
            'error'=> true

        ]);

    }
}
