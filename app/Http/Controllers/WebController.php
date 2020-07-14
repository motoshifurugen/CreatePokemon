<?php

namespace App\Http\Controllers;

use App\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    protected $ATTRIBUTES = ['0' => 'ノーマル', '1'=>'ほのお', '2'=>'みず', '3'=>'くさ', '4'=>'でんき', '5'=>'こおり', '6'=>'かくとう', '7'=>'どく', '8'=>'じめん', '9'=>'ひこう', '10'=>'エスパー', '11'=>'むし', '12'=>'いわ', '13'=>'ゴースト', '14'=>'ドラゴン', '15'=>'あく', '16'=>'はがね', '17'=>'フェアリー'];
    protected $REGIONS = ['a'=>'カントー', 'b'=>'ジョウト', 'c'=>'ホウエン', 'd'=>'シンオウ', 'e'=>'イッシュ', 'f'=>'カロス', 'g'=>'アローラ', 'h'=>'ガラル'];

    public function index() {
        $user = Auth::user();
        $query = DB::table('pokemon')->join('users', 'pokemon.user_id', '=', 'users.id');
        $count = $query->count();

        $pokemons = $query->orderBy('pokemon_name', 'asc')->paginate(10);
        $pokemon_user = $this->selectUser();
        // var_dump($pokemon_user);
        $performance = $this->calcPerformance($pokemons);

        return view('web.index', compact('pokemons'), ['attributes'=>$this->ATTRIBUTES, 'regions'=>$this->REGIONS, 'user'=>$user, 'count'=>$count, 'pf'=>$performance, 'pokemon_user'=>$pokemon_user]);
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

    public function selectUser() {
        $query = DB::table('pokemon')->join('users', 'pokemon.user_id', '=', 'users.id');
        $po_u = $query->distinct()->select('name')->get();

        return $po_u;
    }
}
