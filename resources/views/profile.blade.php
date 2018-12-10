@extends('layouts.frontend.app')
@section('title','Profile' )

@push('css')
<link href="{{asset('assets/frontend/css/profile/styles.css')}}" rel="stylesheet">

<link href="{{asset('assets/frontend/css/profile/responsive.css')}}" rel="stylesheet">

<style>
	.favorite_posts{
		color:blue
	}
</style>
@endpush
@section('content')
<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>{!! $author->name!!}</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-12">
                    <div class="row">
                            @if ($posts->count()> 0)
                                @foreach ($posts as $post)
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card h-100">
                                            <div class="single-post post-style-1">
            
                                                <div class="blog-image">
                                                    <img src="{{asset('storage/post/'.$post->image)}}" 
                                                    alt="{!!config('app.name').' '. $post->title!!}" 
                                                    title="{!! strtolower($post->title) !!}"></div>
            
                                                <a class="avatar" href="{!! route('post.author.profile',$post->user->username) !!}">
                                                    <img src="{{asset('storage/profile/slider/'.$post->user->image)}}" alt="Profile {!! $post->user->name!!}" 
                                                    title="{!! strtolower($post->user->name) !!}"></a>
            
                                                <div class="blog-info">
            
                                                    <h4 class="title">
                                                        <a href="{!! route('post.details',$post->slug) !!}" 
                                                            title="{!! strtolower($post->title) !!}"><b>{!! $post->title !!}</b></a>
                                                    </h4>
            
                                                    <ul class="post-footer">
                                                        <li>
                                                            @guest
                                                            <a href="javascript:void(0)" onclick="toastr.info('To add favorite list. You need to login first.', 'Info',{
                                                                closeButton:true,
                                                                progressBar:true,
                                                            })"><i class="ion-heart"></i>{!! $post->favorite_to_users->count()!!}</a>
                                                            @else
                                                            <a href="javascript:void(0)" 
                                                            onclick="document.getElementById('favorite-form-{!! $post->id !!}').submit();" 
                                                            class="{!! !auth()->user()->favorite_posts()->where('post_id',$post->id)->count() == 0 ? 'favorite_posts' :''!!} ">
                                                                <i class="ion-heart"></i>{!! $post->favorite_to_users->count()!!}
                                                            </a>
                                                            
                                                            {!! Form::open(['route'=>['post.favorite',$post->id],'id'=>'favorite-form-'.$post->id,'style'=>'display:none;'])!!}
                                                            {!! Form::close()!!}
                                                            @endguest
                                                        </li>
                                                        <li><a href="#"><i class="ion-chatbubble"></i>{!!$post->comments()->count()!!}</a>
                                                        </li>
                                                        <li><a href="#"><i class="ion-eye"></i>{!! $post->view!!}</a></li>
                                                    </ul>
            
                                                </div><!-- blog-info -->
                                            </div><!-- single-post -->
                                        </div><!-- card -->
                                    </div><!-- col-lg-4 col-md-6 -->
                                @endforeach
                            @else
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card h-100">
                                        <div class="single-post post-style-1">
                                            <div class="blog-info">
                                                <h4 class="title">
                                                    <strong>Sorry, No post found :( </strong>
                                                </h4>
                                            </div><!-- blog-info -->
                                        </div><!-- single-post -->
                                    </div><!-- card -->
                                </div><!-- col-lg-4 col-md-6 -->
                            @endif
                                
            
                        </div><!-- row -->
            
                        {{$posts->links()}}

            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12 ">

                <div class="single-post info-area ">

                    <div class="about-area">
                        <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                        <p>{!! $author->name !!}</p><br>
                        <p>{!! $author->about !!}</p><br>
                        <strong>Author Since : {!! $author->created_at->toDateString() !!}</strong><br>
                        <strong>Total Posts : {!! $author->posts->count() !!}</strong><br>
                    </div>

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- section -->




@endsection

@push('swiper')

@endpush