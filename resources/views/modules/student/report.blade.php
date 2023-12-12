@extends('layouts.main')

@section('title', 'Student Monthly Report')

@section('content')
<!-- Main content -->
<section class="content mx-4">
    <div class="d-flex justify-content-end mb-4 mr-3">
        <button type="button" id="create_pdf" class="btn btn-success">Generate PDF</button>
    </div>
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row px-2 print">
            <section class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Monthly Report
                        </h3>
                    </div>
                    <div class="card-body" id="print-me">
                        <div class="row">
                            <div class="col-md-2 col-sm-3">
                                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
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
                            <div class="col-md-10 col-sm-9">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    @foreach ($groupedData as $monthYear => $data)
                                    <div class="tab-pane fade @if ($loop->first) active show @endif"
                                        id="{{ str_replace(' ', '', strtolower($monthYear)) }}" role="tabpanel"
                                        aria-labelledby="vert-tabs-{{ $monthYear }}-tab">
                                        <div class="table-responsive mb-4">
                                            <table id="" class="table table-bordered monthly" style="width: 90vw;">
                                                <thead style="background-color: #e0ebeb">
                                                    <h4 class="text-center">{{ $monthYear }}</h4>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Total Attended Classes</th>
                                                        <th>Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            {{ $data['student']->studentName }}
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            {{ $data['classCount'] }}
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            {{$data['paymentSum'] }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" style="background-color: #ffc266;">
                                                <h3 class="text-white">Class History</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">

                                                @if( count($data['studentBillings']) > 0)
                                                <div class="table-responsive">
                                                    <table id="" class="table table-bordered history"
                                                        style="width: 90vw;">
                                                        <thead style="background-color: #e0ebeb">
                                                            <tr>
                                                                <th>Class Date</th>
                                                                <th>Class Time</th>
                                                                <th>Student Name</th>
                                                                <th>Teacher Name</th>
                                                                <th>Subject</th>
                                                                <th>Class Mode</th>
                                                                <th>Class Duration</th>
                                                                <th>Attendance</th>
                                                                <th>Remarks</th>
                                                                <th>class status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach( $data['studentBillings'] as $billingRecord)
                                                            <input type="hidden" value="{{ $billingRecord->billId }}">
                                                            <tr>
                                                                <td class="align-middle">
                                                                    {{ date('d-M-y',strtotime($billingRecord->classDate)) }}
                                                                </td>
                                                                <td class="align-middle">
                                                                    From :
                                                                    {{ date('h:i A',strtotime($billingRecord->classTime)) }}
                                                                    <br>
                                                                    Till :
                                                                    {{ date('h:i A', strtotime($billingRecord->classTime . ' +' . $billingRecord->classDuration)) }}

                                                                </td>
                                                                <td class="align-middle">
                                                                    {{ $billingRecord->studentName }}
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
                                                                    <span
                                                                        class="badge badge-danger badge-pill">Pending</span>
                                                                    @else
                                                                    <span
                                                                        class="badge badge-success badge-pill">Done</span>
                                                                    @endif
                                                                </td>
                                                                <td class="align-middle">
                                                                    {{ $billingRecord->classRemarks }}
                                                                </td>
                                                                <td class="align-middle">
                                                                    @if( $billingRecord->classStatus == 'cancel')
                                                                    <span
                                                                        class="badge badge-danger badge-pill">Cancel</span>
                                                                    @else
                                                                    <span
                                                                        class="badge badge-success badge-pill">Active</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
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