@extends('base')


@section('content')
    <h1>Se connecter</h1>

    <div class="card">
        <div class="card-body m-3">
            <form action="{{ route('blog.auth.login') }}" class="vstack gap-3" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="passwordl">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>

                <button class="btn btn-warning">Se connecter</button>


            </form>
        </div>
    </div>
@endsection
