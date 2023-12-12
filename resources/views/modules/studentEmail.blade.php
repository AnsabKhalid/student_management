@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 px-5">
        <form action="{{ URL::to('/sendStudentEmail') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-header col-md-12 border border-warning mb-4" style="background-color: #ffc266;">
                    <h3 class="text-center text-white pt-2 font-weight-bold">Write Email to a Student</h3>
                </div>
                <div class="card-body">
                    <select class="select2 my-3" name="student" data-placeholder="Select Subjects" style="width: 100%;">
                        <option disabled selected>Select A Student</option>
                        @foreach( $allStudents as $student)
                        <option value="{{ $student->studentId }}|{{ $student->studentName }}">{{ $student->studentId }}
                            . {{ $student->studentName }}</option>
                        @endforeach
                    </select>
                    <br>
                    <textarea name="message" class="form-control" rows="8"></textarea>

                </div>
                <div class="card-footer bg-white">
                    <button type="submit" class="btn btn-success float-right">
                        Send
                        <i class="fa fa-paper-plane pl-2" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection