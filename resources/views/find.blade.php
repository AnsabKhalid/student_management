@extends('layouts.main')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                    <div class="card-body py-2 bg-white">
                        <div class="row pt-2 d-flex justify-content-between">
                            <div class="col-md-10">
                                <h2 class="lead"><b>{{ $student->studentName }}</b></h2>
                                <p class="text-muted text-sm"><b>Class Level: </b> {{ $student->classLevel }} </p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small pb-2"><span class="fa-li"><i
                                                class="fas fa-lg fa-envelope"></i></span>
                                        Email: {{ $student->Email }}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                        Phone #: {{ $student->phoneNumber }}</li>
                                </ul>
                            </div>
                            <div>
                                <img src="{{URL::to('public/assets/uploads/studentImages')}}/{{$student->image}}"
                                    alt="user-avatar" class="img-circle img-fluid h-50">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="text-right">
                            <a href="{{URL::to('/StudentProfile/'. $student->id ) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-user pr-2"></i> View Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card my-2">
                    <div class="card-header" style="background-color: #ffc266;">
                        <h2 class="text-center text-white font-weight-bold">Select subjects to find the teacher</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ URL::to('/findTeachers') }}" method="POST" class="form-group">
                            @csrf
                            <input type="hidden" name="studentId" value="{{ $student->id }}">
                            <select class="select2" name="subjects[]" multiple="multiple"
                                data-placeholder="Select Subjects" style="width: 100%;">
                                @foreach( $separatedData as $subjects)
                                <option name="{{ ucfirst(trans($subjects)) }}}">{{ ucfirst(trans($subjects)) }}</option>
                                @endforeach
                            </select>
                            <div class="card-footer bg-white">
                                <div class="text-right">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-search pr-2"></i>
                                        Find
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if(session()->has('matchingTeachers'))
                @php
                $uniqueURL= session()->get('uniqueURL');
                $selectedSubjects = session()->get('selectedSubjects');
                @endphp
                <div class="card">
                    <div class="card-header py-4">
                        <h2 class="float-left">Search Results</h2>
                        <button class="btn btn-success float-right"
                            onclick="copyToClipboard('{{URL::to("/shared/". $uniqueURL)}}')">
                            <a class="btn text-light" target="_blank" href="{{url('/shared/' . $uniqueURL)}}">Share</a>
                        </button>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger px-5 mx-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session()->has('success'))
                    <div class="alert alert-success px-5 mx-5">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('send.email') }}" method="POST">
                            @csrf
                            <table id="students" class="table table-bordered table-striped">
                                <thead>
                                    {{--                                <input type="hidden" value="{{$subjects}}"
                                    name="subjects">--}}
                                    <select class="d-none" name="subjects[]" multiple="multiple"
                                        style="pointer-events: none;">
                                        @foreach($selectedSubjects as $subjects )
                                        <option class="d-none" selected name="{{ ucfirst(trans($subjects)) }}}">
                                            {{ ucfirst(trans($subjects)) }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" value="{{ $student->studentName }}" name="studentName">
                                    <tr>
                                        <th>Select</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Subjects</th>
                                        <th>Qualification</th>
                                        <th>Physical Availability</th>
                                        <th>Share Profile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( session()->get('matchingTeachers') as $teacher )
                                    <tr>
                                        <td class="align-middle">
                                            <input type="checkbox" class="form-control" name="selectedTeachers[]"
                                                value="{{ $teacher['teacherName'] }}|{{ $teacher['Email'] }}">
                                        </td>
                                        <td class="align-middle">
                                            <img src="{{URL::to('public/assets/uploads/teacherImages')}}/{{$teacher['image'] }}"
                                                style="width: 90px; border-radius: 10px">
                                        </td>
                                        <td class="align-middle">
                                            {{ $teacher['teacherName'] }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $teacher['teachingLevel'] }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $teacher['subjects'] }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $teacher['educationQualification'] }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $teacher['cities'] }}
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn"
                                                onclick="copyToClipboard('{{ URL::to('/teacherPublicProfile/'. $teacher['teacherId']) }}')">
                                                <a href="{{ URL::to('/teacherPublicProfile/'. $teacher['teacherId']) }}"
                                                    class="btn btn-success">Share</a>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button class="btn btn-success btn-lg float-right">Send Email</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection