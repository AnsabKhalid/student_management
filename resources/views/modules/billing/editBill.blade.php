@extends('layouts.main')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="">Edit Class</h3>
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
                        <form action="{{ URL::to('/updateClass') }}" method="POST">
                            @csrf
                            <input type="hidden" name="studentId" value="{{ $billingRecord->studentId }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="{{ $billingRecord->id }}">
                                        <input type="hidden" name="studentName" value="{{ $billingRecord->studentName }}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <div id="form-container">
                                <div class="form-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="classDate">Class Date ( click on icon )</label>
                                                <input type="date" name="classDate" value="{{ $billingRecord->classDate }}" inputmode="numeric" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="classTime">Class Time</label>
                                                <input type="time" name="classTime" value="{{ $billingRecord->classTime }}" inputmode="numeric" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="payment">Payment</label>
                                                <input type="number" name="payment" value="{{ $billingRecord->payment }}" inputmode="numeric" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="teacherName">Teacher Name</label>
                                                <select class="form-control custom-select" name="teacherName" data-placeholder="Select Teacher" style="width: 100%;">
                                                    <option selected value="{{ $billingRecord->teacherId }}|{{ $billingRecord->teacherName }}">{{ $billingRecord->teacherName }}</option>
                                                    @foreach( $allTeachers as $teachers)
                                                        <option value="{{ $teachers->teacherId }}|{{ $teachers->teacherName }}">{{ $teachers->teacherName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="subject">Subject</label>
                                                <select class="form-control custom-select" name="subject" ata-placeholder="Select Teacher" style="width: 100%;">
                                                    <option selected value="{{ $billingRecord->subject }}">{{ $billingRecord->subject }}</option>
                                                    @foreach( $allSubjects as $subject)
                                                        <option value="{{ ucfirst(trans($subject->subjectName)) }}">{{ ucfirst(trans($subject->subjectName)) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="teacherPayment">Teacher Payment</label>
                                                <input type="number" value="{{ $billingRecord->teacherPayment }}" name="teacherPayment" inputmode="numeric" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="modeOfClass">Class Mode</label>
                                                <select id="modeOfClass" name="modeOfClass" class="form-control custom-select">
                                                    <option selected value="{{ $billingRecord->modeOfClass }}">{{ $billingRecord->modeOfClass }}</option>
                                                    <option value="Online">Online</option>
                                                    <option value="Centre">Centre</option>
                                                    <option value="Home">Home</option>
                                                    <option value="Group">Group</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="classDuration">Class Duration</label>
                                                <select id="classDuration" name="classDuration" class="form-control custom-select">
                                                    <option selected value="{{ $billingRecord->classDuration }}">{{ $billingRecord->classDuration }}</option>
                                                    <option value="30 Minutes">30 Minutes</option>
                                                    <option value="60 Minutes">60 Minutes</option>
                                                    <option value="90 Minutes">90 Minutes</option>
                                                    <option value="120 Minutes">120 Minutes</option>
                                                    <option value="150 Minutes">150 Minutes</option>
                                                    <option value="180 Minutes">180 Minutes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status">Payment Status</label>
                                                <select class="form-control" name="status">
                                                    <option selected value="{{ $billingRecord->status }}">{{ $billingRecord->status }}</option>
                                                    <option value="pending">pending</option>
                                                    <option value="paid">Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="message">Message</label>
                                                <textarea name="message" class="form-control" rows="3">{{ $billingRecord->message }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status">Class Status</label>
                                                <select class="form-control" name="classStatus">
                                                    <option selected value="{{ $billingRecord->classStatus }}">{{ $billingRecord->classStatus }}</option>
                                                    <option value="active">active</option>
                                                    <option value="cancel">cancel</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status">Class Remarks</label>
                                                <select class="form-control" name="classRemarks">
                                                    <option selected value="{{ $billingRecord->classRemarks }}">{{ $billingRecord->classRemarks }}</option>
                                                    <option value="Regular">Regular</option>
                                                    <option value="Student Cancel Class">Student Cancel Class</option>
                                                    <option value="Teacher Cancel Class">Teacher Cancel Class</option>
                                                    <option value="Centre Cancel Class">Centre Cancel Class</option>
                                                    <option value="Replacement Class">Replacement Class</option>
                                                    <option value="Trial Class">Trial Class</option>
                                                      <option value="Extra">Extra</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="hidden" name="updatedBy" value="{{Auth::user()->name}}">
                                            </div>
                                        </div>
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

