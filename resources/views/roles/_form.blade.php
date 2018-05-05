<div class="row">
    <div class="col-md-8">
        <div class="form-group row">
            <label for="role-name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="role-name" value="{{ $role ? $role->name : old('name') }}" autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="role-description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea name="description" rows="3" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="role-description">{{ $role ? $role->description : old('description') }}</textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <h4>Permissions:</h4>
        @if (count($permissions) > 0)
            @foreach ($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" {{ in_array($permission->id, $role_permissions) ? 'checked' : '' }} value="{{ $permission->id }}" id="{{ $permission->id }}">
                    <label class="form-check-label" for="{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
            @endforeach
        @endif
    </div>
</div>