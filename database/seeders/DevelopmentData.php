<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevelopmentData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {/*
    $first = true;
    if($handle = fopen("public/data/user.csv","r")){
        while ($data=fgetcsv($handle,1000,";")) {
            if($first){
                $first = false;
            }
            else{
                DB::table('ab_user')->insert([
                    'id'=>$data[0],
                    'ab_name'=>$data[1],
                    'ab_password'=>bcrypt($data[2]),
                    'ab_mail'=>$data[3]
                ]);
            }
        }
        fclose($handle);
    }
    $first=true;
       if( ($handle=fopen("public/data/articles.csv","r")) !==FALSE){
           while(($data=fgetcsv($handle,1000,";")) !==FALSE){
               if($first === true){
                   $first = false;
               }
               else{
                   DB::table('ab_article')->insert([
                       'id' => $data[0],
                       'ab_name' =>  $data[1],
                       'ab_price' => intval($data[2]),
                       'ab_description'=> $data[3],
                       'ab_creator_id'=>$data[4],
                       'ab_createdate'=>$data[5]
                   ]);
               }

           }
           fclose($handle);
       }

        $first= true;
        if (($handle = fopen("public/data/articlecategory.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                if($first === true){
                    $first= false;
                }
                else{
                    if($data[2]== "NULL"){
                        $data[2] = null;
                    }
                    DB::table('ab_articlecategory')->insert([
                        'id' => $data[0],
                        'ab_name' =>  $data[1],
                        'ab_parent' => $data[2]
                    ]);
                }
            }
            fclose($handle);
        }*/

        $firstLine = TRUE;
        if(($file = fopen("public/data/article_has_articlecategory.csv", "r")) !== FALSE) {
            while(($data = fgetcsv($file, 1000, ";")) !== FALSE) {
                if(!$firstLine) {
                    DB::table('articlehas_article_category')->insert([
                        'ab_articlecategory_id' => $data[0],
                        'ab_article_id' => $data[1]
                    ]);
                }
                $firstLine = FALSE;
            }
            fclose($file);
        }
        else {
            print("file not found");
        }
    }
}
