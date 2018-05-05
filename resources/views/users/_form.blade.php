<div class="row">
    <div class="col-md-8">
        <div class="form-group row">
            <label for="user-first-name" class="col-sm-4 col-form-label">First Name</label>
            <div class="col-sm-8">
                <input name="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="user-first-name" value="{{ $user && $user->profile ? $user->profile->first_name : old('first_name') }}" autofocus>
                @if ($errors->has('first_name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="user-last-name" class="col-sm-4 col-form-label">Last Name</label>
            <div class="col-sm-8">
                <input name="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="user-last-name" value="{{ $user && $user->profile ? $user->profile->last_name : old('last_name') }}">
                @if ($errors->has('last_name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="user-mobile" class="col-sm-4 col-form-label">Mobile</label>
            <div class="col-sm-8">
                <input name="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" id="user-mobile" value="{{ $user && $user->profile ? $user->profile->mobile : old('mobile') }}">
                @if ($errors->has('mobile'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('mobile') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="user-address" class="col-sm-4 col-form-label">Address</label>
            <div class="col-sm-8">
                <textarea name="address" rows="3" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="user-address">{{ $user && $user->profile ? $user->profile->address : old('address') }}</textarea>
                @if ($errors->has('address'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        @empty ($user)
            <div class="form-group row">
                <label for="user-email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="user-email" value="{{ $user ? $user->email : old('email') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="user-password" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8">
                    <input name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="user-password">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="user-password-confirm" class="col-sm-4 col-form-label">Confirm Password</label>
                <div class="col-sm-8">
                    <input name="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="user-password-confirm">
                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        @endempty
    </div>
    <div class="col-md-4">
        <h4>Roles:</h4>
        @if (count($roles) > 0)
            @foreach ($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" {{ in_array($role->id, $user_roles) ? 'checked' : '' }} value="{{ $role->id }}" id="{{ $role->id }}">
                    <label class="form-check-label" for="{{ $role->id }}">{{ $role->name }}</label>
                </div>
            @endforeach
        @endif
    </div>
</div>