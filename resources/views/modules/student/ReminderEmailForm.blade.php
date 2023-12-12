@extends('layouts.main')

@section('title', 'Payment Reminder')

@section('content')
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <form action="{{ URL::to('/sendPaymentReminder') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3> Write Email for Reminder of Payment</h3>
                    </div>
                    <div class="card-body">

                         @if(Route::currentRouteName() == 'reminderEmailForm')
                            <input type="hidden" name="studentName" value="{{ $name }}">
                            <div class="my-3">
                                <label>Enter Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <input type="hidden" name="id" value="1">
                        @elseif(Route::currentRouteName() == 'reminderEmail')
                            <div class="mb-3">
                                <label>Student Name</label>
                                <input readonly type="text" class="form-control" name="studentName" value="{{ $student[0]->studentName }}">
                            </div>
                            <div class="my-3">
                                <label>Student Email</label>
                                <input readonly type="email" name="email" value="{{ $student[0]->Email }}" class="form-control">
                            </div>
                            <input type="hidden" name="id" value="2">
                        @endif
                        <label>Enter Message</label>
                        <textarea name="message" class="form-control" rows="8"></textarea>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">
                            Send
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
