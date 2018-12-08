@extends('layouts.frontend.app')
@section('title','Welcome')
	
@push('css')
<link href="{{asset('assets/frontend/css/home/styles.css')}}" rel="stylesheet">

<link href="{{asset('assets/frontend/css/home/responsive.css')}}" rel="stylesheet">

<style>
	.favorite_posts{
		color:blue
	}
</style>
@endpush
@section('content')
<div class="main-slider">
	<div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
		data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
		data-swiper-breakpoints="true" data-swiper-loop="true" >
		<div class="swiper-wrapper">

			@foreach ($categories as $category)
			
				<div class="swiper-slide">
					<a class="slider-category" href="{!!route('post.category',$category->slug)!!}">
					<div class="blog-image"><img src="{{Storage::disk('public')->url('category/slider/'.$category->image)}}" alt="{!! $category->name!!}"></div>

						<div class="category">
							<div class="display-table center-text">
								<div class="display-table-cell">
									<h3><b>{!! $category->name !!}</b></h3>
								</div>
							</div>
						</div>

					</a>
				</div><!-- swiper-slide -->
			
				@endforeach


		</div><!-- swiper-wrapper -->

	</div><!-- swiper-container -->
</div><!-- slider -->

<section class="blog-area section">
	<div class="container">

		<div class="row">
			@foreach ($posts as $post)
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image">
								<img src="{{asset('storage/post/'.$post->image)}}" 
								alt="{!!config('app.name').' '. $post->title!!}" 
								title="{!! strtolower($post->title) !!}"></div>

							<a class="avatar" href="{!! route('post.details',$post->slug) !!}">
								<img src="{{asset('storage/profile/slider/'.$post->user->image)}}" alt="Profile {!! $post->user->name!!}" 
								title="{!! strtolower($post->title) !!}"></a>

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
									<li>
										<a href="#"><i class="ion-chatbubble"></i>{!!$post->comments()->count()!!}</a>
									</li>
									<li><a href="#"><i class="ion-eye"></i>{!! $post->view!!}</a></li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
			@endforeach



		</div><!-- row -->

		<a class="load-more-btn" href="{!! route('post.index')!!}"><b>LOAD MORE</b></a>

	</div><!-- container -->
</section><!-- section -->
@endsection

@push('swiper')
<script src="{{asset('assets/frontend/js/swiper.js')}}"></script>
@endpush