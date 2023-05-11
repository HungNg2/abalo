<?php
namespace App\Http\Controllers;
use App\Models\AbArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class ArtikelController extends Controller
{
    public function getArticles(Request $request)
    {
        $abarticles = new AbArticle();
        if ($request->search) {
            $abarticle = $abarticles->searchByName($request->search);
            //$abarticle = DB::table('ab_article')->select('*')->where('ab_name', 'ILIKE', '%' . $request->search . '%')->get();
        } else {
            $abarticle = $abarticles->get();
            // $abarticle =  DB::table('ab_article')->get();
        }
        return view('view', ['abarticle' => $abarticle]);
    }
    public function store(Request $request): string
    {
        $request->validate([
            'ab_name' => 'required|max:80',
            'ab_description' => 'required|max:1000',
            'ab_price' => 'required|integer|min:1',
        ]);

        $article = new AbArticle($request->all());
        $article->ab_creator_id = 1;

        $idmax = DB::table('ab_article')->max('id');
        $article->id = $idmax + 1;
        $article->save();

        return 'Der Artikel wurde erfolgreich gespeichert';
    }

    public function search_api(Request $request)
    {
        if ($request->search) {
            $abarticle = DB::table('ab_article')->select('*')->where('ab_name', 'ILIKE', '%' . $request->search . '%')->take(5)->get();
        } else {
            $abarticle = AbArticle::all();
        }
        $data = [

        ];
        foreach ($abarticle as $key => $article) {
            $data[$key] = [
                'id' => $article->id,
                'ab_name' => $article->ab_name,
                'ab_price' => $article->ab_price,
                'ab_description' => $article->ab_description,
                'ab_creator_id' => $article->ab_creator_id,
                'ab_createdate' => $article->ab_createdate,
            ];
        }
        return response()->json($data);
    }
    public function store_api(Request $request): string
    {

        $request->validate([
            'ab_name' => 'required|max:80',
            'ab_description' => 'required|max:1000',
            'ab_price' => 'required|integer|min:1'

        ]);
        $article = new AbArticle($request->all());
        $article->ab_creator_id = 1;
        $idmax = DB::table('ab_article')->max('id');
        $article->id = $idmax + 1;
        $article->save();

        return response()->json([
            'id' => $article->id
        ]);
       // return 'Der Artikel wurde erfolgreich gespeichertttt';

    }

    public function _apiDeleteArticle($id): void
    {
        $articleToDelete = DB::table('ab_article')->where('id', $id)->get();
        if($articleToDelete)
            DB::table('ab_article')->where('id', $id)->delete();
        else
            throw new Exception('Artikel nicht gefunden');
    }
}
