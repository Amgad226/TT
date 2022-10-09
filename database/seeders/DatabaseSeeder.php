<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement("SET foreign_key_checks=0");
        // $databaseName = DB::getDatabaseName();
        // $tables = DB::select("SELECT * FROM information_schema.tables WHERE table_schema = '$databaseName'");
        // foreach ($tables as $table) {
        //     $name = $table->TABLE_NAME;
        //     //if you don't want to truncate migrations
        //     if ($name == 'migrations') {
        //         continue;
        //     }
        //     DB::table($name)->truncate();
        // } 
        // $pass=Hash::make('amgad123');

        // // \App\Models\User::factory(10)->create();
        // User::create(['name'=>'amgad' ,'email'=>'amgad@gmail.com' ,'password'=>($pass)  ,'img'=>'/storage/img/amgad.jpg'  ]);
        // User::create(['name'=>'ayham' ,'email'=>'ayham@gmail.com' ,'password'=>($pass)  ,'img'=>'/storage/img/ayham.jpg'  ]);
        // User::create(['name'=>'rozet' ,'email'=>'rozet@gmail.com' ,'password'=>($pass)  ,'img'=>'/storage/img/rozet.jpg'  ]);
        // User::create(['name'=>'ahmad' ,'email'=>'ahmad@gmail.com' ,'password'=>($pass)  ,'img'=>'/storage/img/ahmad.jpg'  ]);
        // User::create(['name'=>'samer' ,'email'=>'samer@gmail.com' ,'password'=>($pass)  ,'img'=>'/storage/img/samer.jpg'  ]);
        // User::create(['name'=>'dana'  ,'email'=>'dana@gmail.com'  ,'password'=>($pass)  ,'img'=>'/storage/img/dana.jpg'  ]);
        // User::create(['name'=>'Ali'   ,'email'=>'Ali@gmail.com'   ,'password'=>($pass)  ,'img'=>'/storage/img/ali.jpg'  ]);
        // User::create(['name'=>'hesham','email'=>'hisham@gmail.com','password'=>($pass)  ,'img'=>'/storage/img/hesham.jpg'  ]);
        // User::create(['name'=>'joli'  ,'email'=>'joli@gmail.com'  ,'password'=>($pass)  ,'img'=>'/storage/img/user_default.png'  ]);
      for($i=0;$i<2000;$i++){

   \App\Models\Message::create([
            'conversation_id' => 8,
            'user_id' =>1,
            'body' => 1, // password
            'type' => 'text',
        ]);

      }
     

        // \App\Models\User::factory(10000)->create();

    }
}
