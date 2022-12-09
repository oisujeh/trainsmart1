<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1,10000) as $index) {
            DB::table('participants')->insert([
                'name'=>Str::random(10),
                'email'=>Str::random(10).'@gmail.com',
                'phone'=>'08184120174',
                'sex'=>'M',
                'designation'=>Str::random(10),
                'category'=>Str::random(10),
                'photo_consent' =>'Yes',
                'institution_id'=>1,
                'directorate_id'=>1
            ]);
        }
    }
}
