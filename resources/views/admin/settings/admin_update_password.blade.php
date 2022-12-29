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
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Update Admin Password</h4>
              @if(Session::has('update_pass'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('update_pass')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              @endif

              @if(Session::has('pass_match_error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{Session::get('pass_match_error')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif

              @if(Session::has('current_pass_error'))
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{Session::get('current_pass_error')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif

              <form class="forms-sample" action="{{url('admin/update-password')}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="exampleInputUsername1">Admin Name</label>
                  <input type="text" class="form-control" value="{{$adminData['name']}}" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Admin Type</label>
                  <input type="email" class="form-control" value="{{$adminData['type']}}" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Current Password</label>
                  <input type="password" class="form-control" placeholder="Current Password" name="current_pass" id="current_pass">
                  <div id="error_current_pass"></div>
                  
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" class="form-control" placeholder="New Password" name="new_pass">
                  </div>
                <div class="form-group">
                  <label for="exampleInputConfirmPassword1">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_pass">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
              </form>
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