@extends('layout.admin')
@section('content')
<div class="row">
    <div class="col">
        <h2 class="display-2">
            Edit Course
        </h2>
    </div>
</div>

<div class="row">
    <div class="col">
        <form action="{{ route('courses.update', $course ->id) }}" method="POST">
            @method('PUT')
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $course->name}}">
            </div>
            <div class="mb-3">
                <label for="courseID" class="form-label">Course ID</label>
                <input type="text" class="form-control" id="courseID" name="courseID" value="{{ $course->courseID}}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $course->description}}">
            </div>     
            <button type="submit" class="btn btn-primary">Edit Course</button>
        </form>                
    </div>
</div>

@endsection