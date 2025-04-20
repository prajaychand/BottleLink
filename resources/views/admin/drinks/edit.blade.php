@extends('admin.layout')

@section('content')
    <x-app-layout>
        <main id="main" class="main">
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h1 class="text-center fs-4 my-2">Edit Drink</h1>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{ route('admin.drinks.update', $drink->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="name" class="form-label fw-bold">Drink Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $drink->name }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="price" class="form-label fw-bold">Price</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" name="price" id="price" class="form-control" value="{{ $drink->price }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="category_id" class="form-label fw-bold">Category</label>
                                            <select name="category_id" id="category_id" class="form-select" required>
                                                <option value="" disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $drink->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="description" class="form-label fw-bold">Description</label>
                                            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $drink->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-group">
                                            <label for="image" class="form-label fw-bold">Image</label>
                                            <input type="file" name="image_path" id="image" class="form-control">
                                            
                                            @if($drink->image_path)
                                                <div class="mt-2">
                                                    <p class="text-muted small">Current image:</p>
                                                    <div class="position-relative d-inline-block">
                                                        <img src="{{ asset($drink->image_path) }}" class="img-thumbnail" style="max-width: 150px; height: auto;">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{ route('admin.drinks.index') }}" class="btn btn-outline-secondary me-md-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary px-4">Update Drink</button>
                                    </div>
                                </form>

                                <!-- Display validation errors if any -->
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-4">
                                        <ul class="mb-0 ps-3">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Display success message if any -->
                                @if(session('success'))
                                    <div class="alert alert-success mt-4">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </x-app-layout>
@endsection