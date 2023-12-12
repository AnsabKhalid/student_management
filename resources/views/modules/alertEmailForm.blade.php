@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <form action="{{ URL::to('/sendAlert') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3> Write Email for Class Alert</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="studentId" value="{{ $student->studentId }}">
                        <input type="hidden" name="studentName" value="{{ $student->studentName }}">
                        <input type="hidden" name="email" value="{{ $student->Email }}">
                        <input type="hidden" name="classTime" value="{{ $classTime }}">
                        <input type="hidden" name="teacherId" value="{{ $teacherId }}">
                        <textarea name="message" class="form-control" rows="8"></textarea>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">
                            Send
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
