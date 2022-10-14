<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contato;

class ContatosManagerController extends Controller
{

    public function index()
    {
        $contato = contato::latest()->paginate(5);

        return view('contatosmanager.index',compact('contato'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'imagem' => 'required'
        ]);

        // contato::create($request->all());
        $contato = new contato;
        $contato->nome = $request->nome;
        $contato->mensagem = $request->mensagem;
        $contato->status='';
        
        $contato->save();

        return redirect()->route('contatosmanager.index')->with('success','contato criado com sucesso!');
    }
    //SHOW
    public function show($id)
    {
        contato::findOrFail($id);

        return redirect()->route('contatosmanager.index')->with('success','contato atualizado com sucesso!');
        $contato = contato::findOrFail($id);

        return view('contatosmanager.show',compact('contato'));
    }

    //DESTROY
    public function destroy($id)
    {
        contato::findOrFail($id)->delete();

        return redirect()->route('contatosmanager.index')->with('success','contato excluido com sucesso!');
    }
}
