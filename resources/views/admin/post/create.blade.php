@extends('layouts.backend.app')
@section('title', 'Add - Post')

@push('css')

    <!-- Sweet Alert Css -->
    <link href="{{asset('assets/backend/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
 
    <!-- Bootstrap Select Css -->
    <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

@endpush

@section('content')

<div class="container-fluid">
   
    {!! Form::open(['route'=>'admin.post.store','files'=>true]) !!}
    <!-- Advanced Validation -->
        @include('admin.post._form')

    
    <!-- #END# Advanced Validation -->
    {!! Form::close()!!}     
</div>

</body>

</html>

@endsection

@push('js')
        <!-- Select Plugin Js -->
         <script src="{{asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
        <!-- Jquery Validation Plugin Css -->
        <script src="{{asset('assets/backend/plugins/jquery-validation/jquery.validate.js')}}"></script>

        <!-- JQuery Steps Plugin Js -->
        <script src="{{asset('assets/backend/plugins/jquery-steps/jquery.steps.js')}}"></script>

        <!-- Sweet Alert Plugin Js -->
        <script src="{{asset('assets/backend/plugins/sweetalert/sweetalert.min.js')}}"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="{{asset('assets/backend/plugins/node-waves/waves.js')}}"></script>
         <!-- TinyMCE -->
        <script src="{{asset('assets/backend/plugins/tinymce/tinymce.js')}}"></script>


@endpush

@push('script')
<script src="{{asset('assets/backend/js/pages/forms/form-validation.js')}}"></script>
<script>
$(function () {
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{asset('assets/backend/plugins/tinymce')}}';
});
</script>

@endpush