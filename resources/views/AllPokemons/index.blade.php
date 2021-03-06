<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('ポケモン', 'ポケモン') }}</title>

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
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
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

    <br />
    <h3>みんなのポケモンページ</h3>
    <br />

  <form action="/allpokemons">
    <table border="1" cellspacing="0" cellpadding="5">
      <tr>
        <th>タイプ</th>
        <td>
            @foreach($attributes as $key => $val)
            <input type="checkbox" name="attribute[]" value="{{ $key }}" @if(request('attribute') && in_array($key, request('attribute'))) checked @endif /> {{ $val }}
            @endforeach
        </td>
      </tr>
      <tr>
        <th>地方</th>
        <td>
            @foreach($regions as $key => $val)
            <input type="checkbox" name="region[]" value="{{ $key }}" @if(request('region') && in_array($key, request('region'))) checked @endif /> {{ $val }}
            @endforeach
        </td>
      </tr>
      <tr>
        <th>作った人</th>
        <td>
            @foreach($pokemon_user as $po_u)
            <input type="checkbox" name="name[]" value="{{ $po_u->name }}" @if(request('name') && in_array($po_u->name, request('name'))) checked @endif /> {{ $po_u->name }}
            @endforeach
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <button type="submit">検索</button>
          <button type="button" onclick="location.href='/allpokemons'">リセット</button>
        </td>
      </tr>
    </table>
  </form>

  <br/>
  <h4>みんなのポケモン &nbsp; 表示中 {{ $pf['total'] }}体 / 全 {{ $count }}体</h4>

  <table border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
      <th>作った人</th>
      <th>名前</th>
      <th>タイプ</th>
      <th>地方</th>
      <th>高さ</th>
      <th>重さ</th>
      <th>技の名前</th>
      <th>技の説明</th>
    </tr>
    @foreach($pokemons as $pokemon)
      <tr>
        <td align="center">{{ $pokemon->name }}</td>
        <td align="center">{{ $pokemon->pokemon_name }}</td>
        <td align="center">{{ $attributes[$pokemon->attribute] }}</td>
        <td align="center">{{ $regions[$pokemon->region] }}</td>
        <td align="center">{{ $pokemon->size }}cm</td>
        <td align="center">{{ $pokemon->weight }}kg</td>
        <td align="center">{{ $pokemon->attack_name }}</td>
        <td align="center">{{ $pokemon->attack_description }}</td>
      </tr>
    @endforeach
  </table>

  <br />
  {{ $pokemons->links() }}

  <br/>
  <a href="/pokemons">{{ $user->name }}のポケモンを見る</a>

</body>
</html>
