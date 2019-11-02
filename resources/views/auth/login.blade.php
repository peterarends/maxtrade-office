@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-indigo rounded-lg shadow-xl p-6">
        <h1 class="full-width text-strong text-4xl"><a href="{{ route('index') }}">{{ __('Maxtrade Office') }}</a></h1>
        <h2 class="text-strong text-2xl pt-6">{{ __('Welcome Back') }}</h2>
        <h3 class="text-soft">{{ __('Enter your credentials below') }}</h3>
        <form method="POST" action="{{ route('login') }}" class="pt-6">
            @csrf
            <div class="relative">
                <label for="email" class="uppercase text-soft text-xs font-bold absolute pl-3 pt-2">
                    {{ __('E-Mail Address') }}
                </label>
                <div class="">
                    <input id="email" type="email" class="pt-8 w-full rounded p-3 bg-blue text-strong outline-none
                    focus:bg-blue_light" name="email" value="{{ old('email') }}" autocomplete="email" autofocus
                    placeholder="{{ __('your@mail.com') }}">
                    @error('email')
                        <span class="text-red-600 text-sm pt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="relative pt-3">
                <label for="password" class="uppercase text-soft text-xs font-bold absolute pl-3 pt-2">
                    {{ __('Password') }}
                </label>
                <div class="">
                    <input id="password" type="password" class="pt-8 w-full rounded p-3 bg-blue text-strong outline-none
                    focus:bg-blue_light" name="password" autocomplete="current-password"
                    placeholder="{{ __('Password') }}">
                    @error('password')
                        <span class="text-red-600 text-sm pt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="pt-2">
                <input class="" type="checkbox" name="remember" id="remember"
                {{ old('remember') ? 'checked' : '' }}>
                <label class="text-white" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <div class="pt-6">
                <button type="submit" class="w-full py-2 px-3 text-left bg-yellow uppercase rounded font-bold
                text-blue">
                    {{ __('Login') }}
                </button>
            </div>
            <div class="flex justify-between pt-6 text-strong text-sm font-bold">
                <a class="" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                <a class="" href="{{ route('register') }}">
                    {{ __('Register') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
