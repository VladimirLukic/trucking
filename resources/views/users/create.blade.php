@extends('layouts.app')

@section('content')

  <form action="/users" method="POST" class="row g-3">
    @csrf
      <h1>Add new user</h1>
      <div class="form-group row">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="Name" required>
      </div>
      <div class="form-group row">
        <label for="last_name" class="form-label">Last name</label>
        <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Last name" required>
      </div>
      <div class="form-group row">
        <label for="email" class="form-label">Email</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="Email" required>
      </div>
      <div class="form-group row">
        <label for="phone" class="form-label">Phone No.</label>
        <input name="phone" type="tel" class="form-control" id="phone" placeholder="phone number" required>
      </div>
      <div class="form-group row">
        <label for="role" class="form-label">Role</label>
        <input class="form-control" type="text" id="roles" placeholder="Search roles..."
        {{-- onkeyup="searchSel('roles', 'brokers')" --}}
        >
        <select name="role" class="form-control" id="select" required>
          <option value="">Select role
          @foreach ($data['roles'] as $role)
            <option value="{{ $role }}">
              {{ $role }}
              @endforeach
        </select>      
      </div>
      <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    </div>

      <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
  </form>
  
@endsection