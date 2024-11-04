<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\StoreRequest;
use Exception;
use App\Models\Product;
use Illuminate\Http\Request;

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
}
