<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: none;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px 25px;
        }

        .card-body {
            padding: 10px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }

        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .image-preview {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .custom-file-label {
            padding: 12px;
            border-radius: 8px;
        }

        .section-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: #007bff;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <h1 class="section-title">Edit Product</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-edit mr-2"></i>Product Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"><i class="fas fa-box mr-2"></i>Product Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description"><i class="fas fa-align-left mr-2"></i>Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quantity"><i class="fas fa-cubes mr-2"></i>Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="price"><i class="fas fa-tag mr-2"></i>Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-image mr-2"></i>Product Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                            @if ($product->image)
                                <div class="mt-3">
                                    <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" class="image-preview" width="150">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-right">
                    <a href="{{ url('/') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
