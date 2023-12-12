@extends('layouts.main')

@section('title', 'Edit Student')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12 px-md-5">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{URL::to('/updateStudent')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header border border-warning"
                        style="background-color: #ff9900; border-radius: 7px;">
                        <h3 class="text-center text-white">Edit Student</h3>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Current Pic</label>
                                    <br>
                                    <img src="{{asset('public/assets/uploads/studentImages/'.$students->image) }}"
                                        alt="Student Image" class="col-3 my-2">
                                    <br>
                                    <label for="studentPic">if you want to change than select new</label>
                                    <div class="custom-file">
                                        <input type="file" name="studentPic"
                                            value="{{asset('public/assets/uploads/studentImages/'.$students->image) }}"
                                            class="custom-file-input" id="studentPic">
                                        <label class="custom-file-label" for="studentPic">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="handledBy" value="{{ Auth::user()->name }}">
                            <input type="hidden" name="id" value="{{$students->id}}" id="id">
                            <input type="hidden" name="studentId" value="{{$students->studentId}}" id="studentId">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="studentName">Student Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" name="studentName" value="{{$students->studentName}}"
                                            id="studentName" class="form-control" placeholder="Full Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fatherName">Father Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" name="fatherName" value="{{$students->fatherName}}"
                                            id="fatherName" class="form-control" placeholder="Full Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date of Birth</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="dob" name="dob" value="{{$students->DoB}}" type="text"
                                            class="form-control" data-inputmask-alias="datetime"
                                            data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <div class="input-group">
                                        <input id="phoneNumber" name="phoneNumber" value="{{$students->phoneNumber}}"
                                            type="tel" class="form-control">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="email" value="{{$students->Email}}"
                                            class="form-control" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Home Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <input type="text" name="homeAddress" value="{{$students->homeAddress}}"
                                            class="form-control" placeholder="Address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Parent Email Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="parentEmail" value="{{$students->parentEmail}}"
                                            class="form-control" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class Level ( type and add new if you don't see yours)</label>
                                    <select class="selectSubjects" name="classLevel[]" multiple="multiple"
                                        data-placeholder="Select Classes" style="width: 100%;">
                                        @foreach($uniqueLevels as $level)
                                        <option value="{{ $level }}"
                                            {{ (in_array($level, $separatedLevels)) ? 'selected' : '' }}>
                                            {{ ucfirst(trans($level)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="classDuration">Class Duration</label>
                                    <select id="classDuration" name="classDuration" class="form-control custom-select">
                                        <option selected value="{{$students->classDuration}}">
                                            {{$students->classDuration}}</option>
                                        <option>60 Minutes</option>
                                        <option>90 Minutes</option>
                                        <option>120 Minutes</option>
                                        <option>150 Minutes</option>
                                        <option>180 Minutes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="classMode">Mode of Class</label>
                                    <select id="classMode" name="classMode" class="form-control custom-select">
                                        <option selected value="{{$students->modeOfClass}}">{{$students->modeOfClass}}
                                        </option>
                                        <option>Online</option>
                                        <option>Centre</option>
                                        <option>Home</option>
                                        <option>Group</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Subjects</label>
                                    <select class="selectSubjects" name="subjects[]" multiple="multiple"
                                        data-placeholder="Select Subjects" style="width: 100%;">
                                        @foreach($uniqueSubjects as $subject2)
                                        <option value="{{ $subject2 }}"
                                            {{ (in_array($subject2, $separatedData)) ? 'selected' : '' }}>
                                            {{ ucfirst(trans($subject2)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Earliest Start Date</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="startDate" name="startDate" value="{{$students->startDate}}"
                                            type="text" class="form-control" data-inputmask-alias="datetime"
                                            data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stauts</label>
                                    <select id="status" name="status" class="form-control">
                                        <option selected value="{{$students->status}}">{{$students->status}}</option>
                                        <option>pending</option>
                                        <option>registered</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer bg-white">
                        <button type="submit" class="btn btn-success float-right">Update</button>
                    </div>
                </div>
            </form>
            <!-- /.card -->
        </div>
    </div>
</section>
<!-- /.content -->
@stop