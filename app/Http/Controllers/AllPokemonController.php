<?php

namespace App\Http\Controllers;

use App\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AllPokemonController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    protected $ATTRIBUTES = ['0' => 'ノーマル', '1'=>'ほのお', '2'=>'みず', '3'=>'くさ', '4'=>'でんき', '5'=>'こおり', '6'=>'かくとう', '7'=>'どく', '8'=>'じめん', '9'=>'ひこう', '10'=>'エスパー', '11'=>'むし', '12'=>'いわ', '13'=>'ゴースト', '14'=>'ドラゴン', '15'=>'あく', '16'=>'はがね', '17'=>'フェアリー'];
    protected $REGIONS = ['a'=>'カントー', 'b'=>'ジョウト', 'c'=>'ホウエン', 'd'=>'シンオウ', 'e'=>'イッシュ', 'f'=>'カロス', 'g'=>'アローラ', 'h'=>'ガラル'];

    public function index()
    {
        $user = Auth::user();
        $query = DB::table('pokemon')->join('users', 'pokemon.user_id', '=', 'users.id');

        if (request('attribute')) {
            $query->whereIn('attribute', request('attribute'));
        }

        if (request('region')) {
            $query->whereIn('region', request('region'));
        }

        $pokemons = $query->orderBy('pokemon_name', 'asc')->get();
        $performance = $this->calcPerformance($pokemons);


        return view('allpokemons.index', compact('pokemons'), ['attributes'=>$this->ATTRIBUTES, 'regions'=>$this->REGIONS, 'pf'=>$performance, 'user'=>$user]);
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
}
