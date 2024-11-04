<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(ProductStoreRequest $request)
    {
        try {
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $fileNameToStore = 'photo-' . md5(uniqid()) . '-' . time() . '.' .
                $image->getClientOriginalExtension();
                $image->move(public_path(path: 'uploads'), name: $fileNameToStore);
            } else {
                $fileNameToStore = ' ';
            }
            // dd($fileNameToStore);
            Product::create([
                'product_id' => $request->product_id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,     
                'stock' => $request->stock,
                'image' => $fileNameToStore
            ]);

            sweetalert()->success('Product added successfully');
            return redirect('/products');
        } catch (Exception $e) {
            sweetalert()->error('Product create failed');
            return redirect('/products/create');
        }
    }

    public function destroy($id) {
        try {
            $product = Product::find($id);

            File::delete(public_path('uploads/' . $product->image));
            $product->delete();
    
            sweetalert()->success('Product deleted successfully');
            return redirect('/products');
        } catch (Exception $e) {
            sweetalert()->error('Product delete failed');
            return redirect('/products');
        }
    }
}
