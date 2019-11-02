@extends('layouts.app-index')

@section('content')
<div class="text-gray-800 leading-normal flex flex-col min-h-screen">
    <header class="border-t-14 border-blue">
        <nav class="container mx-auto flex flex-col sm:flex-row justify-between items-center py-6">
            <a href="{{ route('index') }}">
                <span class="text-2xl font-bold text-soft">MAXTRADE</span>
                <span class="text-2xl font-bold text-yellow">OFFICE</span>
            </a>
            <ul class="uppercase tracking-wide font-bold flex mx-auto sm:mx-0 items-center mt-2 sm:mt-0">
                <li class="px-4">
                    <a href="{{ route('login') }}" class="text-strong hover:text-soft">
                        {{ __('Login') }}
                    </a>
                </li>
                <li class="px-4">
                    <a href="{{ route('register') }}" class="text-strong hover:text-soft">
                        {{ __('Register') }}
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="flex-grow">
        <div class="hero container mx-auto flex flex-col sm:flex-row justify-between py-4 sm:py-12">
            <div class="w-full sm:w-3/5 text-center sm:text-left">
                <div class="text-4xl font-bold text-strong">{{ __('MaxtradeOffice') }}</div>
                <div class="text-2xl font-bold text-strong">{{ __('Simple Projects & Tasks Manager') }}</div>
                <div class="text-xl text-soft">
                    {{ __('It is online platform created as open source software distributed free of charge under the
                    terms of the GNU General Public License. Support is available only on E-Mail. For using MaxtradeOffice
                    , no restrictions apply. This online platform is distributed in the hope that it will be useful,
                    but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
                    PARTICULAR PURPOSE.') }}
                </div>
            </div>
            <div class="mt-6 sm:mt-0">
                <img src="/images/projects.svg" class="max-w-sm mx-auto sm:mx-0" alt="MaxtradeOffice">
            </div>
        </div>
        <div class="container mx-auto flex flex-col sm:flex-row pt-6 sm:pt-0 pb-6 sm:pb-0 justify-between">
            <a href="{{ route('login') }}" class="w-auto sm:w-2/5 m-4 sm:m-0 py-2 px-3 text-3xl text-center bg-yellow uppercase rounded font-bold
            text-indigo">
                {{ __('Login') }}
            </a>
            <a href="{{ route('register') }}" class="w-auto sm:w-2/5 m-4 sm:m-0 py-2 px-3 text-3xl text-center bg-yellow uppercase rounded font-bold
            text-indigo">
                {{ __('Register') }}
            </a>
        </div>
    </div>
    <footer class="bg-blue text-strong py-4">
        <div class="container mx-auto flex flex-col sm:flex-row items-center justify-between">
            <div>{{ __('Copyright 2019. All rights reserved') }}</div>
            <ul class="flex items-center mx-auto sm:mx-0">
                <li class="px-4">
                    <a href="https://avalonbg.com" class="hover:text-soft" target="_blank" title="{{ __('Powered by Avalon') }}">
                        <i class="mdi mdi-alpha-a-circle text-4xl"></i>
                    </a>
                </li>
                <li class="px-4">
                    <a href="https://www.facebook.com/AvalonLtd" class="hover:text-soft" target="_blank" title="{{ __('Follow us on Facebook') }}">
                        <i class="mdi mdi-facebook text-4xl"></i>
                    </a>
                </li>
                <li class="px-4">
                    <a href="https://www.youtube.com/channel/UCk_GQ6HDBdWHoK2SaVfkuwA" class="hover:text-soft" target="_blank"
                    title="{{ __('Follow us on YouTube') }}">
                        <i class="mdi mdi-youtube text-4xl"></i>
                    </a>
                </li>
                <li class="px-4">
                    <a href="" target="_blank" class="hover:text-soft" title="{{ __('Send Us e-mail') }}">
                        <i class="mdi mdi-email-edit text-4xl"></i>
                    </a>
                </li>
            </ul>
        </div>
    </footer>
</div>
@endsection
