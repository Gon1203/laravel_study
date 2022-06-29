@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example</h2>
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
            <th>제목</th>
            <th>작성자</th>
            <th>작성일</th>
        </tr>
        @foreach ($boards as $board)
            <tr>
                <td>{{ $board->id }}</td>
                <td>
                    <a href="{{ route('board.show', $board->id) }}" title="show">
                        {{ $board->title }}
                    </a>
                </td>
                <td>
                    {{ $board->writer }}
                </td>
                <td>{{ $board->created_at }}</td>
                <td>
                    <form action="/board/{{ $board['id'] }}" method="POST">
                        <a href="{{ route('board.edit', $board->id) }}">
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
    <div class="pull-left">
        <a href="/board/create" title="Create a Board" class="btn btn-success"><i class="fas fa-plus-circle"></i></a>
    </div>
    <div class="col-lg-12 margin-tb pagination">
        {!! $boards->links() !!}
    </div>
@endsection
