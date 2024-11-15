@extends('layouts.app')

@section('content')
    <div class="product-modal">
        <div class="product-modal-content centered">
            <!-- Close Button (X Icon) -->
            <a href="{{ route('products.index') }}" class="close-btn-inside">&times;</a>

            <h2>Add Product</h2>

            <!-- Product Form -->
            <form action="{{ route('products.store') }}" method="POST" id="addProductForm">
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

                <div class="form-group">
                    <label for="image">Select Image:</label>
                    @php
                        use Illuminate\Support\Facades\File;
                        $files = File::files(public_path('images')); // List all images in the public/images folder
                    @endphp

                    <select id="image" name="image" required onchange="updateImagePreview()">
                        <option value="default.jpg" {{ old('image') == 'default.jpg' ? 'selected' : '' }}>Default Image</option>
                        @foreach ($files as $file)
                            @php
                                $imageName = $file->getFilename();  // Get the filename of each image
                            @endphp
                            <option value="{{ $imageName }}" {{ old('image') == $imageName ? 'selected' : '' }}>{{ ucfirst(pathinfo($imageName, PATHINFO_FILENAME)) }}</option>
                        @endforeach
                    </select>

                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image Preview -->
                <div class="form-group">
                    <label>Image Preview:</label>
                    <img id="imagePreview" src="{{ asset('images/' . (old('image') ?? 'default.jpg')) }}" alt="Image Preview" style="width: 150px; height: auto;">
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
        function updateImagePreview() {
            const selectedImage = document.getElementById('image').value;
            const previewImage = document.getElementById('imagePreview');
            previewImage.src = `/images/${selectedImage}`;
        }
    </script>
@endsection
