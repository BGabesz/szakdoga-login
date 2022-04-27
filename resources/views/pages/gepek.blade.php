@extends('layouts.gepekapp')
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
<article class="elemek">
    
</article>
<aside id="k_mezo">
    <form>
    @include('includes.rendezés')
    </form>
    <div id="navig"></div>
</aside>

@endsection