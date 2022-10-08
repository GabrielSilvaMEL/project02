@extends('site.layout')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Projeto Laravel - Cadastro de contatos</h1>
    <hr class="my-4">
</div>
<div class="container">
    <p></p>
    @if ($message = Session::get('success'))
        <p></p>
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>#</th> 
            <th>Data</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Tipo</th>
            <th>Status</th>
            <th width="280px">Ação</th>
        </tr>
        @foreach ($contatos as $contato)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $contato->created_at }}</td>
            <td>{{ $contato->nome }}</td>
            <td>{{ $contato->email }}</td>
            <td>{{ $contato->tipo }}</td>
            <td>{{( $contato->status ? "Lida": "Não Lida")}}</td>
            <td>
                <form action="{{ route('contatosmanager.destroy', $contato->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('contatosmanager.show', $contato->id) }}">Exibir</a>

                
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $contatos->links() !!}
</div>

@endsection
