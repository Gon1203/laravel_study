@extends('Layouts.App')

@section('content')
    <div class="row">
        <form action="/board" method="POST">
            @csrf
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="title">제목 : </label>
                    <input type="text" name="title" class="form-controll">
                </div>
                <div class="col-xs-12">
                    <label for="writer">작성자</label>
                    <input type="text" name="writer" class="form-controll" value="{{ auth()->user()->username }}"
                        readonly>
                </div>
                <div class="mb-3">
                    <label for="boardContent" class="form-label">내용 : </label>
                    <textarea class="form-controller" name="content" id="boardContent" cols="30" rows="10"></textarea>
                </div>
                <button class="btn btn-sm btn-primary" type="submit">제출</button>

            </div>
        </form>

    </div>
@endsection
