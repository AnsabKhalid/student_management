@extends('layouts.second')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <table id="sharedTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Subjects</th>
                                    <th>Qualification</th>
                                    <th>Experience</th>
                                    <th>Physical Availability</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $teacher)
                                    <tr>
                                        <td class="align-middle">
                                            <img src="{{URL::to('public/assets/uploads/teacherImages')}}/{{$teacher['image']}}"
                                                 style="width: 90px; border-radius: 10px">
                                        </td>
                                        <td class="align-middle">
                                            {{ $teacher['teacherName'] }}
                                        </td>
                                        <td class="align-middle">
                                            <a class="btn btn-info">{{ $teacher['teachingLevel'] }}</a>
                                        </td>
                                        <td class="align-middle">
                                            <a class="btn btn-primary">{{ $teacher['subjects'] }}</a>
                                        </td>
                                        <td class="align-middle">
                                            {{ $teacher['educationQualification'] }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $teacher['experience'] }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $teacher['cities'] }}
                                        </td>
                                        <td class="align-middle">
                                            <a class="btn btn-primary" href="{{ URL::to('/teacherPublicProfile/'. $teacher['teacherId']) }}">
                                                View Profile
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

            </div>
        </div>
    </section>
@endsection
