@extends('layouts.main')

@section('title', 'All Teacher List')

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
                    <div class="card-header border border-warning"
                        style="background-color: #ff9900; border-radius: 7px;">
                        <h3 class="text-center text-white pt-2 font-weight-bold">All Teachers</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered history" style="width: 130vw">
                                <thead style="background-color: #e0ebeb;">
                                    <tr>
                                        <th>T.Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Subjects</th>
                                        <th>Physically Available</th>
                                        <th>Registered at</th>
                                        <th>Last Update</th>
                                        <th>Rating</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allTeachers as $teacher)
                                    <tr>
                                        <td class="align-middle">{{ $teacher->teacherId }}</td>
                                        <td class="align-middle">
                                            <img style="width: 4rem;border-radius: 10px"
                                                src="{{URL::to('public/assets/uploads/teacherImages')}}/{{$teacher->image}}">
                                        </td>
                                        <td class="align-middle">{{ $teacher->teacherName }}</td>
                                        <td class="align-middle">{{ $teacher->teachingLevel }}</td>
                                        <td class="align-middle">{{  ucfirst(trans($teacher->subjects)) }}</td>
                                        <td class="align-middle">{{  ucfirst(trans($teacher->cities )) }}</td>
                                        <td class="align-middle">
                                            {{ date('d-F-Y',strtotime($teacher->created_at)) }}
                                        </td>
                                        <td class="align-middle">
                                            <h5>{{ $teacher->handledBy }}</h5>
                                            {{ date('d-M-Y  h-i-a',strtotime($teacher->updated_at)) }}
                                        </td>
                                        <td class="align-middle">
                                            @for($i=1; $i <= $teacher->rating; $i++)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                @endfor
                                        </td>
                                        <td class="align-middle">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item font-weight-bold"
                                                        href="{{URL::to('/TeacherProfile/'. $teacher->id)}}">
                                                        <i class="fa fa-eye pr-3"></i>
                                                        View
                                                    </a>
                                                    <a class="dropdown-item font-weight-bold"
                                                        href="{{URL::to('/editTeacher/'. $teacher->id)}}">
                                                        <i class="fa fa-edit pr-3"></i>
                                                        Edit
                                                    </a>
                                                    @if (Auth::user()->role_id == 1)
                                                    <a class="dropdown-item font-weight-bold" href="#"
                                                        data-toggle="modal" data-target="#confirmDeleteModal"
                                                        data-id="{{$teacher->id}}"
                                                        data-url="{{URL::to('/deleteTeacher/')}}">
                                                        <i class="fa fa-trash pr-3"></i>
                                                        Delete
                                                    </a>
                                                    @endif
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