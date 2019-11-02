@extends('layouts.app-index')

@section('content')
<div class="text-gray-800 leading-normal flex flex-col min-h-screen">
    <header class="border-t-14 border-blue-600">
        <nav class="container mx-auto flex justify-between items-center py-8">
            <a href="{{ route('index') }}">
                <span class="text-2xl font-bold text-blue-800">MAXTRADE</span>
                <span class="text-2xl font-bold text-red-800">OFFICE</span>
            </a>
            <ul class="uppercase tracking-wide font-bold flex items-center">
                <li class="mr-8 text">
                    <a href="{{ route('login') }}" class="text-gray-800 hover:text-gray-600">
                        {{ __('Login') }}
                    </a>
                </li>
                <li class="mr-8 text">
                    <a href="{{ route('register') }}" class="text-gray-800 hover:text-gray-600">
                        {{ __('Register') }}
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="flex-grow">
        <body>
            <span class="mdi mdi-home"></span>
        </body>
    </div>
    <footer class="bg-blue-600 text-white">
        <div class="container mx-auto flex items-center justify-between py-4">
            <div>{{ __('Copyright 2019. All rights reserved') }}</div>
            <ul class="flex items-center">
                <li class="mr-6">
                    <a href="https://avalonbg.com" target="_blank" title="{{ __('Powered by Avalon') }}">
                        <i class="mdi mdi-alpha-a-circle text-4xl"></i>
                    </a>
                </li>
                <li class="mr-6">
                    <a href="https://www.facebook.com/AvalonLtd" target="_blank" title="{{ __('Follow us on Facebook') }}">
                        <i class="mdi mdi-facebook text-4xl"></i>
                    </a>
                </li>
                <li class="mr-6">
                    <a href="https://www.youtube.com/channel/UCk_GQ6HDBdWHoK2SaVfkuwA" target="_blank"
                    title="{{ __('Follow us on YouTube') }}">
                        <i class="mdi mdi-youtube text-4xl"></i>
                    </a>
                </li>
                <li class="mr-6">
                    <a href="" target="_blank" title="{{ __('Send Us e-mail') }}">
                        <i class="mdi mdi-email-edit text-4xl"></i>
                    </a>
                </li>
            </ul>
        </div>
    </footer>
</div>
@endsection
