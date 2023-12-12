@extends('layouts.main')

@section('title', 'Add Student')

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
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            <form action="{{URL::to('/storeStudent')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header border border-warning" style="background-color: #ff9900;">
                        <h3 class="text-center text-white pt-2">Add Student Profile
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="studentPic">Upload Picture</label>
                                    <div class="custom-file">
                                        <input type="file" name="studentPic" class="custom-file-input" id="studentPic">
                                        <label class="custom-file-label" for="studentPic">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="studentName">Student Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="hidden" name="handledBy" value="{{ Auth::user()->name }}">
                                        <input type="text" name="studentName" id="studentName" class="form-control"
                                            placeholder="Full Name">
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
                                        <input type="text" name="fatherName" id="fatherName" class="form-control"
                                            placeholder="Full Name">
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
                                        <input id="dob" name="dob" type="text" class="form-control"
                                            data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                            data-mask>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <div class="input-group">
                                        <input id="phoneNumber" name="phoneNumber" type="tel" class="form-control">
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
                                        <input type="email" name="email" class="form-control" placeholder="Email">
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
                                        <input type="text" name="homeAddress" class="form-control"
                                            placeholder="Address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Parent Email Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="parentEmail" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{--                                        <label for="classLevel">Class Level</label>--}}
                                    {{--                                        <input type="number" name="classLevel" id="classLevel" class="form-control" placeholder="Class">--}}
                                    <label>Class Level</label>
                                    <select class="selectSubjects" name="classLevel[]" multiple="multiple"
                                        data-placeholder="Select Classes" style="width: 100%;">
                                        @foreach( $allClassLevels as $levels)
                                        <option name="{{$levels->classLevel}}">{{$levels->classLevel}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="classDuration">Class Duration</label>
                                    <select id="classDuration" name="classDuration" class="form-control custom-select">
                                        <option selected disabled>Select one</option>
                                        <option>60 Minutes</option>
                                        <option>90 Minutes</option>
                                        <option>120 Minutes</option>
                                        <option>150 Minutes</option>
                                        <option>180 Minutes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="classMode">Mode of Class</label>
                                    <select id="classMode" name="classMode" class="form-control custom-select">
                                        <option selected disabled>Select one</option>
                                        <option>Online</option>
                                        <option>Centre</option>
                                        <option>Home</option>
                                        <option>Group</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Select Subjects</label>
                                    <select class="selectSubjects" name="subjects[]" multiple="multiple"
                                        data-placeholder="Select Subjects" style="width: 100%;">
                                        @foreach( $allSubjects as $subjects)
                                        <option name="{{ ucfirst(trans($subjects->subjectName)) }}}">
                                            {{ ucfirst(trans($subjects->subjectName)) }}</option>
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
                                        <input id="startDate" name="startDate" type="text" class="form-control"
                                            data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                            data-mask>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stauts</label>
                                    <select id="status" name="status" class="form-control">
                                        <option selected disabled>Select one</option>
                                        <option>pending</option>
                                        <option>registered</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer bg-white">
                        <button type="submit" class="btn btn-success float-right">Submit</button>
                    </div>
                </div>
            </form>
            <!-- /.card -->
        </div>
    </div>
</section>
<!-- /.content -->
@stop