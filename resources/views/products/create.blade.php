<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .slide-panel {
            position: fixed;
            left: -100%;
            top: 0;
            width: 400px;
            height: 100%;
            background-color: white;
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
    </style>
</head>
<body>

<!-- Add toggle button -->
<div class="container mt-5">
    <button id="togglePanel" class="btn btn-primary">Add New Product</button>
</div>

<!-- Modified form container -->
<div class="panel-overlay"></div>
<div class="slide-panel">
    <h1>Add Product</h1>
    <button class="close btn btn-sm btn-secondary mb-3" id="closePanel">&times;</button>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
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

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

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
</body>
</html>
