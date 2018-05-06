<div class="row">
    <div class="col-md-10">
        <div class="form-group row">
            <label for="post-title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="post-title" value="{{ $post ? $post->title : old('title') }}" autofocus>
                @if ($errors->has('title'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="post-content" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-10">
                <textarea name="content" rows="3" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" id="post-content">{{ $post ? $post->content : old('content') }}</textarea>
                @if ($errors->has('content'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="post-publish" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="publish" {{ $post && $post->published != null ? 'checked' : '' }} id="post-publish">
                    <label class="form-check-label" for="post-publish">Do you want to publish this post?</label>
                </div>
            </div>
        </div>
    </div>
</div>