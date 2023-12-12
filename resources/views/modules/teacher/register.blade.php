@extends('layouts.second')

@section('title', 'Teacher Registration')

@section('content')
<!-- Main content -->
<section class="content py-5 px-3">
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
            <form action="{{URL::to('/storeTeacher')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header"
                    style="background-color: #ffc266; border-top-right-radius: 5px; border-top-left-radius: 5px">
                    <h3 class="card-title font-weight-bold text-white">Add Teacher Profile Note:</h3>
                </div>
                <div class="bg-info p-3" style="border-bottom-right-radius: 5px; border-bottom-left-radius: 5px">
                    <p>1.Please fill out all required fields indicated with an asterisk (*) to ensure we have all the
                        necessary information.</p>
                    <p>2.Be sure to provide accurate contact information so we can reach you if needed.</p>
                    <p>3.Use clear and concise language when filling out the form, and avoid using abbreviations or
                        acronyms that others may not understand.</p>
                    <p>4.If you have any questions or concerns about the form, please don't hesitate to reach out to us
                        for assistance.</p>
                    <p>5.Double-check your responses before submitting the form to ensure that all information provided
                        is accurate and complete.</p>
                    <p>6.By submitting this form, you acknowledge that all information provided is true and accurate to
                        the best of your knowledge.</p>
                    <p>7.Thank you for taking the time to fill out this form. We appreciate your interest in joining
                        our team as a teacher!</p>
                    <p>8.Once your application has been processed, we will inform you of your teaching schedule via
                        email. Please ensure that you provide us with accurate contact information and check your email
                        regularly to ensure that you receive any updates or changes to your schedule.</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="teacherPic">Upload Picture (PNG, JPG, JPEG) *</label>
                                <div class="custom-file">
                                    <input type="file" name="teacherPic" class="custom-file-input" id="teacherPic">
                                    <label class="custom-file-label" for="teacherPic">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="studentName">Teacher Name *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    <input type="text" name="teacherName" id="teacherName" class="form-control"
                                        placeholder="Full Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fatherName">Passport / I.C *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">#</span>
                                    </div>
                                    <input type="text" name="nicNumber" id="nicNumber" class="form-control"
                                        placeholder="e.g SH61872987 / 150612-12-5129">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date of Birth *</label>

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
                                <label>Phone Number *</label>
                                <div class="input-group">
                                    <input id="phoneNumber" name="phoneNumber" type="text" class="form-control w-100"
                                        data-inputmask='"mask": "9999-9999999"' data-mask>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email Address *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="yourname@domain.com">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Home Address *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                    </div>
                                    <input type="text" name="homeAddress" id="homeAddress" class="form-control"
                                        placeholder="Address">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="techerCV">Upload CV (PDF, doc, docx) *</label>
                                <div class="custom-file">
                                    <input type="file" name="techerCV" class="custom-file-input" id="techerCV">
                                    <label class="custom-file-label" for="techerCV">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edQualification">Education Qualification *</label>
                                <input type="text" name="edQualification" id="edQualification" class="form-control"
                                    placeholder="Education Qualification">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Experience">Teaching Experience *</label>
                                <input type="text" name="experience" id="experience" class="form-control"
                                    placeholder="Teaching Experience">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Subjects ( Type & Add New If You Don't See Yours ) *</label>
                                <select class="selectSubjects" name="subjects[]" multiple="multiple"
                                    data-placeholder="Select Subjects" style="width: 100%;">
                                    @foreach( $allSubjects as $subjects)
                                    <option name="{{ ucfirst(trans($subjects->subjectName)) }}}">
                                        {{ ucfirst(trans($subjects->subjectName)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Level of Teaching ( Type & Add New If You Don't See Yours ) *</label>
                                <select class="selectSubjects" name="teachingLevel[]" multiple="multiple"
                                    data-placeholder="Select Classes" style="width: 100%;">
                                    @foreach( $allClassLevels as $levels)
                                    <option name="{{$levels->classLevel}}">{{$levels->classLevel}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Add Availability for atleast a Week ( Type Your Timings Like : 9am to 10pm )
                                    *</label>
                                <select class="availability" name="availability[]" multiple="multiple"
                                    data-placeholder="Add Availability" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Name of Cities where you can teach Physically ( Type & Add New If You
                                    Don't See Yours ) Or Select ( N/A ) If Not Available *</label>
                                <select class="selectSubjects" name="cities[]" multiple="multiple"
                                    data-placeholder="Select Cities" style="width: 100%;">
                                    <option selected>N/A</option>
                                    @foreach( $allCities as $cities)
                                    <option name="{{$cities->cityName}}">{{$cities->cityName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="BIO">Add BIO ( Min 20 : Max 255 Character ) *</label>
                                <textarea id="BIO" name="bio" class="form-control" rows="4" spellcheck="false"
                                    Placeholder="With a deep love for [Your Subject], [Your Name] has dedicated their career to teaching [Your Subject] to [Grade Level/Student Type]."></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="paymentInfo">Payment Details *</label>
                                <textarea id="paymentInfo" type="text" id="paymentInfo" name="paymentInfo" rows="4"
                                    class="form-control"
                                    placeholder="Bank Name[ CIMB ] : Number [020202020] , Swift Code: 0000 "></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-white">
                    <button type="submit" class="btn btn-success float-right">Submit</button>
                </div>
            </form>
            <!-- /.card -->
        </div>
    </div>
</section>
<!-- /.content -->
@stop