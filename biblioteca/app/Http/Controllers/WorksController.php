<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Works;
use App\Author;
use App\Type;
use App\Exemplary;

class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        $types = Type::all();
        $work = Works::paginate(5);

        return view('work.index', compact('work','authors','types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'year' => ['required', 'string', 'max:100'],
            'type' => ['required', 'string', 'max:30'],
            'author' => ['required', 'string', 'max:30']
        ],[
            'name.required' => 'O campo Título é obrigatório.',
            'year.required' => 'O campo Ano de Publicação é obrigatório.',
            'type.required' => 'O campo Tipo de Obra é obrigatório.',
            'author.required' => 'O campo Autor é obrigatório.'
        ]);

        $works = Works::create([
            'title' => $request->title,
            'year' => $request->year,
            'type_id' => $request->type,
            'author_id' => $request->author
        ]);

        return redirect()->back()->with('status', 'Obra cadastradata com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exemplaries = Exemplary::where('works_id', $id)->paginate(5);
        $date = date("d/m/Y");
        
        return view('exemplaries.index', compact('exemplaries', 'id','date'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'year' => ['required', 'string', 'max:100'],
            'type' => ['required', 'string', 'max:30'],
            'author' => ['required', 'string', 'max:30']
        ],[
            'name.required' => 'O campo Título é obrigatório.',
            'year.required' => 'O campo Ano de Publicação é obrigatório.',
            'type.required' => 'O campo Tipo de Obra é obrigatório.',
            'author.required' => 'O campo Autor é obrigatório.'
        ]);

        $works = Works::find($id)->update([
            'title' => $request->title,
            'year' => $request->year,
            'type_id' => $request->type,
            'author_id' => $request->author
        ]);

        return redirect()->back()->with('status', 'Obra atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exemplaries = Exemplary::where('works_id', $id)->where('situation', 1)->get();
        
        if(count($exemplaries)==0) {
            Works::destroy($id);
            return redirect()->back()->with('status', 'Obra removida com sucesso!');
        }

        return redirect()->back()->with('error', 'A obra não pode ser removida, pois ainda existem exemplares em empréstimo.');
    }
}
