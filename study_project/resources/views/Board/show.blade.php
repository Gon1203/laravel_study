@extends('Layouts.App')

@section('content')
    <table class="table">
        <tr class="table-primary">
            <th>제목 : {{ $board->title }}</th>
            <th>작성자 : {{ $board->writer }}</th>
            <th>작성일 : {{ $board->created_at }}</th>
        </tr>
        <tr style="height: 30em">
            <td colspan="3"><span style="overflow: scroll;">{{ $board->content }}</span></td>
        </tr>
    </table>
    @include('comment.index')
@endsection
