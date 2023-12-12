@extends('layouts.second')

@section('content')
    <!-- Main content -->
    <section class="content py-5 px-3">
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
                <div class="row">
                    <h1 class="text-center w-100 mb-4">Dear
                        @if(Route::currentRouteName() == 'reviewFormStudent')
                            {{ $data->studentName }}
                        @elseif(Route::currentRouteName() == 'reviewFormTeacher')
                            {{ $data->teacherName }}
                        @endif
                    </h1>
                    <h5 class="text-center w-100 mb-4">Please give review of your below class</h5>
                </div>
                <div class="row">
                    <div class="col-6 d-flex justify-content-center mb-4">
                        @if(Route::currentRouteName() == 'reviewFormStudent')
                            <h4>Teacher : <b>{{$data->teacherName}}</b></h4>
                        @elseif(Route::currentRouteName() == 'reviewFormTeacher')
                            <h4>Student : <b>{{$data->studentName}}</b></h4>
                        @endif
                    </div>
                    <div class="col-6 d-flex justify-content-center mb-4">
                        <h4>Subject : <b>{{ $data->subject }}</b></h4>
                    </div>
                    <div class="col-6 d-flex justify-content-center mb-4">
                        <h4>Class Date : <b>{{ date('d-M-y',strtotime($data->classDate)) }}</b></h4>
                    </div>
                    <div class="col-6 d-flex justify-content-center mb-4">
                        <h4>Class Time : <b>{{ date('h:i-a',strtotime($data->classTime)) }}</b></h4>
                    </div>
                </div>
                <div class="card p-5 mx-5">
                    <div class="card-body"></div>
                    <form action="{{URL::to('/storeReview')}}" method="POST" class="form-row">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->billId}}">
                        @if(Route::currentRouteName() == 'reviewFormStudent')
                            <input type="hidden" name="reviewBy" value="{{$data->studentName}}">
                            <input type="hidden" name="role" value="student">
                            <input type="hidden" name="reviewFor" value="{{$data->teacherName}}">
                        @elseif(Route::currentRouteName() == 'reviewFormTeacher')
                            <input type="hidden" name="reviewBy" value="{{$data->teacherName}}">
                            <input type="hidden" name="role" value="teacher">
                            <input type="hidden" name="reviewFor" value="{{$data->studentName}}">
                        @endif
                        <div class="offset-md-3 col-md-6 mb-3">
                            <div class="form-group">
                                <label>Rating</label>
                                <select class="form-control" name="rating" data-placeholder="Select Rating" style="width: 100%;">
                                    <option disabled selected>Select Number</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="offset-md-3 col-md-6 mb-3">
                            <label>Topic Covered</label>
                            <input class="form-control" name="topic" type="text">
                        </div>
                        <div class="offset-md-3 col-md-6 mb-3">
                            <label>Assessment</label>
                            <input class="form-control" name="assessment" type="text">
                        </div>
                        <div class="offset-md-3 col-md-6 mb-3">
                            <label>Homework</label>
                            <input class="form-control" name="homework" type="text">
                        </div>
                        <div class="offset-md-3 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="review">Review</label>
                                <textarea id="review" name="review" class="form-control" rows="4" spellcheck="false"></textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-success text-center">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
