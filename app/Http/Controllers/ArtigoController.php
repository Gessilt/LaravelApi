<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artigo as Artigo;
use App\Http\Resources\Artigo as ArtigoResource;

class ArtigoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artigos = Artigo::paginate(15);
        return ArtigoResource::collection($artigos);
    }
    public function show($id) {
        $artigo = Artigo::findOrFail($id);
        return new ArtigoResource($artigo);
    }
    public function store(Request $request) {
        $artigo = new Artigo;
        $artigo->titulo = $request->input('titulo');
        $artigo->conteudo = $request->input('conteudo');
        if ($artigo->save()){
            return new ArtigoResource($artigo);
        }
    }
    public function updatePut (Request $request){
        $artigo = Artigo::findOrFail($request->id);
        $artigo->titulo = $request->input('titulo');
        $artigo->conteudo = $request->input('conteudo');
        if ($artigo->save()){
            return new ArtigoResource($artigo);
        }
    }
    public function updatePatch (Request $request){
        $artigo = Artigo::findOrFail($request->id);
        if(!empty($request->input('titulo'))) 
        {
            $artigo->titulo = $request->input('titulo');
        }
        if(!empty($request->input('titulo'))) 
        {
            $artigo->conteudo = $request->input('conteudo');
        }
        if ($artigo->save()){
            return new ArtigoResource($artigo);
        }
    }
    public function destroy($id) {
        $artigo = Artigo::findOrFail($id);
        if ($artigo->delete()) {
            return new ArtigoResource($artigo);
        }
    }
}
