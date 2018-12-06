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
    <div class="block-header">
        <a class="btn btn-danger waves-effect" href="{{route('author.post.index')}}">
            <i class="material-icons">reply</i>
            <span>BACK</span>
        </a>
        @if ($post->is_approved == false)
            <button type="button" class="btn btn-success waves-effect pull-right">
                <i class="material-icons">done</i>
                <span>Approve</span>
            </button>
        @else
        <button type="button" class="btn btn-success pull-right" disabled>
                <i class="material-icons">done</i>
                <span>Approved</span>
            </button>
        @endif
    </div>
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{$post->title}} 
                    <small>Post By <strong> {{$post->user->name}} </strong> on <strong>{{ $post->created_at->toFormattedDateString()}}</strong></small>
                    </h2>
                </div>
                <div class="body">
                   {!! $post->body !!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-green">
                    <h2>
                        Categories 
                    
                    </h2>
                </div>
                <div class="body">
                   @foreach ($post->categories as $category)
                       <span class="label bg-green">{!!$category->name!!}</span>
                   @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Tags 
                    
                    </h2>
                </div>
                <div class="body">
                   @foreach ($post->tags as $tag)
                       <span class="label bg-cyan">{!!$tag->name!!}</span>
                   @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-ember">
                    <h2>
                        Featured Image 
                    
                    </h2>
                </div>
                <div class="body">
                    <img class="img-responsive thumbnail" src="{!!asset('storage/post/'.$post->image)!!}" alt="{!!$post->slug!!}">
                </div>
            </div> 
        </div>
    </div>
</div>


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