@extends('layouts.second')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <button type="button" id="createPdfssd" class="btn btn-success mt-5"> Generate PDF</button>
            <!-- Main row -->
            <div class="row my-5 py-5 ssd">
                <section class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="">Class Schedule</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if( $billingRecords->count() > 0)
                                <table id="history" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Class Date</th>
                                        <th>Class Time</th>
                                        <th>Teacher Name</th>
                                        <th>Subject</th>
                                         <th>Payment</th>
                                        <th>Class Mode</th>
                                        <th>Class Duration</th>
                                        <th>Attendance</th>
                                        <th>Class Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $billingRecords as $billingRecord)
                                        <input type="hidden" value="{{ $billingRecord->billId }}">
                                        <tr>
                                            <td class="align-middle">
                                                {{ $billingRecord->studentName }}
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
                                                {{ $billingRecord->teacherName }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $billingRecord->subject }}
                                            </td>
                                            
                                             <td class="align-middle">
                                                {{ $billingRecord->payment }}
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
                                                @if( $billingRecord->classStatus == 'cancel')
                                                    <span class="badge badge-danger badge-pill">Cancelled</span>
                                                @else
                                                    <span class="badge badge-success badge-pill">Active</span>
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
