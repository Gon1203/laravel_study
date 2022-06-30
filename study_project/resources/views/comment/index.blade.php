<div class="row">
    <table class="table col-4 mx-auto" style="width: 80%">
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
                <td colspan="4"><span style="word-break: break-all;">{{ $comment->content }}</span></td>
            </tr>
            @if ($replys != null)
                <tr>
                    <th>답글</th>
                </tr>
                @foreach ($replys as $reply)
                    @if ($reply->group_id == $comment->group_id)
                        <tr class="bg-primary text-white">
                            <th>작성자</th>
                            <td>{{ $reply->writer }}</td>
                            <th>작성일</th>
                            <td>{{ $reply->created_at }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"><span style="word-break: break-all;">{{ $reply->content }}</span>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
            <tr>
                @if ($comment->depth == 0)
                    @auth
                        <td>
                            <div class="sonCommentForm p-2" style="border: 1px black solid">
                                <form action="{{ route('comment.write') }}" method="POST" class="">
                                    <h2>답글 작성</h2>
                                    @csrf
                                    <div class="row form-group mx-auto">
                                        <input type="hidden" name="mode" value="1">
                                        <input type="hidden" name="board_id" value="{{ $board->id }}">
                                        <input type="hidden" name="group_id" value="{{ $comment->group_id }}">
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <label for="writer">작성자</label>
                                        <input class="form-control" type="text" name="writer"
                                            value="{{ auth()->user()->username }}" readonly>
                                        <label for="content">내용</label>
                                        <textarea class="form-control" name="content" id="content" required cols="30" rows="3" maxlength="200"></textarea>
                                        <button type="submit" class="btn btn-sm btn-primary col-7 mt-2">작성</button>
                                    </div>
                                </form>
                            </div>

                        </td>
                    @endauth
                @endif
            </tr>
        @endforeach
    </table>
</div>

@auth
    <div class="row">
        <form action="{{ route('comment.write') }}" method="POST">
            @csrf
            <div class="form-group col-7 mx-auto" style="width: 80%">
                <input type="hidden" name="board_id" value="{{ $board->id }}">
                <input type="hidden" name="mode" value="0">
                <label for="writer">작성자</label>
                <input class="form-control" type="text" name="writer" value="{{ auth()->user()->username }}"
                    readonly>
                <label for="content">내용</label>
                <textarea class="form-control" name="content" id="content" required cols="30" rows="6" maxlength="200"></textarea>
                <button type="submit" class="btn btn-sm btn-primary col-7 mt-2">작성</button>
            </div>
        </form>
    </div>
@endauth
