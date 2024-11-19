<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .modal-content {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .modal-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom: none;
        }
        
        .modal.fade .modal-dialog {
            transition: transform .3s ease-out;
        }
        
        .modal.show .modal-dialog {
            transform: none;
        }
        
        .btn {
            border-radius: 5px;
            padding: 8px 20px;
            transition: all 0.3s;
        }
        
        .btn:hover {
            transform: translateY(-1px);
        }
        
        .btn-outline-secondary:hover {
            background-color: #e9ecef;
            color: #333;
            border-color: #e9ecef;
        }
        
        .close:hover {
            opacity: 1;
        }
        
        .fa-trash-alt {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1>Product Details</h1>

    <div class="card">
        <img src="{{ $product->image ? asset('images/' . $product->image) : asset('/images/default.png') }}" class="card-img-top" alt="Product Image">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
            <p><strong>Price:</strong> ${{ $product->price }}</p>
        </div>
    </div>

    <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Back to Products</a>
    <a href="{{ url('/product/'.$product->id.'/edit') }}" class="btn btn-warning btn-block">Edit</a>
    
    <!-- Replace form with button that triggers modal -->
    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteModal">
        Delete
    </button>

    <!-- Add Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Confirm Delete
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                        <h4>Are you sure?</h4>
                        <p class="text-muted">
                            You are about to delete "<strong>{{ $product->name }}</strong>".<br>
                            This action cannot be undone.
                        </p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-secondary px-4 mr-3" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                        <form action="{{ url('/product/'.$product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-4">
                                <i class="fas fa-trash-alt mr-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
