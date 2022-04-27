@extends('layouts.vasarlasapp')
@section('content')

@if (Route::has('login'))
<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block authentik">
  @auth
  <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline authinnn">Dashboard</a>
  @else
  <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline authinnn">Log in</a>
  @if (Route::has('register'))
  <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline authinnn">Register</a>
  @endif
  @endauth
</div>
@endif

@include('includes.kozosnav')
<article id="valasztek">
    <div>
        <div class="berlet">
            <img src="../kepek/berlet2.jpg" alt="avatar" class="image" style="width: 400px; height: 400px;">
            <div class="rahuzas">
                <div class="szoveg"><a href="/berletVasarlas">Bérlet</a></div>
            </div>
        </div>
    </div>
    <div></div>
    <div>
        <div class="termek">
            <div class="berlet">
                <img src="../kepek/termek.jpg" alt="avatar" class="image" style="width: 400px; height: 400px;">
                <div class="rahuzas">
                    <div class="szoveg"><a href="#">Termék</a></div>
                </div>
            </div>
        </div>
    </div>
</article>
@endsection