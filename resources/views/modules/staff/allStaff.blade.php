@extends('layouts.main')

@section('title', 'All Staff List')

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
                    <div class="card-header col-md-12 border border-warning mb-4" style="background-color: #ffc266;">
                        <h3 class="text-center text-white pt-2 font-weight-bold">All Staff</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="SnB" class="table table-bordered" style="width: 100vw">
                                <thead style="background-color: #e0ebeb;">
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $allUsers as $users)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $users->id }}
                                        </td>
                                        <td class="align-middle">
                                            <img style="width: 2.5rem; border-radius: 50%"
                                                src="{{URL::to('public/assets/uploads/staffImages')}}/{{$users->image }}"
                                                alt="">
                                        </td>
                                        <td class="align-middle">
                                            {{ $users->name }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $users->phoneNumber }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $users->email }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $users->role['name'] }}
                                        </td>
                                        <td class="align-middle">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    data-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{URL::to('/editUser/' .$users->id)}}"
                                                        class="dropdown-item">
                                                        <i class="fa fa-edit pr-2"></i> Edit
                                                    </a>
                                                    <a href="{{URL::to('/deleteUser/' .$users->id)}}"
                                                        class="dropdown-item">
                                                        <i class="fa fa-trash pr-2"></i> Delete
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