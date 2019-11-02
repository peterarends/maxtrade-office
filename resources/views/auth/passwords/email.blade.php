@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-indigo rounded-lg shadow-xl p-6">
        <h1 class="full-width text-strong text-4xl"><a href="{{ route('index') }}">{{ __('Maxtrade Office') }}</a></h1>
        <h3 class="text-soft text-2xl pt-6">{{ __('Reset Password') }}</h3>
        <div class="pt-6">
                @if (session('status'))
                    <div class="text-red-600" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}" class="pt-6">
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
                    <div class="pt-6">
                        <button type="submit" class="w-full py-2 px-3 text-left bg-yellow uppercase rounded font-bold
                        text-blue">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
    </div>
</div>
@endsection
