@extends('Layouts.App')

@section('content')
    <form action="{{ route('register.perform') }}" method="POST">
        @csrf
        <h1 class="h3 mb-3 fw-normal">회원가입</h1>

        <div class="form-group form-floating mb-3">
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="name@email.com"
                required autofocus>
            <label for="floatingEmail">이메일</label>
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                placeholder="닉네임을 입력하세요.." required>
            <label for="floatingUsername">ID</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" name="password" class="form-control" value="{{ old('password') }}"
                placeholder="비밀번호를 입력하세요.." required>
            <label for="floatingPassword">비밀번호</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="password" name="password_confirmation" class="form-control"
                value="{{ old('password_confirmation') }}" placeholder="비밀번호를 한번 더 입력하세요.." required>
            <label for="floatingConfirmPassword">비밀번호 확인</label>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">회원가입</button>
    </form>
@endsection
