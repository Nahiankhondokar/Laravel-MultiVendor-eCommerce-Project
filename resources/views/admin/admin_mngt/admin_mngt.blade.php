@extends('admin.layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold">Welcome to {{Auth::guard('admin') -> user() -> name}}</h3>
              <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
            </div>
            <div class="col-12 col-xl-4">
             <div class="justify-content-end d-flex">
              <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                 <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                  <a class="dropdown-item" href="#">January - March</a>
                  <a class="dropdown-item" href="#">March - June</a>
                  <a class="dropdown-item" href="#">June - August</a>
                  <a class="dropdown-item" href="#">August - November</a>
                </div>
              </div>
             </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{$title}}</h4>
                <p class="card-description">
                  Add class <code>.table-bordered</code>
                </p>
                <div class="table-responsive pt-3">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>
                          ID
                        </th>
                        <th>
                          Admin Type
                        </th>
                        <th>
                          Admin Name
                        </th>
                        <th>
                          Admin Email
                        </th>
                        <th>
                          Admin Image
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Aciton
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($adminData as $index => $item)
                      <tr>
                        <td>
                          {{$index + 1}}
                        </td>
                        <td>
                            {{$item -> type}}
                        </td>
                        <td>
                            {{$item -> name}}
                        </td>
                        <td>
                            {{$item -> email}}
                        </td>
                        
                        <td>
                            @if($item -> status == 1)
                            <span class="badge badge-success">Active</span>
                            @else 
                            <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @if($item -> image)
                            <img src="{{url($item -> image)}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
                            @else 
                            <img src="{{url('media/avatar.png')}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
                            @endif
                        </td>
                        <td>
                          <button class="btn btn-sm btn-info">View</button>
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

    </div>
    <!-- content-wrapper ends -->

    <!-- partial:partials/_footer.html -->
    @include('admin.layouts.footer')
    <!-- partial -->
  </div>

@endsection