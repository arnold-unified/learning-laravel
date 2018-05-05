<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label for="permission-name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-8">
                <input name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="permission-name" value="{{ $permission ? $permission->name : old('name') }}" autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="permission-description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-8">
                <textarea name="description" rows="3" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="permission-description">{{ $permission ? $permission->description : old('description') }}</textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>