@extends('layouts.app')

@section('content')

    <x-Crud.Table >

        <tr>
			@foreach($data['columns'] as $column)
				<th>{{$column}}</th>
			@endforeach
			<th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $data['user']->name.' '. $data['user']->last_name }}</td>
            <td>
                <a href="mailto:{{$data['user']->email}}">{{ $data['user']->email }}</a><br>
            </td>
            <td>
                    <a href="phone:{{$data['user']->phone}}">{{ $data['user']->phone }}</a> 
            </td>
            <td>{{ $data['user']->role }}</td>
            <td>
                <a href="/users/{{$data['user']->id}}/edit" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form id="del_form" class='float-end' method="POST" action="/users/{{$data['user']->id}}">
                    @csrf
                    @method('DELETE')
                    <button id="del" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
                
    </x-Crud.Table >                        
@endsection
