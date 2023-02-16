<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Friend;
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

        // DB::statement("SET foreign_key_checks=0");
        //     DB::table('messages')->truncate();

        $pass=Hash::make('amgad123');

        // \App\Models\User::factory(10)->create();
        // User::create(['name'=>'amgad' ,'email'=>'amgad@gmail.com' ,'password'=>($pass)  ,'img'=>'https://drive.google.com/uc?id=1g6v8UmQU78YfZURtmGN1pqXiZGFqOUaJ&export=media ' ,'deviceToken'=>'evq-0tEgE-SoCQciF-LIIY:APA91bHmSX9FOmLKQROInwAoVZN7vqheUAyvpnlXntooWFJgt7JFk5niE-1DliViL3C6CMep7NFQNeKDudDAnUkrA6r14pHYy052HT2HkRnrzqC1D4DzUS9spO6Thw-flt-WV-vn4nRo' ]);
        User::create(['name'=>'amgad' ,'email'=>'amgad@gmail.com' ,'password'=>($pass)  ,'img'=>'/img/amgad.jpg' ,'deviceToken'=>'eLTtD5ur1IuC3wMWmqlP37:APA91bEj0xxyCRpM90MiPjcXZwJtehoHTfk642ubWY5RVAbibPmcY2OH1WE9Y3QfcBwdb8H3NV_n_jbRdmmNx7a9Of6GTyGeOj_E7T0abAdM-6upOZIVOul88--dLvEuy7JaDC2gDgnM' ]);
        // User::create(['name'=>'ayham' ,'email'=>'ayham@gmail.com' ,'password'=>($pass)  ,'img'=>'https://drive.google.com/uc?id=1BHhyDTxz0oFUFB0GL1hqwBoUjDwZntbn&export=media' ,'deviceToken'=>'f3aweQqffqpcSfx198kGHS:APA91bGGhFJCcEi3feNHij-rSt-BPF7EJxRJlF0Yp8p7-MENFp3G46QwKYtcilrhZssm0nMqAJDbJulXH8-H2ct44EFP_H5UZE7yKThwv4G32lBHK_4QisVEasE5waffxlDdhdoc6OZu'  ]);
        // User::create(['name'=>'ayham' ,'email'=>'ayham@gmail.com' ,'password'=>($pass)  ,'img'=>'/img/ayham.jpg' ,'deviceToken'=>'f3aweQqffqpcSfx198kGHS:APA91bGGhFJCcEi3feNHij-rSt-BPF7EJxRJlF0Yp8p7-MENFp3G46QwKYtcilrhZssm0nMqAJDbJulXH8-H2ct44EFP_H5UZE7yKThwv4G32lBHK_4QisVEasE5waffxlDdhdoc6OZu'  ]);
        // User::create(['name'=>'rozet' ,'email'=>'rozet@gmail.com' ,'password'=>($pass)  ,'img'=>'/img/rozet.jpg'        ,'deviceToken'=>' ' ]);
        // User::create(['name'=>'ahmad' ,'email'=>'ahmad@gmail.com' ,'password'=>($pass)  ,'img'=>'/img/ahmad.jpg'        ,'deviceToken'=>' ' ]);
        // User::create(['name'=>'samer' ,'email'=>'samer@gmail.com' ,'password'=>($pass)  ,'img'=>'/img/samer.jpg'        ,'deviceToken'=>' ' ]);
        // User::create(['name'=>'dana'  ,'email'=>'dana@gmail.com'  ,'password'=>($pass)  ,'img'=>'/img/dana.jpg'         ,'deviceToken'=>' ' ]);
        // User::create(['name'=>'Ali'   ,'email'=>'Ali@gmail.com'   ,'password'=>($pass)  ,'img'=>'/img/ali.jpg'          ,'deviceToken'=>' ' ]);
        // // User::create(['name'=>'hesham','email'=>'hisham@gmail.com','password'=>($pass)  ,'img'=>'https://drive.google.com/uc?id=19CSuaEw5yKzifGoEZZUe6oKl5x8CuB6r&export=media'       ,'deviceToken'=>' ' ]);
        // User::create(['name'=>'hesham','email'=>'hisham@gmail.com','password'=>($pass)  ,'img'=>'/img/hesham.png'      ,'deviceToken'=>' ' ]);
        // User::create(['name'=>'joli'  ,'email'=>'joli@gmail.com'  ,'password'=>($pass)  ,'img'=>'/img/user_default.png' ,'deviceToken'=>' ' ]);
  
        // Friend::create(['user1_id'=>1,'user2_id'=>2,'acceptable'=>1]);
        // Friend::create(['user1_id'=>1,'user2_id'=>3,'acceptable'=>1]);
        // Friend::create(['user1_id'=>1,'user2_id'=>4,'acceptable'=>1]);

        // Friend::create(['user1_id'=>2,'user2_id'=>3,'acceptable'=>1]);
        // Friend::create(['user1_id'=>2,'user2_id'=>4,'acceptable'=>1]);

  
//             for($i=0;$i<50;$i++){

//    \App\Models\Message::create([
//             'conversation_id' => 1,
//             'user_id' =>1,
//             'body' => '<div class="message-text " style=" background-color:  ;height:90% display: flex;flex-direction: column;justify-content: space-between;"><p>
//             @@@@@ 
//             <span class="sended  fas fa-check" style="position:relative ;bottom:-12px;right:-10px;z-index:12;visibility:"></span> </p></div> ',
//             'created_at'=>now(),
//             'type' => 'text',
//         ]);

//       }
     

        // \App\Models\User::factory(10000)->create();

    }
}
