@extends('layouts.app')

@section('content')

<form action="/users/{{ $data['users']->id }}" method="POST" class="row g-3">
  @csrf
      <h1>Edit user</h1>
      <div class="form-group row">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" value="{{ $data['users']->name }}" class="form-control" id="name" placeholder="Name" required>
      </div>
      <div class="form-group row">
        <label for="last_name" class="form-label">Last name</label>
        <input name="last_name" type="text" value="{{ $data['users']->last_name }}" class="form-control" id="last_name" placeholder="Last name" required>
      </div>
      <div class="form-group row">
        <label for="email" class="form-label">Email</label>
        <input name="email" type="email" value="{{ $data['users']->email }}" class="form-control" id="email" placeholder="Email" required>
      </div>
      <div class="form-group row">
        <label for="phone" class="form-label">Phone No.</label>
        <input name="phone" type="tel" value="{{ $data['users']->phone }}" class="form-control" id="phone" placeholder="phone number" required>
      </div>
      <div class="form-group row">
        <label for="role" class="form-label">Role</label>
        <input class="form-control" type="text" id="roles" 
        onkeyup="searchSel('roles', 'brokers')">
        <select name="role" class="form-control" id="select" required>
          <option value="{{ $data['users']->role }}">
            {{ $data['users']->role}}
          @foreach ($data['roles'] as $role)
            <option value="{{ $role }}">
              {{ $role }}
              @endforeach
        </select>      
      </div>
    @method('PATCH')

      <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
  </form>
  
@endsection