<form method="POST" action="/pokemons">
    {{ csrf_field() }}
    <table border="1" cellspacing="0" cellpadding="5">
      <tr>
          <th>名前</th>
          <td>
              <input type="text" name="name" require>
          </td>
      </tr>
      <tr>
        <th>タイプ</th>
        <td>
        <select name="attribute">
          @foreach ($attributes as $key => $val)
            <option value="{{ $key }}" >{{ $val }}</option>
          @endforeach
        </select>
        </td>
      </tr>
      <tr>
        <th>地方</th>
        <td>
        <select name="region">
          @foreach ($regions as $key => $val)
            <option value="{{ $key }}" >{{ $val }}</option>
          @endforeach
        </select>
        </td>
      </tr>
      <tr>
        <th>高さ</th>
        <td>
          <input type="number" name="size" value="100" require>
        </td>
      </tr>
      <tr>
        <th>重さ</th>
        <td>
          <input type="number" name="weight" value="10" require>
        </td>
      </tr>
      <tr>
        <th>技の名前</th>
        <td>
            <input type="text" name="attack_name">
        </td>
      </tr>
      <tr>
        <th>技の説明</th>
        <td>
          <textarea name="attack_description"></textarea>
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <button type="submit" >登録</button>
        </td>
      </tr>
    </table>
  </form>

  <a href="/pokemons">戻る</a>
