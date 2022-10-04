@extends('site.layout')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Projeto Laravel - Cadastro de contatos</h1>
    <hr class="my-4">
</div>
<div class="container">
    <a class="btn btn-success" href="{{ route('contatosmanager.create') }}">Criar Novo contato</a>
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
            <th>Nome</th>
            <th>Descrição</th>
            <th>Imagem</th>
            <th width="280px">Ação</th>
        </tr>
        @foreach ($contatos as $contato)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $contato->nome }}</td>
            <td>{{ $contato->descricao }}</td>
            <td>{{ $contato->imagem }}</td>
            <td>
                <form action="{{ route('contatosmanager.destroy', $contato->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('contatosmanager.show', $contato->id) }}">Exibir</a>

                    <a class="btn btn-primary" href="{{ route('contatosmanager.edit', $contato->id) }}">Editar</a>

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
