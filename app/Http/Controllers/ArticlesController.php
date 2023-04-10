<?php

namespace App\Http\Controllers;

use App\Models\AbArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ArticlesController extends Controller
{
    public function search(Request $request) {

        $keyword = $request->search;

        $results = AbArticle::query()
            ->where('ab_name','ilike', '%'.$keyword.'%')
            ->get();

        $images = $this->articleImg();

        return view("articles", [
            "results" => $results,
            "keyword" => $keyword,
            "images" => $images,

        ]);
    }

    public function articleImg() {

        $files = \File::files("articelimages");
        $images = [];

        // create array images with images = [ imgID => path ]
        foreach ($files as $file) {
            $images[pathinfo($file, PATHINFO_FILENAME)] =
                $file->getPathname();
        }
        return $images;
    }
}
