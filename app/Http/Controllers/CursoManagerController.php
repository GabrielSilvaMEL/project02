<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::latest()->paginate(5);

        return view('cursosmanager.index',compact('cursos'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cursosmanager.create');
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
            'nome' => 'required',
            'descricao' => 'required',
            'imagem' => 'required'
        ]);

        // Curso::create($request->all());
        $curso = new Curso;
        $curso->nome = $request->nome;
        $curso->descricao = $request->descricao;
        $curso->imagem='';
        $dirImagem = "images/cursos";
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $requestImage = $request->imagem;
            $extension = $requestImage->extension();
 
            $imageName = md5 ( $requestImage -> getClientOriginalName() . strtotime ('now')) . '.' . $extension;
            $requestImage->move(public_path($dirImagem),$imageName);
            $curso->imagem=$dirImagem.$imageName;
        };
        $curso->save;

        return redirect()->route('cursosmanager.index')->with('success','Curso criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::findOrFail($id);

        return view('cursosmanager.show',compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Curso::findOrFail($id);

        return view('cursosmanager.edit',compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'imagem' => 'required'
        ]);

        $data = $request->all();
        
        Curso::findOrFail($id)->update($data);

        return redirect()->route('cursosmanager.index')->with('success','Curso atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Curso::findOrFail($id)->delete();

        return redirect()->route('cursosmanager.index')->with('success','Curso excluido com sucesso!');
    }
}

