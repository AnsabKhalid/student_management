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
                            <h3>Amount</h3>
                        </div>
                        <div class="card-body">
                            @if( $billingTeacher->count() > 0)
                                <div class="row">
                                    <div class="col-4">
                                        <div class="small-box bg-gradient-danger p-2">
                                            <h5 class="py-3 ml-2">Pending</h5>
                                            <h1 class="text-center py-2">{{ $unpaid }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="small-box bg-success p-2">
                                            <h5 class="py-3 ml-2">Paid</h5>
                                            <h1 class="text-center py-2">{{ $paid }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-4">
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
                            <h3 class="">Schedule and Billing of {{ ucfirst(trans($teacherName)) }}</h3>
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
                        </div>
                        <!-- /.card-header -->
                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="">Payment History</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if( $billingTeacher->count() > 0)
                                <table id="history" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Class Date & Time</th>
                                        <th>Class Mode</th>
                                        <th>Payment</th>
                                        <th>Teacher Payment</th>
                                        <th>Admin Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $billingTeacher as $billingRecord)
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
                                                {{ $billingRecord->modeOfClass }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->payment }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->teacherPayment }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->payment - $billingRecord->teacherPayment }}
                                            </td>
                                            <td class="align-middle">
                                                @if( $billingRecord->status == 'pending')
                                                    <span class="badge badge-danger badge-pill">Pending</span>
                                                @else
                                                    <span class="badge badge-success badge-pill">Paid</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if( $billingRecord->status == 'pending')
                                                    <form action="{{ URL::to('/update-status') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="billId" value="{{ $billingRecord->billId }}">
                                                        <button type="submit" class="btn btn-success">
                                                            Paid
                                                        </button>
                                                    </form>
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
                            <h3 class="float-left">Class History</h3>
                            <a href="{{ URL::to('/sendSchedule/'.$billingRecord->teacherId) }}" type="submit" class="btn btn-success float-right">
                                Send Schedule
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if( $billingTeacher->count() > 0)
                                <table id="history" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Teacher Name</th>
                                        <th>Class Date</th>
                                        <th>Class Time</th>
                                        <th>Student Name</th>
                                        <th>Subject</th>
                                        <th>Class Mode</th>
                                        <th>Class Duration</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $billingTeacher as $billingRecord)
                                        @if($billingRecord->classStatus == 'active' )
                                        <tr>
                                            <td class="align-middle">
                                                {{ $billingRecord->teacherName }}
                                            </td>
                                            <td class="align-middle">
                                                {{ date('d-M-y',strtotime($billingRecord->classDate)) }}
                                            </td>
                                            <td class="align-middle">
                                                From : {{ date('h:i A',strtotime($billingRecord->classTime)) }}
                                                <br>
                                                Till : {{ date('h:i A', strtotime($billingRecord->classTime . ' +' . $billingRecord->classDuration)) }}

                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->studentName }}
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
                                                @if( $billingRecord->status == 'pending')
                                                    <span class="badge badge-danger badge-pill">Pending</span>
                                                @else
                                                    <span class="badge badge-success badge-pill">Paid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
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

