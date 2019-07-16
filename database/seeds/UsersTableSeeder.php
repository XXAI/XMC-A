<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){ 
        
        $archivo_csv = storage_path().'/app/seeds/users.csv';
        $query = sprintf("
            LOAD DATA local INFILE '%s' 
            INTO TABLE users
            CHARACTER SET utf8 
            FIELDS TERMINATED BY ',' 
            OPTIONALLY ENCLOSED BY '\"' 
            ESCAPED BY '\\\\' 
            LINES TERMINATED BY '\\n' 
            IGNORE 1 LINES", addslashes($archivo_csv));
        DB::connection()->getpdo()->exec($query); 
    }
}
