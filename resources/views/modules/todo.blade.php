@extends('layouts.main')

@section('title', 'ToDo List')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12 px-md-5">
            <h1 class="text-center text-white border border-warning"
                style="background-color: #ff9900; border-radius: 7px;">Todo List</h1>
            <div class="card">
                <div class="card-header py-5">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{URL::to('/addTask')}}" method="POST" class="d-flex from-row">
                        @csrf
                        <input type="hidden" name="assignedBy" value="{{Auth::user()->id}}">
                        <input class="form-control col-7 mx-2" name="task" placeholder="Enter a new Task">
                        <select class="form-control col-3" name="staff">
                            <option disabled>Select Staff</option>
                            @foreach($allStaff as $staff)
                            <option value="{{$staff->id}}">{{$staff->name}}</option>
                            @endforeach
                        </select>
                        <div class=" col-2">
                            <button type="submit" class="btn btn-success ml-2"><i class="fa fa-database pr-2"></i>
                                Add
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered rounded history" style="width: 100vw;">
                            <thead style="background-color: #e0ebeb">
                                <tr>
                                    <th scope="col">Task To-Do</th>
                                    <th scope="col">Assigned By</th>
                                    <th scope="col">Assigned To</th>
                                    <th scope="col">Assign Date</th>
                                    <th scope="col">Finished at</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allTodo as $todo)
                                {{--                                @if(Auth::user()->role_id == 1 || $todo->assignedTo == Auth::user()->id)--}}
                                <tr>
                                    <td class="align-middle">{{ $todo->todo }}</td>
                                    <td class="align-middle">
                                        @foreach($allUser as $user)
                                        @if($user->id == $todo->assignedBy)
                                        {{ $user->name }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        @foreach($allStaff as $staff)
                                        @if($staff->id == $todo->assignedTo)
                                        {{ $staff->name }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        {{  date('d-M-y',strtotime($todo->created_at)) }}
                                        <hr>
                                        {{  date('h:i-a',strtotime($todo->created_at)) }}
                                    </td>
                                    <td class="align-middle">
                                        {{  date('d-M-y',strtotime($todo->updated_at)) }}
                                        <hr>
                                        {{  date('h:i-a',strtotime($todo->updated_at)) }}
                                    </td>
                                    <td class="align-middle">
                                        @if($todo->status == 'pending')
                                        <span class="badge badge-warning p-2">{{ $todo->status }}</span>
                                        @elseif($todo->status == 'done')
                                        <span class="badge badge-success p-2">{{ $todo->status }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if(Auth::user()->role_id == 1)
                                        <a href="#" class="btn btn-danger m-1" data-toggle="modal"
                                            data-target="#confirmDeleteModal" data-id="{{$todo->id}}"
                                            data-url="{{URL::to('/deleteTodo/')}}">Delete <i
                                                class="fa fa-trash"></i></a>
                                        @elseif($todo->assignedTo == Auth::user()->id && $todo->status == 'pending')
                                        <a href="{{ URL::to('/updateTodo/' . $todo->id)}}" class="btn btn-success">
                                            Done</a>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <b>{{ $todo->remark}}</b>
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{URL::to('/updateRemark')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$todo->id}}">
                                            <select class="form-control" name="remark" id="remark">
                                                <option selected disabled>Select Remark</option>
                                                <option value="Still Working">Still Working</option>
                                                <option value="can not do">Can Not Do</option>
                                                <option value="Done & Check">Done & Check</option>
                                            </select>
                                            <button type="submit" class="btn btn-success mt-2"> <i
                                                    class="fa fa-check"></i>
                                                Submit</button>
                                        </form>
                                    </td>
                                </tr>
                                {{--                                @endif--}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@stop