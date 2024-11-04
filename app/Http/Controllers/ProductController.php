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
    public function index(Request $request)
    {
        $sortField = $request->get('sort', 'name');  // Default sorting field is 'name'
        $sortOrder = $request->get('order', 'asc');
        
        $products = Product::orderBy($sortField, $sortOrder)->get();

        return view('index', compact('products', 'sortField', 'sortOrder'));
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

    public function show($id) {
        $product = Product::find($id);
        return view('show', [
            'product' => $product
        ]);
    }
    public function edit($id) {
        $product = Product::find($id);
        return view('edit', [
            'product' => $product
        ]);
    }

    function update(Request $request, $id) {
        try {
            $product = Product::find($id);
            
            if($request->hasFile('image')) {
                File::delete(public_path('uploads/' . $product->image));

                $image = $request->file('image');
                $fileNameToStore = 'photo-' . md5(uniqid()) . '-' . time() . '.' .
                $image->getClientOriginalExtension();
                $image->move(public_path(path: 'uploads'), name: $fileNameToStore);
            } else {
                $fileNameToStore = $product->image;
            }
            // dd($fileNameToStore);
            $product->update([
                'product_id' => $request->product_id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,     
                'stock' => $request->stock,
                'image' => $fileNameToStore
            ]);

            sweetalert()->success('Product updated successfully');
            return redirect('/products');
        } catch (Exception $e) {
            sweetalert()->error('Product update failed');
            return redirect('/products');
        }
    }
}
