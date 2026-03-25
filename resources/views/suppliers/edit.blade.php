@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('page-header')
    <div class="flex items-center space-x-4">
        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 text-white flex items-center justify-center font-bold text-lg">
            {{ substr($supplier->name, 0, 1) }}
        </div>
        <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Edit Supplier</h1>
            <p class="text-gray-600">{{ $supplier->name }}</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="card">
            <!-- Edit Form -->
            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Validation Errors Alert -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h3 class="font-semibold mb-2">Please fix the following errors:</h3>
                                <ul class="list-disc list-inside space-y-1 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Name Field -->
                <div class="form-group">
                    <label for="name" class="form-label">
                        Supplier Name
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           class="form-input @error('name') border-red-500 focus:ring-red-500 @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $supplier->name) }}" 
                           placeholder="e.g., ABC Trading Company"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        Email Address
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           class="form-input @error('email') border-red-500 focus:ring-red-500 @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $supplier->email) }}" 
                           placeholder="supplier@example.com"
                           required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div class="form-group">
                    <label for="phone" class="form-label">
                        Phone Number
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" 
                           class="form-input @error('phone') border-red-500 focus:ring-red-500 @enderror" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone', $supplier->phone) }}" 
                           placeholder="+1 (800) 123-4567"
                           required>
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address Field -->
                <div class="form-group">
                    <label for="address" class="form-label">
                        Address
                        <span class="text-red-500">*</span>
                    </label>
                    <textarea class="form-textarea @error('address') border-red-500 focus:ring-red-500 @enderror" 
                              id="address" 
                              name="address" 
                              rows="4" 
                              placeholder="Enter the complete address"
                              required>{{ old('address', $supplier->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary flex-1 text-center">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary flex-1">
                        <span class="inline-flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Update Supplier</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Danger Zone -->
        <div class="mt-8 bg-red-50 border border-red-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-red-900 mb-4">Danger Zone</h3>
            <p class="text-red-800 mb-4">Deleting this supplier will permanently remove it from the system. This action cannot be undone.</p>
            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="btn bg-red-600 text-white hover:bg-red-700"
                        onclick="return confirm('Are you absolutely sure you want to delete the supplier &quot;{{ addslashes($supplier->name) }}&quot;? This action cannot be undone.')">
                    Delete This Supplier
                </button>
            </form>
        </div>
    </div>
@endsection
