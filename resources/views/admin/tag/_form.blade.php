<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('name',null,['class'=>'form-control','value'=>old('name'), 'minlength'=>3,'maxlength'=>191,'required'=>true])!!}
        {!! Form::label('name','Category Name',['class'=>'form-label'])!!}
    </div>
    <div class="help-info">Min. 3, Max. 191 characters</div>
</div>
<a href="{{route('admin.category.index')}}" class="btn btn-danger m-t-15 waves-effect" >BACK</a>
{!! Form::submit('SUBMIT',['class'=>'btn btn-primary m-t-15  waves-effect'])!!}