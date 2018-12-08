@extends('layouts.frontend.app')
@section('title')
{!!$post->title!!}
@endsection
@push('css')
<link href="{{asset('assets/frontend/css/single/styles.css')}}" rel="stylesheet">

<link href="{{asset('assets/frontend/css/single/responsive.css')}}" rel="stylesheet">

<style>
	.favorite_posts{
		color:blue
	}
	.header-bg{
		height: 400px;
		width: 100%;
		background-image: url({!! asset('storage/post/'.$post->image)!!});
		background-size:cover;
	}
	.header-bg > h1{
		color:#a81e38;
		text-align: center;
		font-family:serif;
		padding: 11.5%;
		background:rgba(100,100,100, 0.3);
	}
</style>
@endpush
@section('content')
	<div class="header-bg">
		<h1 title="{!! strtolower($post->title) !!}">{!! ucwords($post->title) !!}</h1>
	</div>

	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="{!!asset('storage/profile/slider/'.$post->user->image)!!}" alt="Profile {!! $post->user->name!!}"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{!!$post->user->name!!}</b></a>
									<h6 class="date">on {!! $post->created_at->diffForHumans() !!}</h6>
								</div>

							</div><!-- post-info -->

							<h3 class="title"><a href="#" title="{!! strtolower($post->title) !!}"><b>{!! $post->title!!}</b></a></h3>

							<div class="para">
								{!! html_entity_decode($post->body) !!}
							</div>


							<ul class="tags">
								@foreach ($post->tags as $tag)
									<li><a href="#">{{$tag->name}}</a></li>
								@endforeach
							</ul>
						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
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
											<a href="#"><i class="ion-chatbubble"></i>
												{!!$post->comments()->count()!!}
											</a>
										</li>
										<li><a href="#"><i class="ion-eye"></i>{!! $post->view!!}</a></li>
							</ul>

							<ul class="icons">
								<li>SHARE : </li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
							</ul>
						</div>

						<div class="post-footer post-info">
						<div class="left-area">
							<a class="avatar" href="#"><img src="{!!asset('storage/profile/slider/'.$post->user->image)!!}" alt="Profile {!! $post->user->name!!}"></a>
						</div>

						<div class="middle-area">
							<a class="name" href="#"><b>{!!$post->user->name!!}</b></a>
							<h6 class="date">on {!! $post->created_at->diffForHumans() !!}</h6>
						</div>
							

						</div><!-- post-info -->


					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title"><b>ABOUT AUTHOR</b></h4>
							<p>
								{!!$post->user->about!!}
							</p>
						</div>

						<div class="tag-area">

							<h4 class="title"><b>POST CATEGORIES</b></h4>
							<ul>
								@foreach ($post->categories as $category)
									<li><a href="#">{!!$category->name!!}</a></li>
								@endforeach
							</ul>

						</div><!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">
				@foreach ($randomposts as $randompost)
				
				<div class="col-lg-4 col-md-6">
						<div class="card h-100">
							<div class="single-post post-style-1">
	
								<div class="blog-image">
									<img src="{{asset('storage/post/'.$randompost->image)}}"
									 alt="{!! config('app.name') .' ' . $randompost->title !!}" 
									 title="{!! strtolower($randompost->title) !!}">
								</div>
	
								<a class="avatar" href="{!! route('post.details',$randompost->slug) !!}">
									<img src="{{asset('storage/profile/slider/'.$randompost->user->image)}}" 
									alt="Profile {!!$randompost->user->name !!}" 
									title="{!! strtolower($randompost->title) !!}"></a>
	
								<div class="blog-info">
	
									<h4 class="title">
										<a href="{!! route('post.details',$randompost->slug) !!}" 
												title="{!! strtolower($randompost->title) !!}"><b>{!! $randompost->title !!}</b></a>
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
											onclick="document.getElementById('favorite-form-{!! $randompost->id !!}').submit();" 
											class="{!! !auth()->user()->favorite_posts()->where('post_id',$randompost->id)->count() == 0 ? 'favorite_posts' :''!!} ">
												<i class="ion-heart"></i>{!! $randompost->favorite_to_users->count()!!}
											</a>
											
											{!! Form::open(['route'=>['post.favorite',$randompost->id],'id'=>'favorite-form-'.$randompost->id,'style'=>'display:none;'])!!}
											{!! Form::close()!!}
											@endguest
										</li>
										<li>
											<a href="#"><i class="ion-chatbubble"></i>{!!$randompost->comments()->count()!!}
											</a>
										</li>
										<li><a href="#"><i class="ion-eye"></i>{!! $randompost->view!!}</a></li>
									</ul>
	
								</div><!-- blog-info -->
							</div><!-- single-post -->
						</div><!-- card -->
					</div><!-- col-lg-4 col-md-6 -->
					
				@endforeach

			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			<h4><b>POST COMMENT</b></h4>
			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="comment-form">
						@guest
							<p>
								For Post a new comment. You need to login. first. 
								<a href="{!!route('login')!!}" class="btn btn-link">Login</a>
							</p>
						@else
							<form method="post" action="{!! route('post.comment',$post->id)!!}">
								@csrf
								<div class="row">
									<div class="col-sm-12">
										<textarea name="comment" rows="2" class="text-area-messge form-control"
											placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
									</div><!-- col-sm-12 -->
									<div class="col-sm-12">
										<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
									</div><!-- col-sm-12 -->
	
								</div><!-- row -->
							</form>
						@endguest
					</div><!-- comment-form -->

					<h4><b>COMMENTS( {{$post->comments()->count()}})</b></h4>

					<div class="commnets-area" id="comments">
						@if ($post->comments()->count() > 0)
						@foreach ($post->comments as $comment)
							<div class="comment" id="comment-{!!$comment->id!!}">

								<div class="post-info">

									<div class="left-area">
										<a class="avatar" href="#"><img src="{!! asset('storage/profile/slider/'.$comment->user->image)!!}" alt="Profile Image"></a>
									</div>

									<div class="middle-area">
										<a class="name" href="#"><b>{!! $comment->user->name!!}</b></a>
										<h6 class="date">on {!! $comment->created_at->diffForHumans()!!}</h6>
									</div>

									<div class="right-area">
										<h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
									</div>

								</div><!-- post-info -->

								<p>
									{!!$comment->comment!!}
								</p>

							</div>
							@endforeach
								
						@else
							<div class="comment">
									<p>No Coment yet. Be the first :)</p>
							</div>
						@endif
					</div><!-- commnets-area -->

				

					{{-- <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a> --}}

				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>

@endsection

@push('swiper')

@endpush