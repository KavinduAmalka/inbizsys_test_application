<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Suppliers</h3>
                        <a href="{{ route('suppliers.create') }}" class="btn btn-light btn-sm">+ Add New Supplier</a>
                    </div>
                    <div class="card-body">
                        @if ($suppliers->isEmpty())
                            <!-- Show this if NO suppliers exist -->
                            <div class="alert alert-info">
                                <strong>No suppliers found!</strong> 
                                <a href="{{ route('suppliers.create') }}">Click here to add the first supplier</a>
                            </div>
                        @else
                            <!-- Show this table if suppliers exist -->
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suppliers as $supplier)
                                            <tr>
                                                <td><strong>{{ $supplier->id }}</strong></td>
                                                <td>{{ $supplier->name }}</td>
                                                <td>{{ $supplier->email }}</td>
                                                <td>{{ $supplier->phone }}</td>
                                                <td>{{ $supplier->address }}</td>
                                                <td>
                                                    <a href="{{ route('suppliers.edit', $supplier->id) }}" 
                                                       class="btn btn-warning btn-sm">
                                                        ✏️ Edit
                                                    </a>
                                                    
                                                    <!-- Delete Form with Confirmation -->
                                                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" 
                                                          method="POST" 
                                                          style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this supplier? This action cannot be undone.')">
                                                            🗑️ Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
