<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;
use App\Exemplary;
use App\Student;
use App\Devolution;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::paginate(5);
        $exemplaries = Exemplary::where('situation', 0)->get();
        $students = Student::all();
        $date = date("d/m/Y");

        return view('loans.index', compact('loans','date','exemplaries','students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'loan_date' => ['required', 'string', 'max:100'],
            'return_date_expected' => ['required', 'string', 'max:100'],
            'exemplary_id' => ['required', 'integer', 'max:30'],
            'user_id' => ['required', 'integer', 'max:30']
        ],[
            'loan_date.required' => 'O campo Data de Empréstimo é obrigatório.',
            'return_date_expected.required' => 'O campo Data de Devolução Prevista é obrigatório.',
            'exemplary_id.required' => 'O campo Obra é obrigatório.',
            'user_id.required' => 'O campo Aluno é obrigatório.'
        ]);

        $devolution = Devolution::create([

        ]);

        $loan = Loan::create([
            'user_id' => $request->user_id,
            'exemplary_id' => $request->exemplary_id,
            'devolution_id' => $devolution->id,
            'loan_date' => $request->loan_date,
            'return_date_expected' => $request->return_date_expected
        ]);

        $exemplary = Exemplary::find($request->exemplary_id)->update([
            'situation' => 1
        ]);

        return redirect()->back()->with('status', 'Empréstimo realizado com sucesso!');
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
        Loan::find($id)->exemplary->update([
            'situation' => 0
        ]);

        $date =  date('Y-m-d H:i:s', time());
       
        Loan::find($id)->devolution->update([
            'date_devolution' => $date
        ]);

        return redirect()->back()->with('status', 'Devolução realizada com sucesso!');

    }

}
