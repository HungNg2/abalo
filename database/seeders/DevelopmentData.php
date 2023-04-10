<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AbArticle;
use App\Models\AbUser;
use App\Models\AbArticleCategory;

class DevelopmentData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csvFile = fopen(base_path("database/data/user.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                AbUser::create([
                    "id" => $data['0'],
                    "ab_name" => $data['1'],
                    "ab_password" => $data['2'],
                    "ab_mail" => $data['3']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);



        $csvFile1 = fopen(base_path("database/data/articles.csv"), "r");

        $firstline = true;
        while (($data1 = fgetcsv($csvFile1, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                AbArticle::create([
                    "id" => $data1['0'],
                    "ab_name" => $data1['1'],
                    "ab_price" => str_replace('.','', $data1['2']),
                    "ab_description" => $data1['3'],
                    "ab_creator_id" => $data1['4'],
                    "created_at" => date('Y-m-d h:i:s A',strtotime($data1['5']))
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile1);


        $csvFile2 = fopen(base_path("database/data/articlecategory.csv"), "r");

        $firstline = true;
        while (($data2 = fgetcsv($csvFile2, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                if($data2['2'] == "NULL") $data2['2']=null;
                else $data2['2'] = (int)$data2['2'];
                AbArticleCategory::create([
                    "id" => $data2['0'],
                    "ab_name" => $data2['1'],
                    "ab_parent" => $data2['2']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile2);
    }
}
