@extends('Layouts.App')
@section('content')
    <style>
        .table td,
        th {
            text-align: center;
        }
    </style>
    <div class="row">
        <div class="col-4 mt-4">
            <h2>최근 작성 게시물</h2>
            <table class="table">
                <tr class="bg-primary text-white">
                    <th>no</th>
                    <th>title</th>
                    <th>writer</th>
                    <td></td>
                </tr>
                @foreach ($boards as $board)
                    <tr>
                        <td>{{ $board->id }}</td>
                        <td>{{ $board->title }}</td>
                        <td>{{ $board->writer }}</td>
                        <td><a href="/board/{{ $board->id }}" class="btn btn-sm btn-success">이동</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-4">

        </div>
    </div>
@endsection
