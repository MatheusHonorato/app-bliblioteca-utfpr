<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exemplary;
use App\Author;
use App\Type;

class ExemplaryController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'works_id' => ['required'],
            'acquisition_date' => ['required', 'string', 'max:100']
        ],[
            'acquisition_date.required' => 'O campo Data de aquisição é obrigatório.'
        ]);

        $exemplary = Exemplary::create([
            'works_id' => $request->works_id,
            'acquisition_date' => $request->acquisition_date,
            'situation' => 0
        ]);

        return redirect()->back()->with('status', 'Exemplar cadastrado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exemplary = Exemplary::find($id);
        if($exemplary->situation == 0) {
            $exemplary->delete();
            return redirect()->back()->with('status', 'Exemplar removido com sucesso!');
        }
        return redirect()->back()->with('error', 'Exemplar não removido, pois a devolução ainda não foi confirmada.');
    }
}
