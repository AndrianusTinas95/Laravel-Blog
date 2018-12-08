@extends('layouts.backend.app')
@push('css')
<!-- JQuery DataTable Css -->
<link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush
@section('title','Comments')

@section('content')

    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center">Comment Info</th>
                                        <th class="text-center">Post Info</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center">Comment Info</th>
                                        <th class="text-center">Post Info</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($posts as $post)
                                        @foreach ($post->comments as $i=> $comment)
                                            <tr>
                                                <td>{{$i+1}}</td>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href=""><img src="{!!asset('storage/profile/slider/'.$comment->user->image)!!}" alt="" class="media-object" width="64" height="64">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            {{$comment->user->name}}
                                                            <h4 class="media-heading">
                                                            <small>{{ $comment->created_at->diffForHumans()}}</small>
                                                            </h4>
                                                            <p>
                                                                {{$comment->comment}}
                                                            </p>
                                                            <a target="_blank" href="{!!route('post.details',$comment->post->slug .'#comment-'.$comment->id)!!}">Reply</a>
                                                        </div> 
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-right">
                                                            <a target="_blank" href="{!!route('post.details',$comment->post->slug)!!}">
                                                                <img src="{!!asset('storage/post/slider/'.$comment->post->image)!!}" alt="" class="media-object" width="64" height="64">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <a target="_blank" href="{!!route('post.details',$comment->post->slug)!!}">
                                                                <h4 class="media-heading">{{str_limit($comment->post->title,40)}}</h4>
                                                            </a>
                                                                <p>
                                                                    by <strong>{{$comment->post->user->name}}
                                                                        <small>{{ $comment->post->created_at->diffForHumans()}}</small>
                                                                    </strong>
                                                                </p>
                                                        </div> 
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" 
                                                        class="btn btn-danger waves-effect"
                                                        onclick="deleteComment({{$comment->id}})"
                                                        >
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                    <form id="comment-form-{{$comment->id}}" 
                                                        action="{{route('author.comment.destroy',$comment->id)}}" 
                                                        method="POST"
                                                        style="display:none;"
                                                        >
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
    

</body>

</html>

@endsection
@push('js')
    
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

@endpush
@push('script')
    <script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
    <script>
        function deleteComment(id){
            const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            })

            swalWithBootstrapButtons({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('comment-form-'+id).submit();
                swalWithBootstrapButtons(
                'Deleted!',
                'Your data been deleted.',
                'success'
                )
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Cancelled',
                'Your data is safe :)',
                'error'
                )
            }
            })
        }
       
    </script>
@endpush