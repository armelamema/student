@extends('layout.admin')
@section('content')
<div class="row">
    <div class="col">
        <h2 class="display-2">
            Edit Student Profile
        </h2>
    </div>
</div>

<div class="row">
    <div class="col">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @method('PUT')
            {{ csrf_field() }}
            
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" 
                       class="form-control @error('fname') is-invalid @enderror" 
                       id="fname" 
                       name="fname" 
                       value="{{ old('fname', $student->fname) }}">
                @error('fname')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" 
                       class="form-control @error('lname') is-invalid @enderror" 
                       id="lname" 
                       name="lname" 
                       value="{{ old('lname', $student->lname) }}">
                @error('lname')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $student->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Enrolled Courses</label>
                <div class="card p-3">
                    @foreach($courses as $course)
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="courses[]" 
                                   value="{{ $course->id }}" 
                                   id="course{{ $course->id }}"
                                   {{ in_array($course->id, $selectedCourses ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="course{{ $course->id }}">
                                {{ $course->name }} 
                                @if(isset($course->courseID))
                                    ({{ $course->courseID }})
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('courses')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>                
    </div>
</div>

<style>
    .card {
        border-radius: 8px;
    }
    .form-check {
        margin-bottom: 0.5rem;
    }
    .form-check:last-child {
        margin-bottom: 0;
    }
</style>

@endsection