@extends('layouts.app')

@section('content')
    <!-- Page Title -->
    <div class="shop-title">
        <h1>Welcome to Brycesilog</h1>
        <p>Tikman ang napakasarap na si Bryce, Mura na mahal pa!</p>
    </div>

    <!-- Product List Section -->
    <div class="product-list">
        @foreach ($products as $product)
            <a href="{{ route('products.show', $product->id) }}">
                <div class="product-card">
                    <img 
                        src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" 
                    alt="{{ $product->name }}" 
                    class="view-product-image"
                    >
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p class="product-price">$ {{ number_format($product->price, 2) }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <div class="navigation-buttons">
        @if ($hasPrevPage)
            <button class="nav-btn" id="prevBtn" data-page="{{ $page - 1 }}">Previous</button>
        @endif

        @if ($hasNextPage)
            <button class="nav-btn" id="nextBtn" data-page="{{ $page + 1 }}">Next</button>
        @endif
    </div>


    <!-- Add Product Button -->
    <a href="{{ route('products.create') }}" class="floating-add-btn  ">
        <i class="fa fa-shopping-cart"> Add Product</i>
    </a>
@endsection

@section('scripts')
    <script src="{{ asset('js/add-product.js') }}"></script>
@endsection
