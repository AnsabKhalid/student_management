@extends('layouts.main')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12 px-md-3">
            <div class="card-header border border-warning mb-4" style="background-color: #ff9900; border-radius: 7px;">
                <h3 class="text-center text-white pt-2 font-weight-bold">Manage Cities</h3>
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
                    <form action="{{URL::to('/addCity')}}" method="POST" class="d-flex">
                        @csrf
                        <input class="form-control" name="cityName" placeholder="Enter a new City Name">
                        <button type="submit" class="btn btn-success mx-2">
                            Add
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead style="background-color: #e0ebeb;">
                            <tr>
                                <th scope="col">City Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allCities as $cities)
                            <tr>
                                <td class="align-middle font-weight-bold">{{ ucfirst(trans($cities->cityName)) }}</td>
                                <td>
                                    <!--<a href="{{URL::to('/deleteCity/'. $cities->id)}}" class="btn btn-danger">Delete <i class="fa fa-trash"></i></a>-->
                                    <a href="#" class="btn btn-danger m-1" data-toggle="modal"
                                        data-target="#confirmDeleteModal" data-id="{{$cities->id}}"
                                        data-url="{{URL::to('/deleteCity/')}}">Delete <i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@stop