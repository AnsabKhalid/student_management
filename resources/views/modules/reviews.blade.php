@extends('layouts.main')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card-header col-md-12 border border-warning mb-4"
            style="background-color: #ff9900; border-radius: 7px;">
            <h3 class="text-center text-white pt-2 font-weight-bold">Reviews</h3>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #ffc266;">
                    <div class="col-md-12">
                        <h3 class="align-middle font-weight-bold text-muted pt-2 text-center">Reviews by
                            Teachers</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-bordered history" style="width: 130vw;">
                            <thead style="background-color: #e0ebeb;">
                                <tr>
                                    <th>Teacher Name</th>
                                    <th>Class Date & Time</th>
                                    <th>Student Name</th>
                                    <th>Subject</th>
                                    <th>Class Mode</th>
                                    <th>Class Duration</th>
                                    <th>Ratings</th>
                                    <th>Review</th>
                                    <th>Topic</th>
                                    <th>Assessment</th>
                                    <th>Homework</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $teacherReviews as $teacherReview)
                                <tr>
                                    <td class="align-middle">
                                        {{ $teacherReview->reviewBy }}
                                    </td>
                                    <td class="align-middle">
                                        @foreach($classData as $data)
                                        @if($data->billId == $teacherReview->billId)
                                        {{ date('d-M-y',strtotime($data->classDate)) }} -
                                        {{ date('l',strtotime($data->classDate)) }}
                                        <br>
                                        <hr>
                                        {{ date('h:i A',strtotime($data->classTime)) }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        {{ $teacherReview->reviewFor }}
                                    </td>
                                    <td class="align-middle">
                                        @foreach($classData as $data)
                                        @if($data->billId == $teacherReview->billId)
                                        {{ $data->subject }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        @foreach($classData as $data)
                                        @if($data->billId == $teacherReview->billId)
                                        {{ $data->modeOfClass }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        @foreach($classData as $data)
                                        @if($data->billId == $teacherReview->billId)
                                        {{ $data->classDuration }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        @for($i=1; $i <= $teacherReview->rating; $i++)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                    </td>
                                    <td class="align-middle">
                                        {{ $teacherReview->review }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $teacherReview->topic }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $teacherReview->assessment }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $teacherReview->homework }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #ffc266;">
                    <div class="col-md-12">
                        <h3 class="align-middle font-weight-bold text-muted pt-2 text-center">Reviews by
                            Students</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-bordered history" style="width: 130vw;">
                            <thead style="background-color: #e0ebeb;">
                                <tr>
                                    <th>Teacher Name</th>
                                    <th>Class Date & Time</th>
                                    <th>Student Name</th>
                                    <th>Subject</th>
                                    <th>Class Mode</th>
                                    <th>Class Duration</th>
                                    <th>Ratings</th>
                                    <th>Review</th>
                                    <th>Topic</th>
                                    <th>Assessment</th>
                                    <th>Homework</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $studentReviews as $teacherReview)
                                <tr>
                                    <td class="align-middle">
                                        {{ $teacherReview->reviewBy }}
                                    </td>
                                    <td class="align-middle">
                                        @foreach($classData as $data)
                                        @if($data->billId == $teacherReview->billId)
                                        {{ date('d-M-y',strtotime($data->classDate)) }} -
                                        {{ date('l',strtotime($data->classDate)) }}
                                        <br>
                                        <hr>
                                        {{ date('h:i A',strtotime($data->classTime)) }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        {{ $teacherReview->reviewFor }}
                                    </td>
                                    <td class="align-middle">
                                        @foreach($classData as $data)
                                        @if($data->billId == $teacherReview->billId)
                                        {{ $data->subject }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        @foreach($classData as $data)
                                        @if($data->billId == $teacherReview->billId)
                                        {{ $data->modeOfClass }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        @foreach($classData as $data)
                                        @if($data->billId == $teacherReview->billId)
                                        {{ $data->classDuration }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        @for($i=1; $i <= $teacherReview->rating; $i++)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                    </td>
                                    <td class="align-middle">
                                        {{ $teacherReview->review }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $teacherReview->topic }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $teacherReview->assessment }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $teacherReview->homework }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection