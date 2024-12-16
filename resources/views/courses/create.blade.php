@extends('layout.admin')
@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2 class="display-2">Add a Course</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('courses.store') }}" method="POST" class="card p-4 shadow-sm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Course Name*</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="courseID" class="form-label">Course ID*</label>
                    <input type="text" 
                           class="form-control @error('courseID') is-invalid @enderror" 
                           id="courseID" 
                           name="courseID" 
                           value="{{ old('courseID') }}" 
                           required>
                    @error('courseID')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="credits" class="form-label">Credits*</label>
                    <input type="number" 
                           class="form-control @error('credits') is-invalid @enderror" 
                           id="credits" 
                           name="credits" 
                           value="{{ old('credits') }}" 
                           min="0" 
                           max="10" 
                           required>
                    @error('credits')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <select class="form-select @error('semester') is-invalid @enderror" 
                            id="semester" 
                            name="semester">
                        <option value="">Select Semester</option>
                        <option value="Fall" {{ old('semester') == 'Fall' ? 'selected' : '' }}>Fall</option>
                        <option value="Winter" {{ old('semester') == 'Winter' ? 'selected' : '' }}>Winter</option>
                        <option value="Summer" {{ old('semester') == 'Summer' ? 'selected' : '' }}>Summer</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" 
                            name="status">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add Course</button>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Adding a New Course</h5>
                    <p class="card-text">Please ensure all required fields (*) are filled out correctly.</p>
                    <ul class="list-unstyled">
                        <li>Course Name - Full name of the course</li>
                        <li>Course ID - Unique identifier</li>
                        <li>Description - Brief overview of the course</li>
                        <li>Credits - Number of credits for the course</li>
                        <li>Semester - When the course is offered</li>
                        <li>Status - Current state of the course</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        font-weight: 500;
    }
    .card {
        border-radius: 10px;
    }
    .alert {
        border-radius: 10px;
    }
</style>
@endsection