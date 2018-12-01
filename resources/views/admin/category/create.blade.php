@extends('layouts.backend.app')
@section('title', 'Add - Category')

@push('css')

<!-- Sweet Alert Css -->
<link href="{{asset('assets/backend/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
@endpush

@section('content')

<div class="container-fluid">
   
    <!-- Advanced Validation -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>ADD NEW CATEGORY</h2>
                </div>
                <div class="body">
                    {!! Form::open(['route'=>'admin.category.store','files'=>true]) !!}
                        @include('admin.category._form')
                    {!! Form::close()!!}
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Advanced Validation -->     
</div>

</body>

</html>

@endsection

@push('js')
<!-- Jquery Validation Plugin Css -->
<script src="{{asset('assets/backend/plugins/jquery-validation/jquery.validate.js')}}"></script>

<!-- JQuery Steps Plugin Js -->
<script src="{{asset('assets/backend/plugins/jquery-steps/jquery.steps.js')}}"></script>

<!-- Sweet Alert Plugin Js -->
<script src="{{asset('assets/backend/plugins/sweetalert/sweetalert.min.js')}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{asset('assets/backend/plugins/node-waves/waves.js')}}"></script>

@endpush

@push('script')
<script src="{{asset('assets/backend/js/pages/forms/form-validation.js')}}"></script>

@endpush