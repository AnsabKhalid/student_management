@extends('layouts.main')

@section('title', 'Payment Report Directory')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #ff9900;">
                        <div class="d-flex justify-content-center">
                            <h3 class="text-white pt-2 font-weight-bold">Form</h3>
                        </div>
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
                    </div>
                    <div class="card-body">
                        <form action="{{URL::to('/storeRegister')}}" method="POST" class="form-group">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <label>Select Student</label>
                                    <select class="form-control" name="student">
                                        <option disabled>Select Student</option>
                                        @foreach( $allStudents as $students)
                                        <option value="{{$students->studentId}}|{{$students->studentName}}">
                                            {{$students->studentName}}</option>{{$students->studentName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Payment Paid</label>
                                    <input type="number" name="paymentPaid" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label>Registration Fee</label>
                                    <input type="number" name="regFee" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label>Total Sessions</label>
                                    <input type="number" name="sessions" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label>Payment Date</label>
                                    <input type="date" name="paymentDate" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label>Enter Remark</label>
                                    <input type="text" name="paymentTime" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label for="paymentType">Payment Type</label>
                                    <select id="paymentType" name="paymentType" class="form-control custom-select">
                                        <option selected disabled>Select one</option>
                                        <option>HSBC</option>
                                        <option>PBB</option>
                                        <option>PBB CC</option>
                                        <option>STRIPE</option>
                                        <option>PETTY CASH</option>
                                    </select>
                                </div>
                                <input type="hidden" name="handledBy" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="mt-4 mb-2 float-right">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main row -->

    <div class="row px-2">
        <section class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                    </h3>
                </div>
                <div class="card-body" id="print-me">
                    <div class="row">
                        <div class="col-md-2 col-sm-3">
                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                aria-orientation="vertical">
                                @foreach( $registrations as $month => $registrationsInMonth )
                                <a class="nav-link @if ($loop->first) active show @endif"
                                    id="vert-tabs-{{ $month }}-tab" data-toggle="pill"
                                    href="#{{ str_replace(' ', '', strtolower($month)) }}" role="tab"
                                    aria-controls="vert-tabs-{{ $month }}" aria-selected="false">{{ $month }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-9">
                            <div class="tab-content" id="vert-tabs-tabContent">
                                @foreach( $registrations as $month => $registrationsInMonth )
                                @php
                                $sum = 0;
                                @endphp
                                <div class="tab-pane fade @if ($loop->first) active show @endif"
                                    id="{{ str_replace(' ', '', strtolower($month)) }}" role="tabpanel"
                                    aria-labelledby="vert-tabs-{{ $month }}-tab">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            @if(!empty($registrations))
                                            <table id="" class="table table-bordered table-striped monthly">
                                                <thead>
                                                    <tr>
                                                        <th>Student Name</th>
                                                        <th>Payment Paid</th>
                                                        <th>Registration Fee</th>
                                                        <th>Total Sessions</th>
                                                        <th>Payment Date</th>
                                                        <th>Remark</th>
                                                        <th>Payment Type</th>
                                                        <th>Handled By</th>
                                                        @if (Auth::user()->role_id == 1)
                                                        <th>Action</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($registrationsInMonth as $registration)
                                                    <tr>
                                                        <td class="align-middle">
                                                            {{ $registration->studentName }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{$registration->paymentPaid}}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ $registration->regFee }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ $registration->totalSessions }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ date('d-M-y',strtotime($registration->paymentDate)) }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ $registration->paymentTime }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ $registration->paymentType }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ $registration->handledBy }}
                                                        </td>
                                                        @if (Auth::user()->role_id == 1)
                                                        <td class="align-middle">
                                                            <!--<a href="{{URL::to('/deleteRecord/'. $registration->id)}}" class="btn btn-danger"> Delete</a>-->
                                                            <a href="#" class="btn btn-danger m-1" data-toggle="modal"
                                                                data-target="#confirmDeleteModal"
                                                                data-id="{{$registration->id}}"
                                                                data-url="{{URL::to('/deleteRecord/')}}">Delete <i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    @php
                                                    $sum += $registration->paymentPaid
                                                    @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="d-flex align-items-center col-3 bg-blue my-3 py-2 px-5 rounded">
                                                <h5 class="my-0">Total Payment Paid : {{$sum}}</h5>
                                            </div>
                                            @else
                                            <p class="text-center"> No Records Yet!</p>
                                            @endif
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>

    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection