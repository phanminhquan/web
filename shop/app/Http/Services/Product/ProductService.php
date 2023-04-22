<?php


namespace App\Http\Services\Product;


use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductService
{
    const LIMIT = 16;
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function get()
    {
        return Product::with('menu')
            ->orderByDesc('id')->paginate(15);
    }
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }
    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function isValidPrice($request)
    {
        if($request -> input('price') != 0 && $request -> input('price_sale') != 0
        && $request-> input('price_sale') >= $request-> input('price'))
        {
            Session::flash('error','Giá sản phẩm phải nhỏ hơn giá gốc');
            return false;
        }
        if($request -> input('price_sale') != 0 && (int)$request -> input('price') == 0)
        {
            Session::flash('error','Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }

    public function create($request)
    {
        $isValidPrice =$this->isValidPrice($request);
        if($isValidPrice === false)
        {
            return false;
        }
        try {
            Product::create([
                'name' => (string)$request->input('name'),
                'description' => (string)$request->input('description'),
                'content'=> (string)$request->input('content'),
                'menu_id' => (int)$request->input('menu_id'),
                'price' => (string)$request->input('price'),
                'price_sale' => (string)$request->input('price_sale'),
                'active' => (string)$request->input('active'),
                'thumb' => (string)$request->input('thumb'),
            ]);

            Session::flash('success', 'Tạo sản phẩm Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }
    public function delete($request)
    {
        $product = Product::where('id', $request->input('id'))->first();
        if ($product) {
            $product->delete();
            return true;
        }

        return false;
    }

}
