@extends('layouts.main')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <section class="col-lg-12">
                <div class="card-header border border-warning mb-4"
                    style="background-color: #ff9900; border-radius: 7px;">
                    <h3 class="text-center text-white pt-2 font-weight-bold">Schedule and Billing</h3>
                </div>
                <div class="card">
                    <div class="card-header">
                        <form action="{{URL::to('/store')}}" METHOD="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <label>Add new student</label>
                                            <select class="select2" name="student" data-placeholder="Select Subjects"
                                                style="width: 100%;">
                                                <option disabled selected>Select a Student</option>
                                                @foreach( $allStudents as $student)
                                                <option
                                                    value="{{ $student->studentId }}|{{ $student->studentName }}|{{ $student->fatherName }}">
                                                    {{ $student->studentId }} . {{ $student->studentName }} .
                                                    {{ $student->fatherName }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2" style="padding-top: 30px;">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-database pr-2"></i>
                                                Add Student
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="SnB" class="table table-bordered">
                                <thead style="background-color: #e0ebeb;">
                                    <tr>
                                        <th>St.Id</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $allBillingStudents as $billingStudent)
                                    <tr>
                                        <td class="align-middle">{{ $billingStudent->studentId }}</td>
                                        <td class="align-middle">
                                            {{ $billingStudent->studentName }}
                                        </td>
                                        <td class="align-middle">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    data-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{URL::to('/Billing/'. $billingStudent->studentId)}}"
                                                        class="dropdown-item">
                                                        <i class="fa fa-eye pr-2"></i> View Record
                                                    </a>
                                                    <a href="{{URL::to('/studentScheduleDownload/'. $billingStudent->studentId)}}"
                                                        class="dropdown-item">
                                                        <i class="fa fa-flag pr-2"></i> All Classes Report
                                                    </a>
                                                    <a href="{{URL::to('/studentReport/'. $billingStudent->studentId)}}"
                                                        class="dropdown-item">
                                                        <i class="fa fa-file pr-2"></i> Monthly Report
                                                    </a>
                                                    <a href="{{URL::to('/packages/'. $billingStudent->studentId)}}"
                                                        class="dropdown-item">
                                                        <i class="fa fa-eye pr-2"></i> View Packages
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
@endsection