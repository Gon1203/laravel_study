@extends('Layouts.App')

@section('content')
    <div class="row">
        <h2 class="mt-3">새 게시물 작성</h2>
        <form action="/board" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row form-group mt-3">
                <div class="mx-auto">
                    <div class="col-xs-12">
                        <input type="text" name="title" class="form-control" placeholder="제목" required>
                    </div>
                    <div class="col-xs-12">
                        <input type="text" name="writer" class="form-control" value="{{ auth()->user()->username }}"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="file" name="image">
                    </div>
                    <div class="mb-3">
                        <textarea placeholder="내용을 작성하세요" class="form-control" name="content" id="boardContent" cols="30" rows="10"
                            required></textarea>
                    </div>
                    <button class="btn btn-sm btn-primary" type="submit">제출</button>
                </div>
            </div>
        </form>

    </div>
@endsection
