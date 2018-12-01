@if (isset($category)&&isset($category->id))
    {!! Form::hidden('id',null,['class'=>'form-control'])!!}
@endif
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('name',null,['class'=>'form-control','value'=>old('name'), 'minlength'=>3,'maxlength'=>191,'required'=>true])!!}
        {!! Form::label('name','Category Name',['class'=>'form-label'])!!}
    </div>
    <div class="help-info">Min. 3, Max. 191 characters</div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::file('image',null,['class'=>'form-control'])!!}
        {!! Form::label('image','Category Image',['class'=>'form-label sr-only'])!!}
    </div>
    <div class="help-info">Image, Type:jpg,jpeg,png,bmp ; Max. 8000Kb </div>
    @if (isset($category)&&isset($category->image))
    <div class="thumbnail "> 
            {!! Html::image(asset('storage/category/slider/'.$category->image),null,['class'=>'img-responsive']) !!}
    </div>
    @endif
</div>
<a href="{{route('admin.category.index')}}" class="btn btn-danger m-t-15 waves-effect" >BACK</a>
{!! Form::submit('SUBMIT',['class'=>'btn btn-primary m-t-15  waves-effect'])!!}