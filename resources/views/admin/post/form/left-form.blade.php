@if (isset($post)&&isset($post->id))
    {!! Form::hidden('id',null,['class'=>'form-control'])!!}
@endif
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('title',null,['class'=>'form-control','value'=>old('title'), 'minlength'=>3,'maxlength'=>191,'required'=>true])!!}
        {!! Form::label('title','Post Title',['class'=>'form-label'])!!}
    </div>
    <div class="help-info">Min. 3, Max. 191 characters</div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::label('image','Post Image')!!}
        {!! Form::file('image',null,['class'=>'form-control'])!!}
    </div>
    <div class="help-info">Image, Type:jpg,jpeg,png,bmp ; Max. 8000Kb </div>
    @if (isset($post)&&isset($post->image))
    <div class="thumbnail "> 
            {!! Html::image(asset('storage/post/slider/'.$post->image),null,['class'=>'img-responsive']) !!}
    </div>
    @endif
</div>

<div class="form-group form-float">
    <input type="checkbox" id="publish" class="filled-in" name="status" value="1">
    <label for="publish">Publish</label>
</div>