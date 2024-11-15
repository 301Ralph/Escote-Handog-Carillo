<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of the products
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

    // Store a newly created product in the database
    public function store(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|string',  // Ensure image is selected
        ]);

        // Check if an image is selected; if not, use the default image
        $imagePath = '/images/' . $request->image;

        // Create a new product in the database with the correct image path
        Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $imagePath,  // Store the image path in the database
        ]);

        // Redirect to product index page with success message
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }   

    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Delete the associated image file if it exists and is not the default image
        if ($product->image && $product->image != '/images/default.jpg') {
            $imagePath = public_path($product->image);  // Get the full path to the image file
            if (file_exists($imagePath)) {
                unlink($imagePath);  // Delete the image file
            }
        }

        // Delete the product record from the database
        $product->delete();

        // Redirect to the product index with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }


    // Display the specified product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Return the edit view with the product
        return view('products.edit', compact('product'));
    }

    // Update the specified product in storage
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If the image is uploaded, store it
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Update the product with the validated data
        $product->update($validatedData);

        // Redirect back to product list with a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
}
