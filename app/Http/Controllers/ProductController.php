<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 8;

        $products = Product::skip(($page - 1) * $perPage)
                           ->take($perPage)
                           ->get();

        $totalProducts = Product::count();
        $hasNextPage = ($page * $perPage) < $totalProducts;
        $hasPrevPage = $page > 1;

        return view('products.index', compact('products', 'page', 'hasNextPage', 'hasPrevPage'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|in:image1.jpg,image2.jpg,image3.jpg',
        ]);

        $product = Product::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
        ]);

        return redirect()->route('products.index')->with('success', 'Product Addedd Successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
