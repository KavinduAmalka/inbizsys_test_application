@extends('layouts.app')

@section('title', 'Suppliers')

@section('page-header')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Suppliers Management</h1>
            <p class="text-gray-600">Manage all your suppliers in one place</p>
        </div>
        <div class="mt-4 sm:mt-0 flex gap-2 flex-wrap">
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary inline-flex items-center space-x-2 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add New Supplier</span>
            </a>
            <a href="{{ route('suppliers.print') }}" target="_blank" class="btn btn-secondary inline-flex items-center space-x-2 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4H9m4 0h4m-2-8V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4"></path>
                </svg>
                <span>Print List</span>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <!-- Search Bar -->
    <!-- Search Bar -->
    <div class="mb-6">
        <form method="GET" action="{{ route('suppliers.index') }}" class="flex gap-2 items-end justify-end">
            <input 
                type="email" 
                id="email-search" 
                name="email" 
                value="{{ $search ?? '' }}" 
                placeholder="Search by email..." 
                class="input input-bordered input-sm w-64"
            >
            <button type="submit" class="btn btn-primary btn-sm inline-flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <span>Search</span>
            </button>
            @if (!empty($search))
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary btn-sm inline-flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span>Clear</span>
                </a>
            @endif
        </form>
    </div>



    @if ($suppliers->isEmpty())
        <!-- Empty State -->
        <div class="card">
            <div class="card-body text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                @if (!empty($search))
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Results Found</h3>
                    <p class="text-gray-600 mb-6">No suppliers match the email "{{ $search }}"</p>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-primary">
                        View All Suppliers
                    </a>
                @else
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Suppliers Found</h3>
                    <p class="text-gray-600 mb-6">Get started by adding your first supplier</p>
                    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                        Add Your First Supplier
                    </a>
                @endif
            </div>
        </div>
    @else
        <!-- Search Results Info -->
        @if (!empty($search))
            <div class="card mb-4 bg-blue-50 border border-blue-200">
                <div class="card-body">
                    <p class="text-sm text-blue-800">
                        <span class="font-semibold">Search Results:</span> Found {{ $suppliers->count() }} {{ Str::plural('supplier', $suppliers->count()) }} matching the email "{{ $search }}"
                    </p>
                </div>
            </div>
        @endif

        <!-- Suppliers Table -->
        <div class="card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="w-12">ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="font-semibold text-gray-900">{{ $supplier->id }}</td>
                                <td>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 text-white flex items-center justify-center font-bold mr-3">
                                            {{ substr($supplier->name, 0, 1) }}
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $supplier->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:{{ $supplier->email }}" class="text-blue-600 hover:text-blue-800 underline">
                                        {{ $supplier->email }}
                                    </a>
                                </td>
                                <td>
                                    <a href="tel:{{ $supplier->phone }}" class="text-blue-600 hover:text-blue-800 underline">
                                        {{ $supplier->phone }}
                                    </a>
                                </td>
                                <td class="text-gray-600 text-sm">{{ $supplier->address }}</td>
                                <td class="text-center">
                                    <div class="flex justify-center items-center space-x-2">
                                        <a href="{{ route('suppliers.edit', $supplier->id) }}" 
                                           class="btn btn-secondary btn-sm inline-flex items-center space-x-1 py-1 px-3">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <span>Edit</span>
                                        </a>
                                        
                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" 
                                              method="POST" 
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm inline-flex items-center space-x-1 py-1 px-3"
                                                    onclick="return confirm('Are you sure you want to delete {{ addslashes($supplier->name) }}? This action cannot be undone.')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer with Summary -->
            <div class="card-footer bg-gray-50 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    Showing <span class="font-semibold">{{ $suppliers->count() }}</span>
                    {{ Str::plural('supplier', $suppliers->count()) }}
                </p>
            </div>
        </div>
    @endif
@endsection
