<div class="form-group form-float">
    <div class="form-line {{$errors->has('categories') ? 'focused error' : ''}}">
        {!! Form::label('categories','Select Categories')!!}
        {!! Form::select('categories[]',[$categories],[],['class'=>'form-control show-tick', 'data-live-search'=>true, 'multiple','placeholder'=>''])!!}
    </div>
    <div class="help-info">Select Min 1</div>
</div>

<div class="form-group form-float">
    <div class="form-line {{$errors->has('tags') ? 'focused error' : ''}}">
        {!! Form::label('categories','Select Tags')!!}
        {!! Form::select('tags[]',[$tags],[],['class'=>'form-control show-tick', 'data-live-search'=>true, 'multiple','placeholder'=>''])!!}
    </div>
    <div class="help-info">Select Min 1</div>
</div>

<a href="{{route('admin.post.index')}}" class="btn btn-danger m-t-15 waves-effect" >BACK</a>
{!! Form::submit('SUBMIT',['class'=>'btn btn-primary m-t-15  waves-effect'])!!}