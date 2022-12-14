<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contato;

class ContatosManagerController extends Controller
{

    public function index()
    {
        $contatos = Contato::latest()->paginate(5);
        return view('contatosmanager.index',compact('contatos'))
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
        $contato = Contato::findOrFail($id);
        $contato->status = true;
        $contato->save();
        return view('contatosmanager.show',compact('contato'));
    }

    //DESTROY
    public function destroy($id)
    {
        Contato::findOrFail($id)->delete();

        return redirect()->route('contatosmanager.index')->with('success','contato excluido com sucesso!');
    }
}
