@extends('layouts.app')

@section('content')
<style>
    .ajax-loader{
    position:fixed;
    top:0px;
    right:0px;
    width:100%;
    height:auto;
    background-color:#A9A9A9;
    background-repeat:no-repeat;
    background-position:center;
    z-index:10000000;
    opacity: 0.4;
    filter: alpha(opacity=40); /* For IE8 and earlier */
  }
</style>
<div class="ajax-loader text-center" style="display:none">
      <div class="progress">
        <div class="progress-bar progress-bar-striped active" aria-valuenow="100" aria-valuemin="1000"
        aria-valuemax="100" style="width: 100%;" id="loader" role="progressbar">
      </div>
    </div>
    <div id="" style="font-size:11pt;font-family: sans-serif;color: white">{{ __('alert.loading') }}</div>
  </div>
<div class="bg-image" style="background-image: url('{{asset('codebase/')}}/src/assets/media/photos/photo12@2x.jpg');">
  <div class="content content-top">
    <div class="row push">
      <div class="col-md py-10 d-md-flex align-items-md-center text-center">
        <h1 class="text-white mb-0">
          <span class="font-w300">{{ __('panel.user_management') }}</span>
        </h1>
      </div>
    </div>
  </div>
</div>
<!-- END Header -->

<!-- Page Content -->
<div class="bg-white">
  {{--  <li><a href="{{ url('locale/en') }}" ><i class="fa fa-language"></i> EN</a></li>

                                        <li><a href="{{ url('locale/id') }}" ><i class="fa fa-language"></i> FR</a></li> --}}
  <!-- Breadcrumb -->
<div class="content">
    <nav class="breadcrumb mb-0">
      <a class="breadcrumb-item" href="javascript:void(0)">{{ __('breadcrumb.acl') }}</a>
      <span class="breadcrumb-item active">{{ __('breadcrumb.user_management') }}</span>
    </nav>
  </div>
  <!-- END Breadcrumb -->

  <!-- Content -->
  <div class="content">
    <!-- Icon Navigation -->
     <!-- Dynamic Table Full Pagination -->
                    <div class="block">
                        <div class="block-header block-header-default">
                         <a class="btn btn-sm btn-primary data-modal pull-left" style="color: white" id="data-modal" href="#" onclick="show_modal('{{ route('user.create') }}')" ><i class='si si-plus' style="color: white" aria-hidden='true'></i> {{ __('button.add') }}</a>
                            {{-- <h3 class="block-title">Dynamic Table <small>Full pagination</small></h3> --}}
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <div id="table_data">
                              @include('acl::user.index-data')
                            </div>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full Pagination -->
    
  </div>
  <!-- END Content -->
</div>
 <div class="modal fade" id="formModal" aria-hidden="true" aria-labelledby="modal-normal" role="dialog" tabindex="-1">
 </div>
 <div class="modal fade" id="formModal1" aria-hidden="true" aria-labelledby="modal-normal" role="dialog" tabindex="-1">
 </div>
  <!-- END Content -->
@endsection
