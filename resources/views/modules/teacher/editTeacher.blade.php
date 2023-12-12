@extends('layouts.main')

@section('title', 'Edit Teacher Profile')

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
            <form action="{{URL::to('/updateTeacher')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="handledBy" value="{{ Auth::user()->name }}">
                <div class="card card-primary">
                    <div class="card-header border border-warning"
                        style="background-color: #ff9900; border-radius: 7px;">
                        <h3 class="text-center text-white">Edit Teacher</h3>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Current Pic</label>
                                    <br>
                                    <img src="{{asset('public/assets/uploads/teacherImages/'.$teacher->image) }}"
                                        alt="Student Image" class="col-3 my-2">
                                    <br>
                                    <label for="teacherPic">if you want to change than select new</label>
                                    <div class="custom-file">
                                        <input type="file" name="teacherPic"
                                            value="{{asset('public/assets/uploads/teacherImages/'.$teacher->image) }}"
                                            class="custom-file-input" id="studentPic">
                                        <label class="custom-file-label" for="teacherPic">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $teacher->id }}" id="id" class="form-control">
                            <input type="hidden" name="teacherId" value="{{ $teacher->teacherId }}" id="teacherId"
                                class="form-control">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="studentName">Teacher Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" name="teacherName" value="{{ $teacher->teacherName }}"
                                            id="teacherName" class="form-control" placeholder="Full Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fatherName">Passport / N.I.C</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">#</span>
                                        </div>
                                        <input type="text" name="nicNumber" value="{{ $teacher->nicNumber }}"
                                            id="nicNumber" class="form-control" placeholder="Number">
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
                                        <input id="dob" name="dob" type="text" value="{{ $teacher->DoB }}"
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
                                        <input id="phoneNumber" name="phoneNumber" value="{{ $teacher->phoneNumber }}"
                                            type="text" class="form-control" data-inputmask='"mask": "9999-9999999"'
                                            data-mask>
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
                                        <input type="email" name="email" value="{{ $teacher->Email }}" id="email"
                                            class="form-control" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Home Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <input type="text" name="homeAddress" value="{{ $teacher->homeAddress }}"
                                            id="homeAddress" class="form-control" placeholder="Address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Teacher Rating</label>
                                    <select class="form-control" name="rating" data-placeholder="Select Rating"
                                        style="width: 100%;">
                                        <option selected value="{{$teacher->rating}}">{{$teacher->rating}}</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="techerCV">Upload CV (PDF, doc, docx)</label>
                                    <div class="custom-file">
                                        <input type="file" name="techerCV"
                                            value="{{asset('public/assets/uploads/teacherCVs/'.$teacher->cv) }}"
                                            class="custom-file-input" id="techerCV">
                                        <label class="custom-file-label" for="techerCV">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="educQualification">Education Qualification</label>
                                    <input type="text" name="educQualification"
                                        value="{{ $teacher->educationQualification }}" id="educQualification"
                                        class="form-control" placeholder="Education Qualification">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Experience">Teaching Experience</label>
                                    <input type="text" name="experience" value="{{ $teacher->experience }}"
                                        id="experience" class="form-control" placeholder="Teaching Experience">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Subjects ( type and add new if you don't see yours)</label>
                                    <select class="selectSubjects" name="subjects[]" multiple="multiple"
                                        data-placeholder="Select Subjects" style="width: 100%;">
                                        @foreach($uniqueSubjects as $subject2)
                                        <option value="{{ $subject2 }}"
                                            {{ (in_array($subject2, $separatedSubjects)) ? 'selected' : '' }}>
                                            {{ ucfirst(trans($subject2)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Level of Teaching ( type and add new if you don't see yours)</label>
                                    <select class="selectSubjects" name="teachingLevel[]" multiple="multiple"
                                        data-placeholder="Select Classes" style="width: 100%;">
                                        @foreach($uniqueLevels as $level)
                                        <option value="{{ $level }}"
                                            {{ (in_array($level, $separatedLevels)) ? 'selected' : '' }}>
                                            {{ ucfirst(trans($level)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Add Availability for atleast a week (type your timings like : 9am to
                                        10am)</label>
                                    <select class="availability" name="availability[]" multiple="multiple"
                                        data-placeholder="Add Availability" style="width: 100%;">
                                        @foreach($separatedAvailability as $availability)
                                        <option value="{{ $availability }}"
                                            {{ (in_array($availability, $separatedAvailability)) ? 'selected' : '' }}>
                                            {{ ucfirst(trans($availability)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Name of Cities where you can teach Physically ( type and add new if
                                        you don't see yours) or Type N/A</label>
                                    <select class="availability" name="cities[]" multiple="multiple"
                                        data-placeholder="Add Cities" style="width: 100%;">
                                        @foreach($uniqueCities as $cities)
                                        <option value="{{ $cities }}"
                                            {{ (in_array($cities, $separatedCities)) ? 'selected' : '' }}>
                                            {{ ucfirst(trans($cities)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="BIO">Add BIO</label>
                                    <textarea id="BIO" name="bio" class="form-control"
                                        spellcheck="false">{{ $teacher->bio }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="paymentInfo">Payment Details</label>
                                    <textarea id="paymentInfo" type="text" id="paymentInfo" name="paymentInfo" rows="4"
                                        class="form-control"
                                        placeholder="Bank Name[ UBL ] : Number [020202020] , Branch Code: 0000 , EasyPaisa / Jazzcash : [ 0000-000000 ]">{{ $teacher->paymentInfo }}</textarea>
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