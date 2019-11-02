@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-indigo rounded-lg shadow-xl p-6">
        <h1 class="full-width text-strong text-4xl"><a href="{{ route('index') }}">{{ __('Maxtrade Office') }}</a></h1>
        <h3 class="text-soft text-2xl pt-6">{{ __('Register') }}</h3>
        <form method="POST" action="{{ route('register') }}" class="pt-6">
                @csrf
                <div class="relative">
                    <label for="name" class="uppercase text-soft text-xs font-bold absolute pl-3 pt-2">
                        {{ __('Name') }}
                    </label>
                    <div>
                        <input id="name" type="text" class="pt-8 w-full rounded p-3 bg-blue text-strong outline-none
                        focus:bg-blue_light" name="name" value="{{ old('name') }}" autocomplete="name" autofocus
                        placeholder="{{ __('Name') }}">
                        @error('name')
                            <span class="text-red-600 text-sm pt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="relative pt-3">
                    <label for="email" class="uppercase text-soft text-xs font-bold absolute pl-3 pt-2">
                        {{ __('E-Mail Address') }}
                    </label>
                    <div>
                        <input id="email" type="email" class="pt-8 w-full rounded p-3 bg-blue text-strong outline-none
                        focus:bg-blue_light" name="email" value="{{ old('email') }}" autocomplete="email"
                        placeholder="{{ __('E-Mail') }}">
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
                    <div>
                        <input id="password" type="password" class="pt-8 w-full rounded p-3 bg-blue text-strong outline-none
                        focus:bg-blue_light" name="password" autocomplete="new-password" placeholder="{{ __('Password') }}">
                        @error('password')
                            <span class="text-red-600 text-sm pt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="relative pt-3">
                    <label for="password-confirm" class="uppercase text-soft text-xs font-bold absolute pl-3 pt-2">
                        {{ __('Confirm Password') }}
                    </label>
                    <div>
                        <input id="password-confirm" type="password" class="pt-8 w-full rounded p-3 bg-blue text-strong outline-none
                        focus:bg-blue_light" name="password_confirmation" autocomplete="new-password"
                        placeholder="{{ __('Confirm Password') }}">
                    </div>
                </div>
                <div class="pt-6">
                    <button type="submit" class="w-full py-2 px-3 text-left bg-yellow uppercase rounded font-bold
                    text-blue">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
    </div>
</div>
@endsection
