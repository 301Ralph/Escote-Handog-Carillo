@extends('layouts.app')

@section('content')
    <div class="product-modal">
        <div class="product-modal-content centered">
            <!-- Close Button (X Icon) -->
            <a href="{{ route('products.index') }}" class="close-btn-inside">&times;</a>

            <h2>Add Product</h2>

            <!-- Product Form -->
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" name="name" id="productName" value="{{ old('name') }}" required placeholder="Enter product name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="productPrice">Price</label>
                    <input type="number" name="price" id="productPrice" value="{{ old('price') }}" step="0.01" required placeholder="Enter product price">
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="productDescription">Description</label>
                    <textarea name="description" id="productDescription" required placeholder="Enter product description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Choose Image</label>
                    <select class="form-control" id="image" name="image" required>
                        <option value="image1.jpg">Image 1</option>
                        <option value="image2.jpg">Image 2</option>
                        <option value="image3.jpg">Image 3</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn">Add Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showSuccessMessage() {
            alert("Product added successfully!");
            return true; // Continue with form submission
        }
    </script>
@endsection

