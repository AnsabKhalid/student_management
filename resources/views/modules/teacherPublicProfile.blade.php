@extends('layouts.second')

@section('title', 'Teacher Profile')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">

                <section class="col-lg-12">
                    <div class="row my-3 py-4">
                        <div class="offset-md-2 col-md-8">
                            <h2 class="text-center">Teacher Profile</h2>
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="{{URL::to('public/assets/uploads/teacherImages')}}/{{$teacher->image}}" alt="avatar"
                                         class="mx-auto d-block" style="width: 150px; border-radius: 10px;">
                                    <div class="card-body my-4">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->teacherName}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                       <!-- <div class="row">
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
                                                <p class="mb-0">Home Address</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$teacher->homeAddress}}</p>
                                            </div>
                                        </div>
                                        <hr>-->
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
