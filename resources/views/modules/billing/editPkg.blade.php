@extends('layouts.main')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="card w-100">
                    <div class="card-header">
                        <h3 class="">Edit Package <b>{{$package[0]->name}}</b></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body w-100">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ session('error') }}</li>
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <form action="{{ URL::to('/updatePackage') }}" method="POST">
                            @csrf
                            <input type="hidden" name="studentId" value="{{ $package[0]->studentId }}">
                            <div class="row">
                                <div class="col-md-4 col-12 mb-3">
                                    <label for="name">Package Name</label>
                                    <input type="text" name="name" value="{{ $package[0]->name }}" class="form-control">
                                    <input type="hidden" name="pkgId" value="{{ $package[0]->pkgId }}" class="form-control">
                                </div>
                            </div>

                            <div id="form-container">
                                <div class="form-row">
                                    <div class="row">
                                        @foreach($package as $group)
                                            <input type="hidden" id="packageId" name="id[]" value="{{ $group->id }}" readonly>
{{--                                                @dd($group)--}}
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="subject[]">Subject</label>
                                                        <select class="form-control custom-select" name="subject[]" ata-placeholder="Select Teacher" style="width: 100%;">
                                                            <option selected value="{{ $group->subject }}">{{ $group->subject }}</option>
                                                            @foreach( $separatedSubjects as $index => $subject)
                                                                <option value="{{ ucfirst(trans($subject)) }}" id="subject">{{ ucfirst(trans($subject)) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="noOfClasses[]">No of Classes</label>
                                                    <input type="text" name="noOfClasses[]" value="{{ $group->noOfClasses }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="classDuration[]">Duration of Classes</label>
                                                    <select id="classDuration" name="classDuration[]" class="form-control custom-select" required>
                                                        <option selected value="{{ $group->classDuration }}">{{ $group->classDuration }}</option>
                                                        <option value="30 Minutes">30 Minutes</option>
                                                        <option value="60 Minutes">60 Minutes</option>
                                                        <option value="90 Minutes">90 Minutes</option>
                                                        <option value="120 Minutes">120 Minutes</option>
                                                        <option value="150 Minutes">150 Minutes</option>
                                                        <option value="180 Minutes">180 Minutes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="payment[]">Payment</label>
                                                    <input type="text" name="payment[]" value="{{ $group->payment }}" class="form-control">
                                                </div>
                                            </div>
{{--                                            <div class="col-md-1 col-12">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="remove">Remove</label>--}}
{{--                                                    <a href="{{ URL::to('/deleteRow/'.$group->id) }}" class="btn btn-danger" id="remove">X</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <button type="" class="btn btn-success float-right">update</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

