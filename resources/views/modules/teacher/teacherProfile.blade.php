@extends('layouts.main')

@section('title', 'Teacher Profile')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

            <section class="col-lg-12">
                <div class="row my-3 py-4 d-flex justify-content-center">
                    <div class="col-md-10">
                        <h3 class="text-center text-white border border-warning"
                            style="background-color: #ff9900; border-radius: 7px;">Teacher Profile</h2>
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <a href="{{URL::to('/editTeacher/'. $teacher->id ) }}"
                                        class="btn btn-warning float-right">
                                        <i class="fa fa-edit pr-2"></i>
                                        Edit
                                    </a>
                                    <a href="{{ route('teacher.cv', ['cv' => $teacher->cv]) }}" target="_blank"
                                        class="btn btn-primary float-left">
                                        <i class="fa fa-eye pr-2"></i>
                                        View CV
                                    </a>
                                    <img src="{{URL::to('public/assets/uploads/teacherImages')}}/{{$teacher->image}}"
                                        alt="avatar" class="mx-auto d-block" style="width: 150px; border-radius: 10px;">
                                    <div class="card-body my-4">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Registered at</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    {{ date('d-M-Y / h-i-a',strtotime($teacher->created_at)) }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Teacher Id</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->teacherId }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->teacherName}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Passport / N.I.C</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->nicNumber}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Date of Birth</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->DoB}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Phone Number</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->phoneNumber}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->Email}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Home Address</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->homeAddress}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Rating</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    @for($i=1; $i <= $teacher->rating; $i++)
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        @endfor
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Education Qualification</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->educationQualification}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Experience</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->experience}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Teaching Level</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->teachingLevel}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Subjects</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    @foreach($separatedData as $data)
                                                    <a href="" class="btn btn-info">{{ucfirst(trans($data))}}</a>
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Availability</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->availability}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Physically available in Cities</p>
                                            </div>
                                            <div class="col-sm-9">
                                                @if($teacher->cities == 'N/A')
                                                <p class="badge badge-info">Not Available</p>
                                                @else
                                                @foreach($separatedCities as $cities)
                                                <a href="" class="btn btn-info">{{ucfirst(trans($cities))}}</a>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">BIO</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->bio}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">paymentInfo</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->paymentInfo}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- /.card -->
            </section>

        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@stop