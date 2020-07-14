<?php

namespace App\Http\Controllers;

use App\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // 認証モジュールの読み込み

class PokemonController extends Controller {
    // 認証を有効にする
    public function __construct() {
        $this->middleware('auth');
    }

    // 項目マスタ キーとラベル
    protected $ATTRIBUTES = ['0' => 'ノーマル', '1'=>'ほのお', '2'=>'みず', '3'=>'くさ', '4'=>'でんき', '5'=>'こおり', '6'=>'かくとう', '7'=>'どく', '8'=>'じめん', '9'=>'ひこう', '10'=>'エスパー', '11'=>'むし', '12'=>'いわ', '13'=>'ゴースト', '14'=>'ドラゴン', '15'=>'あく', '16'=>'はがね', '17'=>'フェアリー'];
    protected $REGIONS = ['a'=>'カントー', 'b'=>'ジョウト', 'c'=>'ホウエン', 'd'=>'シンオウ', 'e'=>'イッシュ', 'f'=>'カロス', 'g'=>'アローラ', 'h'=>'ガラル'];

    public function index() {
        $user_id = Auth::id(); // ログインユーザIDを取得する
        $user = Auth::user();
        $query = DB::table('pokemon')->where('user_id', $user_id);
        $count = $query->count();

        if (request('attribute')) {
            $query->whereIn('attribute', request('attribute'));
        }

        if (request('region')) {
            $query->whereIn('region', request('region'));
        }

        $pokemons = $query->orderBy('created_at', 'desc')->paginate(10);
        $performance = $this->calcPerformance($pokemons);

        return view('pokemons.index', compact('pokemons'), ['attributes'=>$this->ATTRIBUTES, 'regions'=>$this->REGIONS, 'pf'=>$performance, 'user'=>$user, 'count'=>$count]);
    }

    public function create() {
        return view('pokemons.create', ['attributes'=>$this->ATTRIBUTES, 'regions'=>$this->REGIONS]);
    }

    public function store(Request $request) {
        $pokemon = new Pokemon();
        $pokemon->user_id = Auth::id();
        $pokemon->pokemon_name = request('pokemon_name');
        $pokemon->attribute = request('attribute');
        $pokemon->region = request('region');
        $pokemon->size = request('size');
        $pokemon->weight = request('weight');
        $pokemon->attack_name = request('attack_name');
        if (request('attack_description')) {
            $pokemon->attack_description = request('attack_description');
        }

        $pokemon->save();
        return redirect('pokemons');
    }

    public function calcPerformance($pokemons){
        $ret = [
            'total' => 0
        ];

        foreach($pokemons as $po) {
            if($po->size >= 0) {
                $ret['total'] += 1;
            }
        }
        return $ret;
    }

    public function edit(Pokemon $pokemon) {
        return view('pokemons.edit', compact('pokemon'), ['attributes'=>$this->ATTRIBUTES, 'regions'=>$this->REGIONS]);
    }

    public function update(Pokemon $pokemon) {
        $pokemon->user_id = Auth::id();
        $pokemon->pokemon_name = request('pokemon_name');
        $pokemon->attribute = request('attribute');
        $pokemon->region = request('region');
        $pokemon->size = request('size');
        $pokemon->weight = request('weight');
        $pokemon->attack_name = request('attack_name');
        if(request('attack_description')) {
            $pokemon->attack_description = request('attack_description');
        }
        $pokemon->save();
        return redirect()->to('pokemons');
    }

    public function destroy(Pokemon $pokemon) {
        $pokemon->delete();
        return redirect()->to('pokemons');
    }
}
