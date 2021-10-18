@extends('layout')
@section('header')
    Adicionar Hóspede<br>
@endsection
@section('nav')
    <a href="/">Inicio </a>/ Adicionar
    @endsection
@section ('conteudo')
    <center>
<form method="post" enctype='multipart/form-data'>
    @csrf
    <div class="form-group">
        <label for="xml">Insira o arquivo XML </label><br>
            <input name="xml" type="file" required accept=".xml"><br><br>
        <button type="submit" class="btn btn-success">Adicionar</button>
    </div>
</form>
    </center>
@endsection
