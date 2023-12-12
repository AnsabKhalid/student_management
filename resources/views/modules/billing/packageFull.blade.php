@extends('layouts.main')

@section('content')
    
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Package Details</h3>
                            <div class="float-right">
                                <a href="{{ URL::to('/editPackage', [$package->first()->first()->pkgId]) }}" class="btn btn-success">Edit <i class="fa fa-edit"></i></a>
                                @if (Auth::user()->role_id == 1)
                                <a href="#" class="btn btn-danger m-1" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{$package->first()->first()->pkgId}}" data-url="{{URL::to('/deletePackage/')}}">Delete <i class="fa fa-trash"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body row">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>No of Classes</th>
                                    <th>Duration</th>
                                    <th>Payment</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($package as $group)
                                    @foreach($group as $index => $single)
                                        <tr>
                                            <td>{{ $single->subject }}</td>
                                            <td>{{ $single->noOfClasses }}</td>
                                            <td>{{ $single->classDuration }}</td>
                                            <td>{{ $single->payment }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Amount</h3>
                        </div>
                        <div class="card-body">
                            @if( $billingRecords->count() > 0)
                                <div class="row">
                                    @if( $credit > 0)
                                        <div class="col-3">
                                            <div class="small-box bg-warning p-2">
                                                <h5 class="py-3 ml-2">Credit</h5>
                                                <h1 class="text-center py-2">{{ $credit }}</h1>
                                            </div>
                                            <a href="{{URL::to('/clearCredit/'.$billingStudent->studentId)}}" class="btn btn-success">Clear Credit</a>
                                        </div>
                                    @endif
                                    <div class="col-3">
                                        <div class="small-box bg-gradient-danger p-2">
                                            <h5 class="py-3 ml-2">Pending</h5>
                                            <h1 class="text-center py-2">{{ $unpaid }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="small-box bg-success p-2">
                                            <h5 class="py-3 ml-2">Paid</h5>
                                            <h1 class="text-center py-2">{{ $paid }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="small-box bg-primary p-2">
                                            <h5 class="py-3 ml-2">Total</h5>
                                            <h1 class="text-center py-2">{{ $total }}</h1>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="text-center"> No Records Yet!</p>
                            @endif
                        </div>
                    </div>
                </div>

                <section class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Schedule and Billing of {{ ucfirst(trans($billingStudent->studentName)) }}</h3>
                            <button id="add-more" class="btn btn-success float-right">Add More</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body w-100">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ session('error') }}</li>
                                    </ul>
                                </div>
                            @endif
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <form action="{{ URL::to('/createSchedule') }}" method="POST">
                                <input type="hidden" name="packageId" value="{{$package->first()->first()->pkgId }}">
                                <input type="hidden" name="studentId" value="{{ $billingStudent->studentId }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="studentName">Student Name</label>
                                            <input type="text" name="studentName" value="{{ $billingStudent->studentName }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                @csrf
                                <div id="form-container">
                                    <div class="form-row">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="classDate[]">Class Date ( click on icon )</label>
                                                    <input type="date" name="classDate[]" inputmode="numeric" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="classTime[]">Class Time</label>
                                                    <input type="time" name="classTime[]" inputmode="numeric" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="payment[]">Payment</label>
                                                    <input type="number" name="payment[]" inputmode="numeric" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="teacherName[]">Teacher Name</label>
                                                    <select class="form-control custom-select" name="teacherName[]" data-placeholder="Select Teacher" style="width: 100%;">
                                                        <option disabled selected>Select Teacher</option>
                                                        @foreach( $allTeachers as $index => $teachers)
                                                            <option value="{{ $teachers->teacherId }}|{{ $teachers->teacherName }}" id="teacherName_{{ $index }}">{{ $teachers->teacherName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="subject[]">Subject</label>
                                                    <select class="form-control custom-select" name="subject[]" ata-placeholder="Select Teacher" style="width: 100%;">
                                                        <option disabled selected>Select Subject</option>
                                                        @foreach( $separatedSubjects as $index => $subject)
                                                            <option value="{{ ucfirst(trans($subject)) }}" id="subject_{{ $index }}">{{ ucfirst(trans($subject)) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="teacherPayment[]">Teacher Payment</label>
                                                    <input type="number" name="teacherPayment[]" inputmode="numeric" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="modeOfClass[]">Class Mode</label>
                                                    <select id="modeOfClass" name="modeOfClass[]" class="form-control custom-select">
                                                        <option disabled>Select one</option>
                                                        <option value="Online">Online</option>
                                                        <option value="Centre">Centre</option>
                                                        <option value="Home">Home</option>
                                                        <option value="Group">Group</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="classDuration[]">Class Duration</label>
                                                    <select id="classDuration" name="classDuration[]" class="form-control custom-select">
                                                        <option disabled>Select one</option>
                                                        <option value="30 Minutes">30 Minutes</option>
                                                        <option value="60 Minutes">60 Minutes</option>
                                                        <option value="90 Minutes">90 Minutes</option>
                                                        <option value="120 Minutes">120 Minutes</option>
                                                        <option value="150 Minutes">150 Minutes</option>
                                                        <option value="180 Minutes">180 Minutes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="status[]">Payment Status</label>
                                                    <select class="form-control" name="status[]">
                                                        <option selected value="pending">pending</option>
                                                        <option value="paid">Paid</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="message[]">Message</label>
                                                    <textarea name="message[]" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="" class="btn btn-success float-right">Submit</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="recurring">
                                    <label class="form-check-label" for="recurring">Recurring Classes</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body recurringForm d-none">
                            <form action="{{ URL::to('/recurringClasses') }}" method="POST">
                                @csrf
                                <input type="hidden" name="packageId" value="{{ $package->first()->first()->pkgId }}">
                                <input type="hidden" name="studentId" value="{{ $billingStudent->studentId }}">
                                <input type="hidden" name="studentName" value="{{ $billingStudent->studentName }}" class="form-control" readonly>
                                <div class="row mb-5">
                                    <div class="col-2">
                                        <h4>Recurrence :</h4>
                                    </div>
                                    <div class="col-10">
                                        <div class="form-group">
                                            <select id="recurrence" name="recurrence" class="form-control ml-5 col-4 custom-select">
                                                <option selected value="Daily">Daily</option>
                                                <option value="Weekly">Weekly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="weekly" class="row d-none">
                                    <div class="col-2">
                                        <h4>Repeat every: </h4>
                                    </div>
                                    <div class="col-10 d-flex justify-content-around align-items-center">
                                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <div>
                                            <input type="checkbox" name="days[]" class="form-check-input" id="{{ $day }}" value="{{ $day }}">
                                            <label for="{{ $day }}">{{ ucfirst($day) }}</label>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                                <div class="row my-5">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="classDateFrom">Class Date From ( click on icon )</label>
                                            <input type="date" name="classDateFrom" inputmode="numeric" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="classDateTill">Class Date Till ( click on icon )</label>
                                            <input type="date" name="classDateTill" inputmode="numeric" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="classTime">Class Time</label>
                                            <input type="time" name="classTime" inputmode="numeric" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="payment">Payment</label>
                                            <input type="number" name="payment" inputmode="numeric" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="teacherName">Teacher Name</label>
                                            <select class="form-control custom-select" name="teacherName" data-placeholder="Select Teacher" style="width: 100%;">
                                                <option disabled selected>Select Teacher</option>
                                                @foreach( $allTeachers as $index => $teachers)
                                                    <option value="{{ $teachers->teacherId }}|{{ $teachers->teacherName }}" id="teacherName_{{ $index }}">{{ $teachers->teacherName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="subject">Subject</label>
                                            <select class="form-control custom-select" name="subject" ata-placeholder="Select Teacher" style="width: 100%;">
                                                <option disabled selected>Select Subject</option>
                                                @foreach( $separatedSubjects as $index => $subject)
                                                    <option value="{{ ucfirst(trans($subject)) }}" id="subject_{{ $index }}">{{ ucfirst(trans($subject)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="teacherPayment">Teacher Payment</label>
                                            <input type="number" name="teacherPayment" inputmode="numeric" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="modeOfClass">Class Mode</label>
                                            <select id="modeOfClass" name="modeOfClass" class="form-control custom-select">
                                                <option disabled>Select one</option>
                                                <option value="Online">Online</option>
                                                <option value="Centre">Centre</option>
                                                <option value="Home">Home</option>
                                                <option value="Group">Group</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="classDuration">Class Duration</label>
                                            <select id="classDuration" name="classDuration" class="form-control custom-select">
                                                <option disabled>Select one</option>
                                                <option value="30 Minutes">30 Minutes</option>
                                                 <option value="60 Minutes">60 Minutes</option>
                                                <option value="90 Minutes">90 Minutes</option>
                                                <option value="120 Minutes">120 Minutes</option>
                                                <option value="150 Minutes">150 Minutes</option>
                                                <option value="180 Minutes">180 Minutes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Payment Status</label>
                                            <select class="form-control" name="status">
                                                <option selected value="pending">pending</option>
                                                <option value="paid">Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="message">Message</label>
                                            <textarea name="message" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success float-right">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="">Payment History</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if( $billingRecords->count() > 0)
                                <table id="" class="table table-bordered table-striped history">
                                    <thead>
                                    <tr>
                                        <th>Class Date & Time</th>
                                        <th>Student Name</th>
                                        <th>Payment</th>
                                        <th>Teacher Name</th>
                                        <th>Teacher Payment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $billingRecords as $billingRecord)
                                        <tr>
                                            <td class="align-middle">
                                                {{ date('d-M-y',strtotime($billingRecord->classDate)) }}
                                                <br>
                                                <hr>
                                                {{ date('h:i A',strtotime($billingRecord->classTime)) }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->studentName }}
                                            </td>

                                            <td class="align-middle">
                                                {{ $billingRecord->payment }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->teacherName }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->teacherPayment }}
                                            </td>
                                            <td class="align-middle">
                                                @if( $billingRecord->classStatus == 'active' && $billingRecord->status == 'pending')
                                                    <span class="badge badge-danger badge-pill">Pending</span>
                                                @elseif($billingRecord->classStatus == 'cancel')
                                                    <span class="badge badge-danger badge-pill">Cancelled</span>
                                                @else
                                                    <span class="badge badge-success badge-pill">Paid</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if($billingRecord->classStatus == 'active' && $billingRecord->status == 'pending')
                                                    <form action="{{ URL::to('/update-status') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="billId" value="{{ $billingRecord->billId }}">
                                                        <button type="submit" class="btn btn-success">
                                                            Paid
                                                        </button>
                                                    </form>
                                                @elseif($billingRecord->status == 'paid')
                                                    <span class="badge badge-success badge-pill">Paid</span>
                                                @else
                                                    <span class="badge badge-danger badge-pill">Cancelled</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center"> No Records Yet!</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Class Schedule and History</h3>
                            @if ($billingRecords && isset($billingRecord->studentId) && $billingRecords->count() > 0)
                                <a href="{{ URL::to('/sendStudentSchedule/'.$billingRecord->studentId) }}" type="submit" class="btn btn-success float-right">
                                    Send Schedule
                                </a>
                            @else
                                <a href="" type="submit" class="btn btn-success float-right">
                                    Send Schedule
                                </a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if( $billingRecords->count() > 0)
                                <table id="" class="table table-bordered table-striped history">
                                    <thead>
                                    <tr>
                                        <th>Class Date</th>
                                        <th>Class Time</th>
                                        <th>Student Name</th>
                                        <th>Teacher Name</th>
                                        <th>Subject</th>
                                        <th>Class Mode</th>
                                        <th>Class Duration</th>
                                        <th>Attendance</th>
                                        <th>Class Remarks</th>
                                        <th>Updated By</th>
                                        <th>Class Status</th>
                                        <th>Review</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $billingRecords as $billingRecord)
                                        <input type="hidden" value="{{ $billingRecord->billId }}">
                                        <tr>
                                            <td class="align-middle">
                                                {{ date('d-M-y',strtotime($billingRecord->classDate)) }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->studentName }}
                                            </td>
                                            <td class="align-middle">
                                                From : {{ date('h:i A',strtotime($billingRecord->classTime)) }}
                                                <br>
                                                Till : {{ date('h:i A', strtotime($billingRecord->classTime . ' +' . $billingRecord->classDuration)) }}

                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->teacherName }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->subject }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->modeOfClass }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->classDuration }}
                                            </td>
                                            <td class="align-middle">
                                                @if( $billingRecord->classStatus == 'active' && $billingRecord->attendance == 'pending')
                                                    <span class="badge badge-danger badge-pill">Pending</span>
                                                @elseif($billingRecord->classStatus == 'cancel')
                                                    <span class="badge badge-danger badge-pill">Cancelled</span>
                                                @else
                                                    <span class="badge badge-success badge-pill">Done</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                {{ ucfirst($billingRecord->classRemarks) }}
                                            </td>
                                            <td class="align-middle">
                                                {{ ucfirst($billingRecord->updatedBy) }}
                                            </td>
                                            <td class="align-middle">
                                                @if( $billingRecord->classStatus == 'cancel')
                                                    <span class="badge badge-danger badge-pill">Cancelled</span>
                                                @else
                                                    <span class="badge badge-success badge-pill">Active</span>
                                                @endif
                                            </td>
                                            @php
                                                $billIdExistsStudent = false;
                                                $billIdExistsTeacher = false;
                                                foreach ($allReviews as $review) {
                                                     if ( $review->billId == $billingRecord->billId && $review->role == 'student') {
                                                          $billIdExistsStudent = true;
                                                     }
                                                     if ($review->billId == $billingRecord->billId && $review->role == 'teacher') {
                                                          $billIdExistsTeacher = true;
                                                     }
                                                }
                                            @endphp
                                            <td class="align-middle">
                                                @if($billIdExistsStudent == true)
                                                    <span class="badge badge-success badge-pill">Student Done</span>
                                                @elseif($billIdExistsStudent == false)
                                                    <span class="badge badge-danger badge-pill">Student Pending</span>
                                                @endif
                                                @if($billIdExistsTeacher == true)
                                                    <span class="badge badge-success badge-pill">Teacher Done</span>
                                                @elseif($billIdExistsTeacher == false)
                                                    <span class="badge badge-danger badge-pill">Teacher Pending</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if($billingRecord->classStatus == 'active')
                                                    <a href="{{ URL::to('/editBill/'.$billingRecord->id) }}" type="submit" class="btn btn-warning">
                                                        Edit <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                                <!--<a href="{{ URL::to('/deleteBill/'.$billingRecord->id) }}" class="btn btn-danger">-->
                                                <!--    Delete-->
                                                <!--</a>-->
                                                <a href="#" class="btn btn-danger m-1" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{$billingRecord->id}}" data-url="{{URL::to('/deleteBill/')}}">Delete <i class="fa fa-trash"></i></a>
                                                @if($billIdExistsStudent == false && $billIdExistsTeacher == false && $billingRecord->classStatus == 'active')
                                                    <a href="{{ URL::to('/sendReview/'.$billingRecord->billId.'/both') }}" type="submit" class="btn btn-success m-1">
                                                        Send Review Both <i class="fa fa-star"></i>
                                                    </a>
                                                @else
                                                    @if($billIdExistsStudent == false && $billingRecord->classStatus == 'active')
                                                        <a href="{{ URL::to('/sendReview/'.$billingRecord->billId.'/student') }}" type="submit" class="btn btn-success m-1">
                                                            Send Review Student <i class="fa fa-star"></i>
                                                        </a>
                                                    @endif
                                                    @if($billIdExistsTeacher == false && $billingRecord->classStatus == 'active')
                                                        <a href="{{ URL::to('/sendReview/'.$billingRecord->billId.'/teacher') }}" type="submit" class="btn btn-success m-1">
                                                            Send Review Teacher <i class="fa fa-star"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center"> No Records Yet!</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </section>

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
