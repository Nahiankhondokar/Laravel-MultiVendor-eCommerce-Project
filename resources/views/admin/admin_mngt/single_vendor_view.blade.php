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
                <h4 class="card-title">Vendor Personal Details</h4>
                
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
                            Status
                        </th>
                        <th>
                          Admin Image
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                            {{$vendorData['get_vendor_data']['id']}}
                        </td>
                        <td>
                            {{$vendorData['type']}}
                        </td>
                        <td>
                            {{$vendorData['get_vendor_data']['name']}}
                        </td>
                        <td>
                            {{$vendorData['get_vendor_data']['name']}}
                        </td>
                        
                        <td>
                            @if($vendorData['status'] == 1)
                            <span class="badge badge-success">Active</span>
                            @else 
                            <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @if($vendorData['image'])
                            <img src="{{url($vendorData['image'])}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
                            @else 
                            <img src="{{url('media/avatar.png')}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
                            @endif
                        </td>
                    
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>

      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Vendor Business Details</h4>
                
                <div class="table-responsive pt-3">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>
                          ID
                        </th>
                        <th>
                          shop Name
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                          City
                        </th>
                        <th>
                          State
                        </th>
                        <th>
                            Proof Image
                        </th>
                        <th>
                            Country
                        </th>
                        <th>
                            Pincode
                        </th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td>
                              {{$vendorData['get_vendor_business_data']['id']}}
                          </td>
                          <td>
                              {{$vendorData['get_vendor_business_data']['shop_name']}}
                          </td>
                            <td>
                              {{$vendorData['get_vendor_business_data']['shop_address']}}
                          </td>
                          <td>
                              {{$vendorData['get_vendor_business_data']['shop_city']}}
                          </td>
                          <td>
                              {{$vendorData['get_vendor_business_data']['shop_state']}}
                          </td>
                          <td>
                            @if($vendorData['get_vendor_business_data']['address_proof_image'])
                            <img src="{{url($vendorData['get_vendor_business_data']['address_proof_image'])}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
                            @else 
                            <img src="{{url('media/avatar.png')}}" alt="" style="width: 50px; height: 50px; border-radious: 50%;">
                            @endif
                            </td>
                            <td>
                            {{$vendorData['get_vendor_business_data']['shop_country']}}
                            </td>
                            
                            <td>
                            {{$vendorData['get_vendor_business_data']['shop_pincode'] ?? 'None'}} 
                            </td>
                        </tr>
                        
                      </tbody>
                  </table>
                </div>

                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          
                          <th>
                              Email
                          </th>
                          <th>
                              Mobile
                          </th>
                          <th>
                              Website
                          </th>
                          <th>
                              GST No
                          </th>
                          <th>
                              Pan No
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                              {{$vendorData['get_vendor_business_data']['shop_email']}}
                          </td>
                          <td>
                              {{$vendorData['get_vendor_business_data']['shop_mobile']}}
                          </td>
                          <td>
                              {{$vendorData['get_vendor_business_data']['shop_website']}}
                          </td>
                          <td>
                            {{$vendorData['get_vendor_business_data']['gst_number']}}
                        </td>
                          <td>
                              {{$vendorData['get_vendor_business_data']['pan_number'] ?? 'None'}}
                          </td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
      </div>

      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Vendor Bank Details</h4>
                
                <div class="table-responsive pt-3">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Acc Holder Name
                        </th>
                        <th>
                            Bank
                        </th>
                        <th>
                            Acc No
                        </th>
                        <th>
                            IFIC Code
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td>
                              {{$vendorData['get_vendor_bank_data']['id']}}
                          </td>
                          <td>
                              {{$vendorData['get_vendor_bank_data']['account_holder_number']}}
                          </td>
                          <td>
                              {{$vendorData['get_vendor_bank_data']['bank_name']}}
                          </td>
                          <td>
                            {{$vendorData['get_vendor_bank_data']['account_number']}}
                        </td>
                          <td>
                              {{$vendorData['get_vendor_bank_data']['bank_ifsc_code'] ?? 'None'}}
                          </td>
                        </tr>
                        
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