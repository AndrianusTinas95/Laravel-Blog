<div class="row clearfix">
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    @if (isset($post))
                    EDIT POST
                    @else
                    ADD NEW POST
                    @endif
                </h2>
            </div>
            <div class="body">
                @include('admin.post.form.left-form')
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Categories and Tags</h2>
            </div>
            <div class="body">
                @include('admin.post.form.right-form')
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>BODY</h2>
            </div>
            <div class="body"> 
                <textarea name="body" id="tinymce" cols="30" rows="10">
                    {{isset($post)?$post->body:''}}
                </textarea>
            </div>
        </div>
    </div>
</div>


