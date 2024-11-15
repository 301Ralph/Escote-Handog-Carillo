<!-- resources/views/products/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="product-modal">
        <div class="product-modal-content centered">
            <a href="{{ route('products.index') }}" class="close-btn-inside">&times;</a>
            <div class="product-details text-center">
                <h2>{{ $product->name }}</h2>

                <!-- Product Image -->
                <img 
                src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" 
                    alt="{{ $product->name }}" 
                    class="view-product-image"
                >

                <!-- Product Information -->
                <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                <p><strong>Description:</strong> {{ $product->description }}</p>

                <!-- Navigation Buttons Section -->
                <div class="navigation-buttons">
                    <!-- Update Button -->
                    <a href="{{ route('products.edit', $product->id) }}" class="btn">Update</a>

                    <!-- Delete Button with Confirmation -->
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn nav-btn" onclick="return confirm('Are you sure you want to delete this product?');">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
