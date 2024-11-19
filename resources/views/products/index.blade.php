<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        :root {
            /* Main Color Palette */
            --primary-dark: #624E88;    /* Dark Purple */
            --primary: #8967B3;         /* Medium Purple */
            --accent: #CB80AB;          /* Pink */
            --light: #E6D9A2;          /* Light Yellow */
            
            /* Additional Shades */
            --primary-hover: #735A9F;   /* Slightly lighter than primary-dark */
            --primary-light: #9A7DC0;   /* Slightly lighter than primary */
            --accent-hover: #D691BC;    /* Slightly lighter than accent */
            --light-hover: #EBE1B4;    /* Slightly lighter than light */
            --text-dark: #4A3B68;      /* Darker version for text */
            --text-light: #FFFFFF;     /* White text */
            --background-light: #F8F6FB; /* Very light purple background */
        }

        /* Button Styles */
        .btn-primary, .btn-edit {
            background-color: var(--primary);
            color: var(--text-light);
            border: none;
        }

        .btn-primary:hover, .btn-edit:hover {
            background-color: var(--primary-hover);
            color: var(--text-light);
        }

        .btn-secondary {
            background-color: var(--accent);
            color: var(--text-light);
            border: none;
        }

        .btn-secondary:hover {
            background-color: var(--accent-hover);
            color: var(--text-light);
        }

        .btn-outline-secondary {
            color: var(--primary);
            border: 1px solid var(--primary);
            background-color: transparent;
        }

        .btn-outline-secondary:hover {
            background-color: var(--background-light);
            color: var(--primary-dark);
        }

        /* Modal Styles */
        .modal-header {
            background-color: var(--primary-dark);
            color: var(--text-light);
        }

        .image-container {
            background-color: var(--background-light);
            border: 1px solid rgba(98, 78, 136, 0.1);
        }

        /* Form Elements */
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(137, 103, 179, 0.25);
        }

        .input-group-text {
            background-color: var(--background-light);
            border-color: var(--primary-light);
            color: var(--primary-dark);
        }

        /* Card Styles */
        .card {
            border-color: rgba(98, 78, 136, 0.1);
        }

        .card:hover {
            box-shadow: 0 0 15px rgba(98, 78, 136, 0.1);
        }

        /* Text Colors */
        .modal-body p strong {
            color: var(--primary-dark);
        }

        .form-group label i {
            color: var(--primary);
        }

        .product-price {
            color: var(--primary-dark);
        }

        /* Delete Button (keeping red for warning) */
        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Modal Content */
        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(98, 78, 136, 0.15);
        }

        /* Close Button in Modal Header */
        .modal-header .close {
            color: var(--text-light);
            opacity: 0.8;
        }

        .modal-header .close:hover {
            opacity: 1;
        }

        /* Section Titles */
        .section-title:after {
            background: var(--primary);
        }

        /* Links */
        a {
            color: var(--primary);
        }

        a:hover {
            color: var(--primary-dark);
        }

        /* Table Headers (if any) */
        .table thead th {
            background-color: var(--background-light);
            color: var(--primary-dark);
        }

        /* Pagination (if any) */
        .page-link {
            color: var(--primary);
        }

        .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        /* Set the overall background color to #E6D9A2 */
        body {
            background-color: #E6D9A2; /* Soft light yellow background */
            color: #333; /* Darker text color for contrast */
        }

        /* Header Styling */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: #624E88; /* Deep purple header */
            display: flex;
            align-items: center;
            box-shadow: 0 4px 2px -2px gray;
            z-index: 1000;
        }

        h2 {
            color: white;
            margin: 0;
            padding: 20px;
        }

        /* Container with some top margin to avoid header overlap */
        .container {
            margin-top: 80px;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #ffffff; /* White background for the card */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
            background-color: #8967B3; /* Lighter purple on hover */
        }

        /* Image Styling */
        .card-img-top {
            width: 100%;
            height: 200px; /* Fixed height */
            object-fit: cover; /* Cover the entire space without distorting */
            padding: 15px; /* Add padding around the image */
            
        }

        .card-body {
            padding: 15px;
            border-radius: 10px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 10px;
        }

        /* Button Styling */
        .btn {
            transition: background-color 0.3s ease;
            border-radius: 10px;
            padding: 8px 30px;
        }

        /* "Add Product" Button Styling */
        .btn-add-product {
            background-color: #CB80AB; /* Soft pinkish purple */
            border-color: #CB80AB;
            color: white;
            border-radius: 50px;
        }

        .btn-add-product:hover {
            background-color: #E6D9A2; /* Light yellow for hover */
            border-color: #E6D9A2;
            outline: 2px solid;
            outline-color: #624E88;
        }

        /* Button Color */
        .btn-info {
            background-color: #CB80AB; /* Soft pinkish purple */
            border-color: #CB80AB;
        }

        /* Button Hover Effect */
        .btn-info:hover {
            background-color: #E6D9A2; /* Light yellow for hover */
            border-color: #E6D9A2;
            color: black;
        }

        /* Small Screens: Adjust card grid */
        @media (max-width: 767px) {
            .col-md-3 {
                max-width: 100% !important;
                margin-bottom: 20px;
            }
        }

        /* Responsive Grid for Larger Screens */
        @media (min-width: 768px) {
            .col-md-3 {
                margin-bottom: 30px;
            }
        }

        /* Product Info Flexbox */
        .product-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Add these new styles for the sliding panel */
        .slide-panel {
            position: fixed;
            left: -100%;
            top: 0;
            width: 400px;
            height: 100%;
            background-color: #E6D9A2;
            box-shadow: 2px 0 5px rgba(0,0,0,0.2);
            transition: left 0.3s ease-in-out;
            z-index: 1000;
            overflow-y: auto;
            padding: 20px;
        }

        .slide-panel.active {
            left: 0;
        }

        .panel-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .panel-overlay.active {
            display: block;
        }

        /* Add Product Button Positioning and Styling */
        .add-product-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 990;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-add-product {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        /* Tooltip styling */
        .tooltip-text {
            position: absolute;
            right: 70px;
            background-color: #624E88;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        /* Triangle pointer */
        .tooltip-text::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -8px;
            transform: translateY(-50%);
            border-width: 8px 0 8px 8px;
            border-style: solid;
            border-color: transparent transparent transparent #624E88;
        }

        /* Show tooltip on hover */
        .add-product-container:hover .tooltip-text {
            opacity: 1;
            visibility: visible;
        }

        /* Optional: Add hover animation for the button */
        .btn-add-product:hover {
            transform: scale(1.1);
        }

        /* Add these styles for the form save button */
        .slide-panel .btn-add-product {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            margin-top: 20px;
            background-color: #624E88; /* Using the header purple color */
            border-color: #624E88;
            transition: all 0.3s ease;
        }

        .slide-panel .btn-add-product:hover {
            background-color: #8967B3;
            border-color: #8967B3;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .modal-header {
            border-bottom: none;
            border-radius: 15px 15px 0 0;
            padding: 20px 25px;
        }

        .modal-body {
            padding: 25px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255,193,7,.25);
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

        .custom-file-label {
            padding: 12px;
            border-radius: 8px;
        }

        .img-thumbnail {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .image-container {
            width: 100%;
            height: 300px; /* Fixed height */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain; /* This maintains aspect ratio */
            padding: 10px;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-body p {
            font-size: 1.1rem;
            margin-bottom: 15px;
            color: #495057;
        }

        .modal-body strong {
            color: #212529;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .image-container {
                height: 250px;
            }
            
            .modal-body p {
                font-size: 1rem;
            }
        }

        /* Animation for image loading */
        .product-image {
            opacity: 0;
            animation: fadeIn 0.3s ease-in forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Enhanced modal styling */
        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0,0,0,0.15);
        }

        .modal-header {
            padding: 20px 25px;
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
            padding: 20px 25px;
        }

        /* Button styling */
        .modal-footer .btn {
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .modal-footer .btn:hover {
            transform: translateY(-1px);
        }

        .btn-edit {
            background-color: #6f42c1;  /* Purple color */
            color: white;
        }

        .btn-edit:hover {
            background-color: #553098;  /* Darker purple for hover */
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Description text styling */
        .product-description {
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* Price styling */
        .product-price {
            font-size: 1.25rem;
            color: var(--primary-color);
            font-weight: bold;
        }

        /* Add these logo-specific styles to your existing CSS */
        .logo-container {
            padding: 5px 20px;
            display: flex;
            align-items: center;
        }

        .logo {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        /* Update the header styles */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: #624E88;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            z-index: 1000;
        }
    </style>
</head>

<body>
    <header id="header">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            <h4 style="color: var(--light);">Devera-Bayhon E-Catalog</h4>
        </div>
    </header>

    <div class="container">
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ $product->image ? asset('images/' . $product->image) : asset('/images/default.png') }}" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <div class="product-info">
                            <p><strong>Price:</strong> ₱{{ $product->price }}</p>
                        </div>

                        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#productModal{{ $product->id }}">
                            View
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modified button container with tooltip -->
    <div class="add-product-container">
        <span class="tooltip-text">Add New Product</span>
        <button id="togglePanel" class="btn btn-add-product">+</button>
    </div>

    <!-- Add the sliding panel form -->
    <div class="panel-overlay"></div>
    <div class="slide-panel">
        <h1>Add Product</h1>
        <button class="close btn btn-sm btn-secondary mb-3" id="closePanel">&times;</button>

        <form action="{{ url('/product') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-add-product">Save</button>
        </form>
    </div>

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('togglePanel').addEventListener('click', function() {
            document.querySelector('.slide-panel').classList.add('active');
            document.querySelector('.panel-overlay').classList.add('active');
        });

        document.getElementById('closePanel').addEventListener('click', function() {
            document.querySelector('.slide-panel').classList.remove('active');
            document.querySelector('.panel-overlay').classList.remove('active');
        });

        document.querySelector('.panel-overlay').addEventListener('click', function() {
            document.querySelector('.slide-panel').classList.remove('active');
            document.querySelector('.panel-overlay').classList.remove('active');
        });
    </script>

    <!-- Product Modal -->
    @foreach($products as $product)
    <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #624E88; color: white;">
                    <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="image-container">
                                <img src="{{ $product->image ? asset('images/' . $product->image) : asset('/images/default.png') }}" 
                                     class="product-image" 
                                     alt="Product Image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Description:</strong> {{ $product->description }}</p>
                            <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                            <p><strong>Price:</strong> ₱{{ $product->price }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-edit" data-toggle="modal" data-target="#editModal{{ $product->id }}" data-dismiss="modal">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $product->id }}" data-dismiss="modal">
                        <i class="fas fa-trash-alt mr-2"></i>Delete
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete {{ $product->name }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{ url('/product/'.$product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Add Edit Modal for each product -->
    @foreach($products as $product)
    <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #624E88; color: white;">
                    <h5 class="modal-title" id="editModalLabel{{ $product->id }}">
                        <i class="fas fa-edit mr-2"></i>Edit Product
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name{{ $product->id }}"><i class="fas fa-box mr-2"></i>Product Name</label>
                                    <input type="text" name="name" id="name{{ $product->id }}" class="form-control" value="{{ old('name', $product->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description{{ $product->id }}"><i class="fas fa-align-left mr-2"></i>Description</label>
                                    <textarea name="description" id="description{{ $product->id }}" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity{{ $product->id }}"><i class="fas fa-cubes mr-2"></i>Quantity</label>
                                    <input type="number" name="quantity" id="quantity{{ $product->id }}" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="price{{ $product->id }}"><i class="fas fa-tag mr-2"></i>Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input type="number" step="0.01" name="price" id="price{{ $product->id }}" class="form-control" value="{{ old('price', $product->price) }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><i class="fas fa-image mr-2"></i>Product Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image{{ $product->id }}">
                                        <label class="custom-file-label" for="image{{ $product->id }}">Choose file</label>
                                    </div>
                                    @if ($product->image)
                                        <div class="mt-3">
                                            <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" class="img-thumbnail" width="150">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-2"></i>Cancel
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save mr-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Add this script at the bottom of your file -->
    <script>
        // Show filename in custom file input
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
</body>

</html>
