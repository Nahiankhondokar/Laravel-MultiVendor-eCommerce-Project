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

      @if($slug == 'personal')
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Vendor Personal Details</h4>

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

              <form class="forms-sample" action="{{url('admin/update-vendor-details/personal')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin Type</label>
                    <input type="text" class="form-control" value="{{Auth::guard('admin') -> user() -> type}}" readonly>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" value="{{$vendorData['name']}}" name="name" placeholder="Vendor Name">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['email']}}" name="email" placeholder="Vendor Email">
                    @error('email')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['mobile']}}" name="mobile" placeholder="Vendor Mobile">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['address']}}" name="address" placeholder="Vendor Address">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['city']}}" name="city" placeholder="Vendor City">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['sate']}}" name="sate" placeholder="Vendor State">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['country']}}" name="country" placeholder="Vendor Country">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['pincode']}}" name="pincode" placeholder="Vendor Pincode">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Vendor Photo</label>
                    <input type="file" class="form-control" name="image">

                    <input type="hidden" class="form-control" value="{{Auth::guard('admin') -> user() -> image}}" name="old_image"> <br>
                    @if(Auth::guard('admin') -> user() -> image)
                    <img src="{{url(Auth::guard('admin') -> user() -> image)}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
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
      @elseif($slug == 'business') 
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Vendor Business Details</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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

              <form class="forms-sample" action="{{url('admin/update-vendor-details/business')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin Type</label>
                    <input type="text" class="form-control" value="{{Auth::guard('admin') -> user() -> type}}" readonly>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" value="{{$vendorData['shop_name']}}" name="shop_name" placeholder="shop_name">
                    @error('shop_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['shop_address']}}" name="shop_address" placeholder="shop_address">
                    @error('shop_address')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['shop_city']}}" name="shop_city" placeholder="shop_city">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['shop_state']}}" name="shop_state" placeholder="shop_state">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['shop_country']}}" name="shop_country" placeholder="shop_country">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['shop_pincode']}}" name="shop_pincode" placeholder="shop_pincode">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['shop_mobile']}}" name="shop_mobile" placeholder="shop_mobile">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['shop_website']}}" name="shop_website" placeholder="shop_website">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['shop_email']}}" name="shop_email" placeholder="shop_email">
                </div>
                
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['business_license_number']}}" name="business_license_number" placeholder="business_license_number">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['gst_number']}}" name="gst_number" placeholder="gst_number">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['pan_number']}}" name="pan_number" placeholder="pan_number">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Vendor Address & Address Photo</label>
                    <select name="address_proof" id="" class="form-control">
                        <option value="" >- select -</option>
                        <option value="Passport" @if($vendorData['address_proof'] == 'Passport') selected @endif>Passport</option>
                        <option value="NID Card" @if($vendorData['address_proof'] == 'NID Card') selected @endif>NID Card</option>
                        <option value="Driving Lisence" @if($vendorData['address_proof'] == 'Driving Lisence') selected @endif>Driving Lisence</option>
                    </select> 
                    <br>
                    <input type="file" class="form-control" name="address_proof_image">

                    <input type="hidden" class="form-control" value="{{@$vendorData['address_proof_image']}}" name="old_address_proof_image"> <br>
                    @if($vendorData['address_proof_image'])
                    <img src="{{url(@$vendorData['address_proof_image'])}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
                    @else 
                    <img src="{{url('media/avatar.png')}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
                    @endif
                </div>
                {{-- <div class="form-group">
                    <label for="exampleInputEmail1">Vendor address_proof_image</label>
                    <input type="file" class="form-control" name="image">

                    <input type="hidden" class="form-control" value="{{@$vendorData['address_proof_image']}}" name="old_image"> <br>
                    @if($vendorData['address_proof_image'])
                    <img src="{{url(@$vendorData['address_proof_image'])}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
                    @else 
                    <img src="{{url('media/avatar.png')}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
                    @endif
                </div> --}}
                
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @elseif($slug == 'bank')
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Vendor Bank Information</h4>

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

              <form class="forms-sample" action="{{url('admin/update-vendor-details/bank')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin Type</label>
                    <input type="text" class="form-control" value="{{Auth::guard('admin') -> user() -> type}}" readonly>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" value="{{$vendorData['account_holder_number']}}" name="account_holder_number" placeholder="account_holder_number">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['bank_name']}}" name="bank_name" placeholder="bank_name">
                    @error('email')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['account_number']}}" name="account_number" placeholder="account_number">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{$vendorData['bank_ifsc_code']}}" name="bank_ifsc_code" placeholder="bank_ifsc_code">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @endif


    </div>
    <!-- content-wrapper ends -->

    <!-- partial:partials/_footer.html -->
    @include('admin.layouts.footer')
    <!-- partial -->
  </div>

@endsection