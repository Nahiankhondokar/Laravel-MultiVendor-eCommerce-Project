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
              <h4 class="card-title">Update Admin Details</h4>

              @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{Session::get('error_message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif

              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('success_message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif

              <form class="forms-sample" action="{{url('admin/update-details')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin Type</label>
                    <input type="text" class="form-control" value="{{$adminData['type']}}" readonly>
                </div>

                <div class="form-group">
                  <label for="exampleInputUsername1">Admin Name</label>
                  <input type="text" class="form-control" value="{{$adminData['name']}}" name="name">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin Email</label>
                    <input type="text" class="form-control" value="{{$adminData['email']}}" name="email">
                    @error('email')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin Mobile</label>
                    <input type="text" class="form-control" value="{{$adminData['mobile']}}" name="mobile">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin Photo</label>
                    <input type="file" class="form-control" name="image">

                    <input type="hidden" class="form-control" value="{{$adminData['image']}}" name="old_image"> <br>
                    @if(Auth::guard('admin') -> user() -> image)
                    <img src="{{url($adminData['image'])}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
                    @else 
                    <img src="{{url('media/avatar.png')}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
                    @endif
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