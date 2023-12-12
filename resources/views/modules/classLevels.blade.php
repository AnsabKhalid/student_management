@extends('layouts.main')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12 px-md-2">
            <div class="card-header border border-warning mb-4" style="background-color: #ff9900; border-radius: 7px;">
                <h3 class="text-center text-white pt-2 font-weight-bold">Manage Class Levels</h3>
            </div>
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
                    <form action="{{URL::to('/addClassLevel')}}" method="POST" class="d-flex">
                        @csrf
                        <input class="form-control" name="classLevel" placeholder="Enter a new Class Level">
                        <button type="submit" class="btn btn-success mx-2">
                            Add
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #e0ebeb;">
                                <tr>
                                    <th scope="col">Class Level</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allClassLevels as $classes)
                                <tr>
                                    <td class="align-middle font-weight-bold">{{ ucfirst(trans($classes->classLevel)) }}
                                    </td>
                                    <td>
                                        <!--<a href="{{URL::to('/deleteClassLevel/'. $classes->id)}}" class="btn btn-danger">Delete <i class="fa fa-trash"></i></a>-->
                                        <a href="#" class="btn btn-danger m-1" data-toggle="modal"
                                            data-target="#confirmDeleteModal" data-id="{{$classes->id}}"
                                            data-url="{{URL::to('/deleteClassLevel/')}}">Delete <i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
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