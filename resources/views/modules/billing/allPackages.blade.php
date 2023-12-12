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

                <section class="col-lg-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="">All Packages of <b>{{ $student->studentName }}</b></h3>
                            <hr>
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-package">
                                    Add New Package</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="SnB" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Package Id</th>
                                    <th>Package Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($allPackages as $pkgId => $packages)
                                    @php
                                        $firstPackage = $packages->first();
                                    @endphp
                                    @if ($firstPackage)
                                        <tr>
                                            <td class="align-middle">{{ $pkgId }}</td>
                                            <td class="align-middle">{{ $firstPackage->name }}</td>
                                            <td class="align-middle">
                                                <a href="{{ URL::to('/packageDetails', ['id' => $pkgId, 'studentId' => $student->studentId]) }}" class="btn btn-info">View <i class="fa fa-eye"></i></a>
                                                <a href="{{ URL::to('/editPackage/'.$pkgId) }}" class="btn btn-success">Edit <i class="fa fa-edit"></i></a>
                                                @if (Auth::user()->role_id == 1)
                                                <a href="#" class="btn btn-danger m-1" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $pkgId }}" data-url="{{ URL::to('/deletePackage/'.$student->studentId) }}">Delete <i class="fa fa-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- /.card -->
                </section>

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modal-package" tabindex="-1" role="dialog" aria-labelledby="modal-package-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-package-label">Add New Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ URL::to('/createPackage') }}" method="POST">
                        @csrf
                        <input type="hidden" name="studentId" value="{{ $student->studentId }}" readonly>
                        <div class="form-group">
                            <label for="name">Package Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter package name" required>
                        </div>
                        <div id="form-container">
                            <div class="form-row"style="border-bottom: 2px solid blue;">
                                <div class="form-group col-12">
                                    <label for="subject[]">Subject</label>
                                    <select class="form-control" id="subject" name="subject[]" required>
                                        <option value="">Select subject</option>
                                        @foreach($separatedSubjects as $subject)
                                            <option value="{{ $subject }}">{{ $subject }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="noOfClasses[]">Number of Classes</label>
                                    <input type="number" class="form-control" id="noOfClasses" name="noOfClasses[]" placeholder="Enter number of classes" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="classDuration[]">Duration of Classes</label>
                                    <select id="classDuration" name="classDuration[]" class="form-control custom-select" required>
                                        <option selected disabled>Select one</option>
                                        <option value="30 Minutes">30 Minutes</option>
                                        <option value="60 Minutes">60 Minutes</option>
                                        <option value="90 Minutes">90 Minutes</option>
                                        <option value="120 Minutes">120 Minutes</option>
                                        <option value="150 Minutes">150 Minutes</option>
                                        <option value="180 Minutes">180 Minutes</option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="payment[]">Payment</label>
                                    <input type="text" class="form-control" id="payment" name="payment[]" placeholder="Enter payment" required>
                                </div>
                            </div>
                        </div>
                        
                        <button id="addMorePkg" type="submit" class="btn btn-info float-left">Add More</button>
                        <button type="submit" class="btn btn-success float-right">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
