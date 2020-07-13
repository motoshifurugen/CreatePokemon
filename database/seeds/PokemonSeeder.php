<?php

use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pokemon')->insert([
            ['user_id'=>1, 'pokemon_name'=>'フシギダネ', 'attribute'=>'3', 'region'=>'a', 'size'=>70, 'weight'=>7, 'attack_name'=>'はっぱカッター', 'attack_description'=>'カッターのような硬いはっぱで攻撃する'],
            ['user_id'=>1, 'pokemon_name'=>'ヒトカゲ', 'attribute'=>'1', 'region'=>'a', 'size'=>60, 'weight'=>9, 'attack_name'=>'かえんほうしゃ', 'attack_description'=>'口から火を吐く'],
            ['user_id'=>1, 'pokemon_name'=>'ゼニガメ', 'attribute'=>'2', 'region'=>'a', 'size'=>50, 'weight'=>9, 'attack_name'=>'みずでっぽう', 'attack_description'=>'水を相手にぶつける']
        ]);
    }
}
