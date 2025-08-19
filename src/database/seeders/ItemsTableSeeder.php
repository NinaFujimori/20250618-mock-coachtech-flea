<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => '1',
            'image' => 'image/watch.jpg',
            'category_id' => null,
            'condition' => '0',
            'name' => '腕時計',
            'brand' => '不明',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'price' => 15000
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => '1',
            'image' => 'image/HDD.jpg',
            'category_id' => null,
            'condition' => '1',
            'name' => 'HDD',
            'brand' => '不明',
            'description' => '高速で信頼性の高いハードディスク',
            'price' => 5000
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => '1',
            'image' => 'image/threeOnions.jpg',
            'category_id' => null,
            'condition' => '2',
            'name' => '玉ねぎ3束',
            'brand' => '不明',
            'description' => '新鮮な玉ねぎ3束のセット',
            'price' => 300
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => '1',
            'image' => 'image/leatherShoes.jpg',
            'category_id' => null,
            'condition' => '3',
            'name' => '革靴',
            'brand' => '不明',
            'description' => 'クラシックなデザインの革靴',
            'price' => 4000
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => '1',
            'image' => 'image/notePC.jpg',
            'category_id' => null,
            'condition' => '0',
            'name' => 'ノートPC',
            'brand' => '不明',
            'description' => '高性能なノートパソコン',
            'price' => 45000
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => '1',
            'image' => 'image/microphone.jpg',
            'category_id' => null,
            'condition' => '1',
            'name' => 'マイク',
            'brand' => '不明',
            'description' => '高音質のレコーディング用マイク',
            'price' => 8000
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => '1',
            'image' => 'image/shoulderBag.jpg',
            'category_id' => null,
            'condition' => '2',
            'name' => 'ショルダーバッグ',
            'brand' => '不明',
            'description' => 'おしゃれなショルダーバッグ',
            'price' => 3500
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => '1',
            'image' => 'image/tumbler.jpg',
            'category_id' => null,
            'condition' => '3',
            'name' => 'タンブラー',
            'brand' => '不明',
            'description' => '使いやすいタンブラー',
            'price' => 500
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => '1',
            'image' => 'image/coffeeMill.jpg',
            'category_id' => null,
            'condition' => '0',
            'name' => 'コーヒーミル',
            'brand' => '不明',
            'description' => '手動のコーヒーミル',
            'price' => 4000
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id' => '1',
            'image' => 'image/makeUpSet.jpg',
            'category_id' => null,
            'condition' => '1',
            'name' => 'メイクセット',
            'brand' => '不明',
            'description' => '便利なメイクアップセット',
            'price' => 2500
        ];
        DB::table('items')->insert($param);
    }
}
