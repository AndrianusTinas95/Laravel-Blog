@extends('layouts.backend.app')
@section('title', 'Edit - Tag')

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
                    <h2>EDIT TAG</h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.tag.update',$tag->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="name" id="name" value="{{$tag->name}}" maxlength="191" minlength="3" required>
                                <label class="form-label">Tag Name</label>
                            </div>
                            <div class="help-info">Min. 3, Max. 191 characters</div>
                        </div>
                        <a href="{{route('admin.tag.index')}}" class="btn btn-danger m-t-15 waves-effect" >BACK</a>
                        <button class="btn btn-primary m-t-15  waves-effect" type="submit">UPDATE</button>
                    </form>
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