@extends('layouts.second')

@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <button type="button" id="createPdftsd" class="btn btn-success mt-5"> Generate PDF</button>
            <!-- Main row -->
            <div class="row my-5 tsd">
                <section class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="">Class Schedulle</h3>
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
                                        <th>Payment</th>
                                        <th>Class Mode</th>
                                        <th>Class Duration</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $billingTeacher as $billingRecord)
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
                                                {{ $billingRecord->teacherPayment }}
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

