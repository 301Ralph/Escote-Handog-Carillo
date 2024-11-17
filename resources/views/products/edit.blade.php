@extends('layouts.app')

@section('content')
    <div class="product-modal">
        <div class="product-modal-content centered">
            <!-- Close Button (X) positioned inside the modal content -->
            <a href="{{ route('products.index') }}" class="close-btn-inside">&times;</a>

            <div class="product-details text-center">
                <h2>Edit Product</h2>

                <!-- Edit Product Form -->
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="name">Product Name:</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                    </div>

                    <!-- Product Price -->
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" required>
                    </div>

                    <!-- Product Description -->
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn">Update Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection
