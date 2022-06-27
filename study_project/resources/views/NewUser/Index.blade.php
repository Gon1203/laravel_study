@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example</h2>
            </div>
            <div class="pull-left">
                <a href="/newuser/create" title="Create a User" class="btn btn-success"><i class="fas fa-plus-circle"></i></a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-boredered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        @foreach ($newUsers as $newUser)
            <tr>
                <td>{{ $newUser->id }}</td>
                <td>{{ $newUser->name }}</td>
                <td>{{ $newUser->email }}</td>
                <td>
                    <form action="/newuser/{{ $newUser['email'] }}" method="POST">
                        <a href="{{ route('newuser.show', $newUser->email) }}" title="show">
                            <i class="fas fa-eye text-success fa-lg"></i>
                        </a>

                        <a href="{{ route('newuser.edit', $newUser->email) }}">
                            <i class="fas fa-edit fa-lg"></i>
                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </form>
                </td>

            </tr>
        @endforeach
    </table>
    <div class="col-lg-12 margin-tb pagination">
        {!! $newUsers->links() !!}
    </div>
@endsection
