@extends('layouts.app')

@section('content')
<div class="bg-image" style="background-image: url('{{asset('codebase/')}}/src/assets/media/photos/photo12@2x.jpg');">
  <div class="content content-top">
    <div class="row push">
      <div class="col-md py-10 d-md-flex align-items-md-center text-center">
        <h1 class="text-white mb-0">
          <span class="font-w300">{{ __('panel.dashboard') }}</span>
          <span class="font-w400 font-size-lg text-white-op d-none d-md-inline-block">{{ __('messages.welcome') }} {{ Auth::user()->name }}</span>

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
      <a class="breadcrumb-item" href="javascript:void(0)">{{ __('breadcrumb.home') }}</a>
      <span class="breadcrumb-item active">{{ __('breadcrumb.dashboard') }}</span>
    </nav>
  </div>
  <!-- END Breadcrumb -->

  <!-- Content -->
  <div class="content">
    <!-- Icon Navigation -->


    <!-- Charts -->
    

   
    <!-- END More Data -->
  </div>
  <!-- END Content -->
</div>
@endsection
