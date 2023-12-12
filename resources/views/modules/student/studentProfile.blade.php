@extends('layouts.main')

@section('title', 'Student Profile')

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
                            style="background-color: #ff9900; border-radius: 7px;">Student Profile</h3>
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <img src="{{URL::to('public/assets/uploads/studentImages')}}/{{$students->image}}"
                                            alt="avatar" class="mx-auto d-block"
                                            style="width: 150px; border-radius: 10px;">
                                    </div>
                                    <div>
                                        <a href="{{URL::to('/editStudent/'. $students->id ) }}"
                                            class="btn btn-warning float-right">
                                            Edit
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body my-4">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Created at</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">
                                                {{ date('d-M-Y / h-i-a',strtotime($students->created_at)) }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">status</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">
                                                @if( $students->status == 'pending')
                                                <span class="badge badge-danger badge-pill">Pending</span>
                                                @else
                                                <span class="badge badge-success badge-pill">Registered</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Student Id</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$students->studentId}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$students->studentName}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Father Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$students->fatherName}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Date of Birth</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$students->DoB}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Phone Number</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$students->phoneNumber}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$students->Email}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Parent Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$students->parentEmail}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Send Parent Email</p>
                                        </div>
                                        <div class="col-sm-7">
                                            <p class="text-muted mb-0">
                                                @if($students->sendEmail == '0')
                                                <span class="badge badge-danger p-2">No</span>
                                                @elseif($students->sendEmail == '1')
                                                <span class="badge badge-success p-2">Yes</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="{{ URL::to('/changePermission/'.$students->studentId,$students->sendEmail ) }}"
                                                class="badge badge-info">
                                                Change it
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$students->homeAddress}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Class Level</p>
                                        </div>
                                        <div class="col-sm-9">
                                            @foreach( $separatedLevels as $levels)
                                            <p class="mb-0 btn btn-info">{{$levels}}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Class Duration</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$students->classDuration}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Mode of Class</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$students->modeOfClass}}</p>
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