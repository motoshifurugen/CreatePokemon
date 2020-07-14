<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ポケモン') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('ポケモン', 'ポケモン') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>

<form method="POST" action="/pokemons/{{ $pokemon->id }}">
    @method('PUT')
    {{ csrf_field() }}
    <table border="1" cellspacing="0" cellpadding="5">
      <tr>
          <th>名前</th>
          <td>
              <input type="text" name="pokemon_name" value="{{ $pokemon->pokemon_name }}" require>
          </td>
      </tr>
      <tr>
        <th>タイプ</th>
        <td>
        <select name="attribute">
          @foreach ($attributes as $key => $val)
            <option value="{{ $key }}" @if($pokemon->attribute == $key) selected @endif>{{ $val }}</option>
          @endforeach
        </select>
        </td>
      </tr>
      <tr>
        <th>地方</th>
        <td>
        <select name="region">
          @foreach ($regions as $key => $val)
            <option value="{{ $key }}" @if($pokemon->region == $key) selected @endif>{{ $val }}</option>
          @endforeach
        </select>
        </td>
      </tr>
      <tr>
        <th>高さ</th>
        <td>
          <input type="number" name="size" value="{{ $pokemon->size }}" require>
        </td>
      </tr>
      <tr>
        <th>重さ</th>
        <td>
          <input type="number" name="weight" value="{{ $pokemon->weight }}" require>
        </td>
      </tr>
      <tr>
        <th>技の名前</th>
        <td>
            <input type="text" name="attack_name" value="{{ $pokemon->attack_name }}">
        </td>
      </tr>
      <tr>
        <th>技の説明</th>
        <td>
          <textarea name="attack_description">{{ $pokemon->attack_description }}</textarea>
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <button type="submit" >書き換える</button>
        </td>
      </tr>
    </table>
  </form>

  <a href="/pokemons">戻る</a>

</body>
</html>
