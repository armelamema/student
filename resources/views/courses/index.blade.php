@extends('layout.admin')
@section('content')

    <div class="row">
        <div class="col">
            <h1 class="display-2">All Courses</h1>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{$course->name}}
                            </h5>
                            <p class="card-text text-muted mb-1">{{$course->id}}</p>
                            <p class="card-text mb-3">{{$course->description}}</p>
                            <a href="{{ route('courses.edit', $course->id) }}">
                                Edit
                            </a>
                            <a href="{{ route('courses.trash', $course->id) }}">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>        
    </div>

@endsection