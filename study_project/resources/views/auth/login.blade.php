@extends('Layouts.App')

@section('content')
    <div>
        <form action="{{ route('login.perform') }}" method="POST">
            @csrf
            <h1 class="h3 mb-3 fw-normal">로그인</h1>

            <div class="form-group form-floating mb-3">
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username"
                    required>
                <label for="floatingUsername">닉네임</label>
                @if ($errors->has('username'))
                    <span class="test-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>
            <div class="form-group form-floating mb-3">
                <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                    placeholder="Password" required>
                <label for="floatingUsername">비밀번호</label>
                @if ($errors->has('password'))
                    <span class="test-danger text-left">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <button class="btn btn-lg btn-primary">로그인</button>
        </form>
    </div>
@endsection
