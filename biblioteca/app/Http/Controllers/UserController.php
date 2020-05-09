<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\UserPhone;
use App\Loan;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::paginate(5);

        return view('users.index', compact('users'));
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
            'name' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:100'],
            'date' => ['required', 'string', 'max:30'],
            'phone' => ['required', 'string', 'max:30'],
            'ra' => ['required', 'string', 'max:30']
        ],[
            'name.required' => 'O campo Nome é obrigatório.',
            'address.required' => 'O campo Endereço é obrigatório.',
            'date.required' => 'O campo Data de Nascimento é obrigatório.',
            'phone.required' => 'O campo Telefone é obrigatório.',
            'ra.required' => 'O campo R.A. é obrigatório.'
        ]);

        $user = User::create([
            'name' => $request->name,
            'address' => $request->address,
            'date' => $request->date
        ]);

        $user->phones()->create([
            'phone' => $request->phone
        ]);

        $user->student()->create([
            'ra' => $request->ra
        ]);

        return redirect()->back()->with('status', 'Usuário cadastrado com sucesso!');
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
            'name' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:100'],
            'date' => ['required', 'string', 'max:30'],
            'phone' => ['required', 'string', 'max:30'],
            'ra' => ['required', 'string', 'max:30']
        ],[
            'name.required' => 'O campo Nome é obrigatório.',
            'address.required' => 'O campo Endereço é obrigatório.',
            'date.required' => 'O campo Data de Nascimento é obrigatório.',
            'phone.required' => 'O campo Telefone é obrigatório.',
            'ra.required' => 'O campo R.A. é obrigatório.'
        ]);

        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'address' => $request->address,
            'date' => $request->date
        ]);

        $user->phones()->update([
            'phone' => $request->phone
        ]);

        $user->student()->update([
            'ra' => $request->ra
        ]);

        return redirect()->back()->with('status', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loans = Loan::where('user_id', $id)->get();

        if(count($loans)>0) {
            foreach($loans as $loan) {
                if($loan->exemplary->situation == 1){
                    return redirect()->back()->with('error', 'Usuário não pode ser removido, pois possui pendencias!');
                }
            }
        }

        User::destroy($id);

        return redirect()->back()->with('status', 'Usuário removido com sucesso!');
    }
}
