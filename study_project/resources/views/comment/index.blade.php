<table class="table">
    @foreach ($comments as $comment)
        <tr class="table-success">
            <th>작성자</th>
            <td>{{ $comment->writer }}</td>
            <th>작성일</th>
            <td>{{ $comment->created_at }}</td>
            @if ($comment->writer == auth()->user()->username)
                <td>
                    <form action="/comment/{{ $comment->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">삭제</button>
                    </form>
                </td>
            @endif
        </tr>
        <tr>
            <td colspan="4">{{ $comment->content }}</td>
        </tr>
    @endforeach
</table>

@auth
    <div class="row">
        <form action="/comment" method="POST">
            @csrf
            <input type="hidden" name="board_id" value="{{ $board->id }}">
            <label for="writer">작성자</label>
            <input type="text" name="writer" value="{{ auth()->user()->username }}" readonly>
            <label for="content">내용</label>
            <textarea name="content" id="content" required cols="30" rows="10"></textarea>
            <button type="submit" class="btn btn-sm btn-primary">작성</button>
        </form>
    </div>
@endauth
