@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-sm-4">
                <!-- small box -->
                <div class="small-box bg-white" style="border-radius: 6px !important;">
                    <div class="inner">
                        <h3 class="text-info">{{  $allStudents->count() }}</h3>

                        <p class=" font-weight-bold text-info text-lg">Students</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker text-info"></i>
                    </div>
                    <a href="{{URL::to('/allStudents')}}"
                        class="small-box-footer bg-white border-top border-info text-bold"
                        style="color: #008ae6 !important;  border-bottom-left-radius: 6px !important; border-bottom-right-radius: 6px !important;">View
                        All <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-sm-4">
                <!-- small box -->
                <div class="small-box bg-white" style="border-radius: 6px !important;">
                    <div class="inner">
                        <h3 class="text-success">{{ $allTeachers->count() }}</h3>

                        <p class="font-weight-bold text-success text-lg">Teachers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people text-success"></i>
                    </div>
                    <a href="{{URL::to('/allTeachers')}}"
                        class="small-box-footer bg-white border-top border-success text-bold"
                        style="color: green !important;  border-bottom-left-radius: 6px !important; border-bottom-right-radius: 6px !important;">View
                        All <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- small box -->
                <div class="small-box bg-white" style="border-radius: 6px !important;">
                    <div class="inner">
                        <h3 class="text-warning">
                            @if (Auth::user()->role_id == 1)
                            {{ $todo }}
                            @elseif(Auth::user()->role_id == 2)
                            {{ $pendingCount }}
                            @endif
                        </h3>

                        <p class="font-weight-bold text-warning text-lg">To-Do</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fa fa-bullhorn text-warning"></i>
                    </div>
                    <a href="{{URL::to('/todo')}}" class="small-box-footer bg-white border-top border-warning text-bold"
                        style="color: #ffcc00 !important; border-bottom-left-radius: 6px !important; border-bottom-right-radius: 6px !important;">View
                        All <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-md-6 px-3 my-3">
                <div class="form-group">
                    <label>Student form Link</label>
                    <div class="input-group">
                        <input type="text" id="studentLink" class="form-control bg-white"
                            value="{{ URL::to('/registerStudent')}}" placeholder="/registerStudent" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-info" onclick="studentLinkCopy()"><i class="fa fa-user pr-2"></i>
                                Copy Link</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-3 my-3">
                <div class="form-group">
                    <label>Teacher form Link</label>
                    <div class="input-group">
                        <input type="text" id="teacherLink" class="form-control bg-white"
                            value="{{ URL::to('/registerTeacher') }}" placeholder="/registerTeacher" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-info" onclick="teacherLinkCopy()"><i
                                    class="fa fa-users pr-2"></i>Copy Link</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <section class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #ffc266;">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="text-white text-center font-weight-bold">Today's Classes</h3>
                        </div>
                    </div>
                    @if(session()->has('success'))
                    <div class="alert alert-success mx-5 px-5">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                </div>
                <!-- /.card-header -->

                <div class="col-md-12 mt-3">
                    <label for="classDate">Class Date ( click on icon )</label>
                    <form action="{{URL::to('/showClasses')}}" method="POST" id="myForm"
                        class="form-row d-flex align-items-center">
                        @csrf
                        <div class="form-group col-6">
                            <input id="classDateInput" type="date" name="classDate" inputmode="numeric"
                                class="form-control">
                        </div>
                        <div class="col-4 mb-3 d-flex">
                            <button type="submit" class="btn btn-success pl-3 d-flex">Show <i
                                    class="fa fa-eye pl-3 pt-1"></i></button>
                            <a href="{{URL::to('/')}}" class="btn btn-info pl-3 ml-3 d-flex">Reset <i
                                    class="fa fa-balance-scale pl-3 pt-1"></i></a>
                        </div>
                    </form>
                    <div class="col-12"></div>
                </div>
                <div class="card-body">
                    @if( $billingRecords->count() > 0)
                    <div class="table-responsive">
                        <table id="" class="table table-bordered history" style="width: 120vw">
                            <thead style="background-color: #e0ebeb">
                                <tr>
                                    <th>Student Name</th>
                                    <th>Class Date & Time</th>
                                    <th>Teacher Name</th>
                                    <th>Subject</th>
                                    <th>Class Mode</th>
                                    <th>Class Duration</th>
                                    <th>Attendance</th>
                                    <th>Payment Status</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $billingRecords as $billingRecord)
                                <tr>
                                    <td class="align-middle">
                                        {{ $billingRecord->studentName }}
                                    </td>
                                    <td class="align-middle">
                                        {{ date('d-M-y',strtotime($billingRecord->classDate)) }}
                                        <br>
                                        <hr>
                                        {{ date('h:i A',strtotime($billingRecord->classTime)) }}
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
                                        @if( $billingRecord->attendance == 'pending')
                                        <span class="badge badge-danger badge-pill py-2 px-4">Pending</span>
                                        @else
                                        <span class="badge badge-success badge-pill py-2 px-4">done</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if( $billingRecord->status == 'pending')
                                        <span class="badge badge-danger badge-pill py-2 px-4">Pending</span>
                                        @else
                                        <span class="badge badge-success badge-pill py-2 px-4">Paid</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        {{ $billingRecord->classRemarks }}
                                    </td>
                                    {{--                                            <td class="align-middle">--}}
                                    {{--                                                <a href="{{ URL::to('/alertForm/'.$billingRecord->studentId.'/'.$billingRecord->classTime.'/'.$billingRecord->teacherId) }}"
                                    type="submit" class="btn btn-info">--}}
                                    {{--                                                    send class alert--}}
                                    {{--                                                </a>--}}
                                    {{--                                            </td>--}}
                                    <!-- <td class="align-middle">
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
                                        @if($billIdExistsStudent == false && $billIdExistsTeacher == false &&
                                        $billingRecord->classStatus == 'active')
                                        <a href="{{ URL::to('/sendReview/'.$billingRecord->billId.'/both') }}"
                                            type="submit" class="btn btn-success m-1">
                                            Send Review Both <i class="fa fa-star"></i>
                                        </a>
                                        @else
                                        @if($billIdExistsStudent == false && $billingRecord->classStatus == 'active')
                                        <a href="{{ URL::to('/sendReview/'.$billingRecord->billId.'/student') }}"
                                            type="submit" class="btn btn-success m-1">
                                            Send Review Student <i class="fa fa-star"></i>
                                        </a>
                                        @endif
                                        @if($billIdExistsTeacher == false && $billingRecord->classStatus == 'active')
                                        <a href="{{ URL::to('/sendReview/'.$billingRecord->billId.'/teacher') }}"
                                            type="submit" class="btn btn-success m-1">
                                            Send Review Teacher <i class="fa fa-star"></i>
                                        </a>
                                        @endif
                                        @endif
                                        <a href="{{URL::to('/sendClassReminder/'.$billingRecord->billId)}}"
                                            type="submit" class="btn btn-info">
                                            Send Class Reminder <i class="fa fa-bell"></i>
                                        </a>
                                    </td> -->
                                    <td class="align-middle">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                data-toggle="dropdown">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                @php
                                                $billIdExistsStudent = false;
                                                $billIdExistsTeacher = false;
                                                foreach ($allReviews as $review) {
                                                if ($review->billId == $billingRecord->billId && $review->role ==
                                                'student') {
                                                $billIdExistsStudent = true;
                                                }
                                                if ($review->billId == $billingRecord->billId && $review->role ==
                                                'teacher') {
                                                $billIdExistsTeacher = true;
                                                }
                                                }
                                                @endphp
                                                @if ($billIdExistsStudent == false && $billIdExistsTeacher == false &&
                                                $billingRecord->classStatus == 'active')
                                                <a href="{{ URL::to('/sendReview/'.$billingRecord->billId.'/both') }}"
                                                    class="dropdown-item"> <i class="fa fa-star pr-2"></i>
                                                    Send Review Both
                                                </a>
                                                @else
                                                @if ($billIdExistsStudent == false && $billingRecord->classStatus ==
                                                'active')
                                                <a href="{{ URL::to('/sendReview/'.$billingRecord->billId.'/student') }}"
                                                    class="dropdown-item"> <i class="fa fa-star pr-2"></i>
                                                    Send Review Student
                                                </a>
                                                @endif
                                                @if ($billIdExistsTeacher == false && $billingRecord->classStatus ==
                                                'active')
                                                <a href="{{ URL::to('/sendReview/'.$billingRecord->billId.'/teacher') }}"
                                                    class="dropdown-item"> <i class="fa fa-star pr-2"></i>
                                                    Send Review Teacher
                                                </a>
                                                @endif
                                                @endif
                                                <a href="{{URL::to('/sendClassReminder/'.$billingRecord->billId)}}"
                                                    class="dropdown-item"> <i class="fa fa-bell pr-2"></i>
                                                    Send Class Reminder
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-center"> No Classes Today!</p>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
        </section>

        <div class="row">
            <section class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #ffc266;">
                        <h4 class="text-white font-weight-bold text-center">Remind students to
                            pay as they finish their last classes from the package.</h4>
                        @if(session()->has('success'))
                        <div class="alert alert-success mx-5 px-5">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered history" style="width: 100vw;">
                                <thead style="background-color: #e0ebeb">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Last Class Date & Time</th>
                                        <th>Teacher Name</th>
                                        <th>Subject</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $futureStudentIds as $futureStudents)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $futureStudents['studentName'] }}
                                        </td>
                                        <td class="align-middle">
                                            {{ date('d-M-y',strtotime($futureStudents['classDate'])) }}
                                            <br>
                                            <hr>
                                            {{ date('h:i A',strtotime($futureStudents['classTime'])) }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $futureStudents['teacherName'] }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $futureStudents['subject'] }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>

            <section class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #ffc266;">
                        <h4 class="text-white font-weight-bold text-center">Student those have not paid yet</h4>
                        @if(session()->has('success'))
                        <div class="alert alert-success mx-5 px-5">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered history" style="width: 100vw;">
                                <thead style="background-color: #e0ebeb">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Pending Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $pendingPayments as $student)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $student->studentName }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $student->total_payment }}
                                        </td class="align-middle">
                                        <td><a href="{{URL::to('/Billing/'. $student->studentId )}}"
                                                class="btn btn-info">Mark
                                                Paid<i class="fa fa-eye pl-3"></i></a></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
        </div>

        <section class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #ffc266;">
                    <h4 class="text-white font-weight-bold text-center">Student with Credit</h4>
                    @if(session()->has('success'))
                    <div class="alert alert-success mx-5 px-5">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-bordered history">
                            <thead style="background-color: #e0ebeb">
                                <tr>
                                    <th>Student Name</th>
                                    <th>Credit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $creditPayments as $student)
                                <tr>
                                    <td class="align-middle">
                                        {{ $student->studentName }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $student->total_payment }}
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/Billing/'. $student->studentId )}}"
                                            class="btn btn-info">View
                                            Credit <i class="fa fa-eye pl-2"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </section>

        <section class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #ffc266;">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-white font-weight-bold text-center">Last Paid Class of these Students</h4>
                        </div>
                    </div>
                    @if(session()->has('success'))
                    <div class="alert alert-success mx-5 px-5">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="col-md-12 mt-2">
                    <form action="{{URL::to('/showClasses2')}}" method="POST" id="myForm2"
                        class="form-row d-flex align-items-center">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="classDate">Class Date ( click on icon )</label>
                            <input id="classDateInput2" type="date" name="classDate" inputmode="numeric"
                                class="form-control">
                        </div>
                        <div class="col-md-3 mx-3 mt-3">
                            <button type="submit" class="btn btn-success mr-3">Show</button>
                            <a href="{{URL::to('/')}}" class="btn btn-info">Reset</a>
                        </div>
                    </form>
                    <div class="col-2">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-bordered history">
                            <thead style="background-color: #e0ebeb">
                                <tr>
                                    <th>Student Name</th>
                                    <th>Last Class</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $lastPaid as $student)
                                <tr>
                                    <td class="align-middle">
                                        {{ $student->studentName }}
                                    </td>
                                    <td class="align-middle">
                                        {{ date('d-M-y',strtotime($student->classDate)) }}
                                        <hr>
                                        {{ date('h:i-a',strtotime($student->classTime)) }}
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{URL::to('/Billing/'. $student->studentId )}}"
                                            class="btn btn-info">View
                                            Billing
                                            <i class="fa fa-eye"></i></a>
                                        <hr>
                                        <a href="{{ route('reminderEmail', $student->studentId) }}"
                                            class="btn btn-success">Reminder
                                            <i class="fa fa-user"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
        <section class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i>
                        Monthly Report
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-sm-3">
                            <div class="nav flex-column nav-tabs h-100 mb-5" id="vert-tabs-tab" role="tablist"
                                aria-orientation="vertical">
                                @foreach ($groupedData as $monthYear => $data)
                                <a class="nav-link @if ($loop->first) active show @endif"
                                    id="vert-tabs-{{ $monthYear }}-tab" data-toggle="pill"
                                    href="#{{ str_replace(' ', '', strtolower($monthYear)) }}" role="tab"
                                    aria-controls="vert-tabs-{{ $monthYear }}"
                                    aria-selected="false">{{ $monthYear }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-7 col-sm-9">
                            <div class="tab-content" id="vert-tabs-tabContent">
                                @foreach ($groupedData as $monthYear => $data)
                                <div class="tab-pane fade @if ($loop->first) active show @endif"
                                    id="{{ str_replace(' ', '', strtolower($monthYear)) }}" role="tabpanel"
                                    aria-labelledby="vert-tabs-{{ $monthYear }}-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- jQuery Knob -->
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">
                                                        <i class="far fa-chart-bar"></i>
                                                        Stats
                                                    </h3>

                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 col-md-3 text-center">
                                                            <input type="text text-dark" class="knob" readonly
                                                                data-max="{{ $allStudents->count() }}" data-min="0"
                                                                value="{{ $data['count'] }}" data-width="120"
                                                                data-height="120" data-fgColor="#17A2B8"
                                                                data-angleOffset=0 data-linecap=round>
                                                            <div class="knob-label"> New Students Inquiries</div>
                                                        </div>
                                                        <div class="col-12 col-sm-6 col-md-3 text-center">
                                                            <input type="text text-dark" class="knob" readonly
                                                                data-max="{{ $allTeachers->count() }}" data-min="0"
                                                                value="{{ $data['teacherCount'] }}" data-width="120"
                                                                data-height="120" data-fgColor="#28A745"
                                                                data-angleOffset=0 data-linecap=round>
                                                            <div class="knob-label"> New Teachers </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6 col-md-3 text-center">
                                                            <input type="text text-dark" class="knob" readonly
                                                                data-max="{{ $data['count'] }}" data-min="0"
                                                                value="{{ $data['inqCount'] }}" data-width="120"
                                                                data-height="120" data-fgColor="#FF051E"
                                                                data-angleOffset=0 data-linecap=round>
                                                            <div class="knob-label"> Pending Inquiries</div>
                                                        </div>
                                                        <div class="col-12 col-sm-6 col-md-3 text-center">
                                                            <input type="text text-dark" class="knob" readonly
                                                                data-max="{{ $data['count'] }}" data-min="0"
                                                                value="{{ $data['regCount'] }}" data-width="120"
                                                                data-height="120" data-fgColor="#28A745"
                                                                data-angleOffset=0 data-linecap=round>
                                                            <div class="knob-label"> Registered Students </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->

                                        </div>
                                        @if (Auth::user()->role_id == 1)
                                        <div class="col-12">
                                            <!-- PIE CHART -->
                                            <div class="card card-danger">
                                                <div class="card-header">
                                                    <h3 class="card-title">Pie Chart</h3>
                                                </div>
                                                <div class="card-body">
                                                    @php
                                                    if (isset($data['amount']))
                                                    {
                                                    $chartData = [
                                                    'labels' => [
                                                    'Pending',
                                                    'Paid',
                                                    'Teacher',
                                                    'Admin',
                                                    ],
                                                    'datasets' => [
                                                    [
                                                    'data' => [
                                                    $data['pending'],
                                                    $data['paid'],
                                                    $data['teacherPayment'],
                                                    $data['amount'] - $data['teacherPayment'],
                                                    ],
                                                    'backgroundColor' => ['#DE4554', '#17A2B8', '#007BFF',
                                                    '#FFC107'],
                                                    ],
                                                    ],
                                                    ];
                                                    $chartDataJson = json_encode($chartData);
                                                    }else{
                                                    break;
                                                    }
                                                    @endphp
                                                    <canvas id="pie-{{$loop->iteration}}"
                                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"
                                                        data-chart-data="{{ $chartDataJson }}"></canvas>
                                                    <h3 class="text-center mt-5">Total Amount :
                                                        {{ $data['amount'] }}</h3>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        @endif
                                        <!-- /.col -->
                                    </div>
                                    @if( $data['amount'] > 0 || $data['credit'] > 0)
                                    <div class="row">
                                        <div class="card col-12">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="far fa-chart-bar"></i>
                                                    Payments
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 col-md-3">
                                                        <div class="small-box bg-white border border-danger p-2">
                                                            <h5 class="py-3 ml-2 text-red font-weight-bolder">
                                                                Pending</h5>
                                                            <h1 class="text-center py-2">{{ $data['pending'] }}</h1>
                                                        </div>
                                                    </div>
                                                    @if (Auth::user()->role_id == 1)
                                                    <div class="col-12 col-sm-6 col-md-3">
                                                        <div class="small-box bg-white border border-success p-2">
                                                            <h5 class="py-3 ml-2 text-green font-weight-bolder">Paid
                                                            </h5>
                                                            <h1 class="text-center py-2">{{ $data['paid'] }}</h1>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-3">
                                                        <div class="small-box bg-white border border-primary p-2">
                                                            <h5 class="py-3 ml-2 text-blue font-weight-bolder">
                                                                Teachers Cut</h5>
                                                            <h1 class="text-center py-2">
                                                                {{ $data['teacherPayment'] }}</h1>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-3">
                                                        <div class="small-box bg-white border border-warning p-2">
                                                            <h5 class="py-3 ml-2 text-yellow font-weight-bolder">
                                                                Admin Cut</h5>
                                                            <h1 class="text-center py-2">
                                                                {{ $data['amount'] - $data['teacherPayment'] }}</h1>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-3">
                                                        <div class="small-box bg-white border border-secondary p-2">
                                                            <h5 class="py-3 ml-2 text-info font-weight-bolder">
                                                                Total</h5>
                                                            <h1 class="text-center py-2">{{ $data['amount'] }}</h1>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-3">
                                                        <div class="small-box bg-white border border-dark p-2">
                                                            <h5 class="py-3 ml-2 text-teal font-weight-bolder">
                                                                Credit</h5>
                                                            <h1 class="text-center py-2">{{ $data['credit'] }}</h1>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <p class="text-center"> No Records Yet!</p>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection