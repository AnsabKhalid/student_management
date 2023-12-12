@extends('layouts.main')

@section('title', 'Edit Staff Profile')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 px-md-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <form action="{{URL::to('/updateUser')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $user->id }}" name="id" id="id">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Staff</h3>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Current Pic</label>
                                        <br>
                                        <img src="{{asset('public/assets/uploads/staffImages/'.$user->image) }}" alt="Student Image" class="col-3 my-2">
                                        <br>
                                        <label for="image">if you want to change than select new</label>
                                        <label for="image">Upload Picture</label>
                                        <div class="custom-file">
                                            <input type="file" name="image" value="{{  asset('assets/uploads/staffImages/'.$user->image) }}" class="custom-file-input" id="studentPic">
                                            <label class="custom-file-label" for="studentPic">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="studentName">Staff Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-user"></i></span>
                                            </div>
                                            <input type="text" name="name" value="{{ $user->name }}" id="name" class="form-control" placeholder="Full Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input id="phoneNumber" value="{{ $user->phoneNumber }}" name="phoneNumber" type="text" class="form-control" data-inputmask='"mask": "9999-9999999"' data-mask>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email"  value="{{ $user->email }}" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">#</span>
                                            </div>
                                            <input id="password" name="password" type="text" class="form-control" data-inputmask='"mask": "9999-9999999"' data-mask placeholder="{{ $user->password }}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select id="role" name="role" class="form-control custom-select">
                                            <option selected value="{{$user->role['name'] }}">{{$user->role['name'] }}</option>
                                            <option>staff</option>
                                            <option>admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right">Update</button>
                        </div>
                    </div>
                </form>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
