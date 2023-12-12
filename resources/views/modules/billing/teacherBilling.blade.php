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
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="SnB" class="table table-bordered">
                                <thead style="background-color: #e0ebeb;">
                                    <tr>
                                        <th>Tacher Id</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $allBillingTeachers->unique('teacherId') as $billingTeacher)
                                    <tr>
                                        <td class="align-middle">{{ $billingTeacher->teacherId }}</td>
                                        <td class="align-middle">
                                            {{ $billingTeacher->teacherName }}
                                        </td>
                                        <td class="align-middle">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    data-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{URL::to('/teacherBillingFull/'. $billingTeacher->teacherId)}}"
                                                        class="dropdown-item">
                                                        <i class="fa fa-eye pr-2"></i> View
                                                    </a>
                                                    <a href="{{URL::to('/teacherScheduleDownload/'. $billingTeacher->teacherId)}}"
                                                        class="dropdown-item">
                                                        <i class="fa fa-flag pr-2"></i> Class Report
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