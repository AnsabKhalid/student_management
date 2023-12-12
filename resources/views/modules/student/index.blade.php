@extends('layouts.main')

@section('title', 'All Students')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

            <section class="col-lg-12">
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                <div class="card">
                    <div class="card-header border border-warning" style="background-color: #ff9900;">
                        <h3 class="text-center text-white pt-2">All Students
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered history" style="width: 130vw">
                                <thead style="background-color: #e0ebeb;">
                                    <tr>
                                        <th>St.Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Subjects</th>
                                        <th>status</th>
                                        <th>Registered at</th>
                                        <th>Last update</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allStudents as $student)
                                    <tr>
                                        <td class="align-middle">{{$student->studentId}}</td>
                                        <td class="align-middle">
                                            <img style="width: 4rem;border-radius: 10px"
                                                src="{{URL::to('public/assets/uploads/studentImages')}}/{{$student->image}}"
                                                alt="{{$student->studentName}}">
                                        </td>
                                        <td class="align-middle">
                                            {{$student->studentName}}
                                        </td>
                                        <td class="align-middle">
                                            {{$student->classLevel}}
                                        </td>
                                        <td class="align-middle">{{$student->subjects}}</td>
                                        <td class="align-middle">
                                            @if( $student->status == 'pending')
                                            <span class="badge badge-danger badge-pill p-2">Pending</span>
                                            @else
                                            <span class="badge badge-success badge-pill p-2">Registered</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            {{ date('d-F-Y',strtotime($student->created_at)) }}
                                        </td>
                                        <td class="align-middle">
                                            <h5>{{ $student->handledBy }}</h5>
                                            {{ date('d-F-Y  h-i-a',strtotime($student->updated_at)) }}
                                        </td>
                                        <td class="align-middle">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{URL::to('/find/'. $student->id)}}">
                                                        <i class="fa fa-search pr-2"></i> Find
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{URL::to('/StudentProfile/'. $student->id ) }}">
                                                        <i class="fa fa-eye pr-2"></i> View
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{URL::to('/editStudent/'. $student->id ) }}">
                                                        <i class="fa fa-edit pr-2"></i> Edit
                                                    </a>
                                                    @if (Auth::user()->role_id == 1)
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#confirmDeleteModal" data-id="{{$student->id}}"
                                                        data-url="{{URL::to('/deleteStudent/')}}">
                                                        <i class="fa fa-trash pr-2"></i> Delete
                                                    </a>
                                                    @endif
                                                    <a class="dropdown-item"
                                                        href="{{URL::to('/studentReport/'. $student->studentId ) }}">
                                                        <i class="fa fa-file pr-2"></i> Report
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- /.card -->
            </section>

        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@stop