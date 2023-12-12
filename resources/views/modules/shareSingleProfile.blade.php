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
                                <th>Availability</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">
                                        <img src="{{URL::to('public/assets/uploads/teacherImages')}}/{{$data['image']}}"
                                             style="width: 90px; border-radius: 10px">
                                    </td>
                                    <td class="align-middle">
                                        {{ $data['teacherName'] }}
                                    </td>
                                    <td class="align-middle">
                                        @foreach( $classLevels as $level)
                                            <a class="btn btn-info">{{$level}}</a>
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        @foreach( $subjects as $subject)
                                            <a class="btn btn-primary">{{ ucfirst($subject) }}</a>
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        {{ $data['educationQualification'] }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $data['availability'] }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

