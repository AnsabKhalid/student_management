@extends('layouts.main')

@section('title', 'Teacher Monthly Report')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="col-md-12 d-flex justify-content-end mb-4">
        <button type="button" id="createPdfsmr" class="btn btn-success mb-4">Generate
            PDF</button>
    </div>
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row px-2 printReporttmr">
            <section class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-edit"></i>
                            Teachers Monthly Report
                        </h3>
                    </div>
                    <div class="card-body" id="print-me">
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
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
                            <div class="col-md-10 col-sm-10">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    @foreach ($groupedData as $monthYear => $data)
                                    <div class="tab-pane fade @if ($loop->first) active show @endif"
                                        id="{{ str_replace(' ', '', strtolower($monthYear)) }}" role="tabpanel"
                                        aria-labelledby="vert-tabs-{{ $monthYear }}-tab">
                                        <table id="" class="table table-bordered monthly">
                                            <thead style="background-color: #e0ebeb;">
                                                <h4 class="text-center font-weight-bold" style="color: #ff9900">
                                                    {{ $monthYear }}</h4>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Total Attended Classes</th>
                                                    <th>Total Amount</th>
                                                    <th>Payment Info</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $teacherId => $teacherInfo)
                                                <tr>
                                                    <td class=" align-middle text-center">
                                                        {{ $teacherInfo['teacher']->teacherName }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{$teacherInfo['classCount'] }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{$teacherInfo['paymentSum'] }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        @if(empty($teacherInfo['teacherInfo']->paymentInfo))
                                                        <p class="badge badge-danger my-0">Teacher Deleted</p>
                                                        @else
                                                        {{ $teacherInfo['teacherInfo']->paymentInfo }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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