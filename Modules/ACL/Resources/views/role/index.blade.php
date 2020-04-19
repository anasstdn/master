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
          <span class="font-w300">{{ __('panel.roles_management') }}</span>
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
      <span class="breadcrumb-item active">{{ __('breadcrumb.roles_management') }}</span>
    </nav>
  </div>
  <!-- END Breadcrumb -->

  <!-- Content -->
  <div class="content">
    <!-- Icon Navigation -->
    <!-- Dynamic Table Full Pagination -->
    <div class="block">
      <div class="row col-lg-12" style="margin-bottom:1em;font-family: sans-serif;">
          <div class="col-lg-1">
            <span>Page by :</span>
          </div>
          <div class="col-lg-1">
            <select class="form-control form-control-sm" id="per_page">
              <option value="1">1</option>
              <option value="5">5</option>
              <option value="10" selected>10</option>
              <option value="20">20</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
          </div>
          <div class="col-lg-1">
            <span>Sort by :</span>
          </div>
          <div class="col-lg-3">
            <select class="form-control form-control-sm" id="sort">
              <option value="date_desc" selected>date (Latest First)</option>
              <option value="date_asc">date (Oldest First)</option>
            </select>
          </div>
          <div class="col-lg-1">
            <span>Search :</span>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control form-control-sm" id="search">
          </div>
          <div class="col-md-2 text-right">

          </div>
        </div>
      <div class="block-header block-header-default">
       
       {{-- <h3 class="block-title">Dynamic Table <small>Full pagination</small></h3> --}}
     </div>
     <div class="block-content block-content-full">
      <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
      <div id="table_data">
        @include('acl::role.index-data')
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
@push('js')
<script type="text/javascript">
$(document).ready(function(){
  $(document).on('click', '.pagination a', function(event){
      event.preventDefault(); 
      var page = $(this).attr('href').split('page=')[1];
      fetch_data(page);
    });
  

    $(document).on('change','#per_page',function(event){
      event.preventDefault();
      if($('.pagination a').length==0)
      {
        var page=1;
        fetch_data(page);
      } 
      else
      {
        var page = 1;
        fetch_data(page);
      }
    })

    $(document).on('change','#sort',function(event){
      event.preventDefault();
      if($('.pagination a').length==0)
      {
        var page=1;
        fetch_data(page);
      } 
      else
      {
        var page = 1;
        fetch_data(page);
      }
    })

    $(document).on('keyup change','#search',function(event){
      event.preventDefault();
      if($('.pagination a').length==0)
      {
        var page=1;
        fetch_data(page);
      } 
      else
      {
        var page = 1;
        fetch_data(page);
      }
    })
})

function fetch_data(page)
{
  var data_ajax={ 'per_page':$('#per_page').val(),'sort':$('#sort').val(),'search':$('#search').val() };
  $('.ajax-loader').fadeIn();
    $("#status").html("Loading...Please Wait!");
  $.ajax({
    url:"{{url('role/get-data')}}?page="+page,
    data:data_ajax,
    headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    xhr: function () {
    var xhr = new window.XMLHttpRequest();
    xhr.upload.addEventListener("progress",
      uploadProgressHandler,
      false
      );
    xhr.addEventListener("load", loadHandler, false);
    xhr.addEventListener("error", errorHandler, false);
    xhr.addEventListener("abort", abortHandler, false);

    return xhr;
  },
    success:function(data)
    {
      $('#table_data').html(data);
    }
  });
}
</script>
@endpush
