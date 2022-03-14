 @extends('layouts.layout')

@section('content')

  <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Users</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Users</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>
        <!--<div class="mt-2 mt-md-0">
            <div class="dropdown">
                <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <i class="ti-settings mr-2"></i> Actions
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div> -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Users</h6>
                    <div class="table-responsive">
                        <table id="orders" class="table">
                            <thead>
                            <tr>
                                <th>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="orders-select-all">
                                        <label class="custom-control-label" for="orders-select-all"></label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th> Name</th>
                                <th>E-mail</th>
                                <th>Date</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td></td>
                                <td>
                                    <a href="#">{{$key+1}}</a>
                                </td>
                                <td>
                                    <a href="#" class="d-flex align-items-center">
                                        <img width="40" src="../../assets/media/image/products/product1.png"
                                             class="rounded mr-3" alt="Vase">
                                        <span>{{$user->name}}</span>
                                    </a>
                                </td>
                                <td>{{$user->email}}</td>
                                
                                <td>{{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown"
                                           class="btn btn-floating"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item">View Detail</a>
                                            <a href="#" class="dropdown-item">Send</a>
                                            <a href="#" class="dropdown-item">Download</a>
                                            <a href="#" class="dropdown-item">Print</a>
                                            <a href="#" class="dropdown-item text-danger">Delete</a>
                                        </div>
                                    </div>
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

@endsection