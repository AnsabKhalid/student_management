@extends('layouts.second')

@section('title', 'Student Registration')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12 px-md-5 px-4 py-5">
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
                <div class="card-header"
                    style="background-color: #ffc266; border-top-right-radius: 5px; border-top-left-radius: 5px">
                    <h3 class="card-title font-weight-bold text-white">Add Student Profile Note:</h3>
                </div>
                <div class="bg-info px-4 py-3" style="border-bottom-right-radius: 5px; border-bottom-left-radius: 5px">
                    <p>1. Privacy Policy: We are committed to protecting your personal information and will only
                        use it for the purposes of academic and administrative support.We
                        will not share your information with any third-party organizations without your consent.
                    </p>
                    <p>2. Academic Integrity: We expect all students to uphold the highest standards of academic
                        integrity.Any form of plagiarism, cheating, or academic misconduct
                        will not be tolerated.</p>
                    <p>3. Attendance Policy: Regular attendance is essential for academic success.Students are expected
                        to attend all classes and arrive on time.Absences due to illness or emergency should be reported
                        to the appropriate
                        faculty member or the school administration.
                    </p>
                    <p>4. Grading Policy: Grades will be based on a variety of assessments, including tests,
                        quizzes, assignments, and class participation.Students are expected
                        to complete all assignments on time and to the best of their ability.</p>
                    <p>5. Code of Conduct: We expect all students to behave in a respectful and responsible manner
                        at all times.Any form of harassment, discrimination, or disruptive
                        behavior will not be tolerated.</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="studentPic">Upload Picture *</label>
                                <div class="custom-file">
                                    <input type="file" name="studentPic" class="custom-file-input" id="studentPic">
                                    <label class="custom-file-label" for="studentPic">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="studentName">Student Name *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    <input type="text" name="studentName" id="studentName" class="form-control"
                                        placeholder="Full Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fatherName">Father Name *</label>
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
                                <label>Date Of Birth *</label>

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
                                    <input id="phoneNumber" name="phoneNumber" type="text" class="form-control"
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
                                    <input type="email" name="email" class="form-control" placeholder="Email">
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
                                    <input type="text" name="homeAddress" class="form-control" placeholder="Address">
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
                                    <input type="email" name="parentEmail" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Class Level (Type & Add New If You Don't See Yours)</label>
                                <select class="selectSubjects" name="classLevel[]" multiple="multiple"
                                    data-placeholder="Select Classes" style="width: 100%;">
                                    @foreach( $allClassLevels as $levels)
                                    <option name="{{$levels->classLevel}}">{{$levels->classLevel}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="classDuration">Class Duration *</label>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="classMode">Mode of Class *</label>
                                <select id="classMode" name="classMode" class="form-control custom-select">
                                    <option selected disabled>Select one</option>
                                    <option>Online</option>
                                    <option>Centre</option>
                                    <option>Home</option>
                                    <option>Group</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Subjects *</label>
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
                                <label>Earliest Start Date *</label>

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
                        <input type="hidden" name="status" value="pending">
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