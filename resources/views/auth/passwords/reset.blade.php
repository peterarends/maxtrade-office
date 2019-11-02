@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
        <h1 class="full-width text-white text-4xl"><a href="{{ route('index') }}">{{ __('Maxtrade Office') }}</a></h1>
        <h3 class="text-white text-2xl pt-6">{{ __('Reset Password') }}</h3>
        <form method="POST" action="{{ route('password.update') }}" class="pt-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="relative">
                    <label for="email" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">
                        {{ __('E-Mail Address') }}
                    </label>
                    <div class="">
                        <input id="email" type="email" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none
                        focus:bg-blue-700" name="email" value="{{ $email ?? old('email') }}" autocomplete="email"
                        autofocus>
                        @error('email')
                            <span class="text-red-600 text-sm pt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="relative pt-3">
                    <label for="password" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">
                        {{ __('Password') }}
                    </label>
                    <div class="">
                        <input id="password" type="password" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none
                        focus:bg-blue-700" name="password" autocomplete="new-password" placeholder="{{ __('your new password') }}">
                        @error('password')
                            <span class="text-red-600 text-sm pt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="relative pt-3">
                    <label for="password-confirm" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">
                        {{ __('Confirm Password') }}
                    </label>
                    <div class="">
                        <input id="password-confirm" type="password" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none
                        focus:bg-blue-700" name="password_confirmation" autocomplete="new-password"
                        placeholder="{{ __('confirm your new password') }}">
                    </div>
                </div>
                <div class="pt-6">
                    <button type="submit" class="w-full py-2 px-3 text-left bg-gray-400 uppercase rounded font-bold
                    text-blue-800">
                        {{ __('Reset password') }}
                    </button>
                </div>
            </form>
    </div>
</div>
@endsection
