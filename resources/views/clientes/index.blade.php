@extends('layout')
@section('header')
    Gerenciar Reservas
    @endsection
@section ('conteudo')
    @if (!empty(@session('msg')))
    <div class="alert alert-success" role="alert">
       {{@session('msg')}}
    </div>
    @endif
    @if (!empty(@session('red-msg')))
        <div class="alert alert-danger" role="alert">
            {{@session('red-msg')}}
        </div>
    @endif
    <a href="adicionar" class="btn btn-dark">Adicionar</a><br><br>
    <table class="table">
        <tr class="tr">
        <th>ID</th>
        <th>Nº Reserva</th>
        <th>Cliente</th>
        <th>Status</th>
        <th>Crianças</th>
        <th>Adultos</th>
        <th>Check-In</th>
        <th>Check-Out</th>
        <th>Ações</th>
            @foreach ($clientes as $hotel)
        </tr>
            <tr>
            <td>{{$hotel->id}}</td>
            <td>{{$hotel->n_reserva}}</td>
            <td>{{$hotel->nome_cliente}}</td>
            <td>{{ucfirst($hotel->status_reserva)}}</td>
            <td>{{$hotel->criancas}}</td>
            <td>{{$hotel->adultos}}</td>
            <td>{{date('d/m/Y',strtotime($hotel->checkin))}}</td>
            <td>{{date('d/m/Y',strtotime($hotel->checkout))}}</td>
            <td>

                <form action="remover/{{$hotel->id}}" method="post">
                    @csrf
                <a href="editar/{{$hotel->id}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                <a href="voucher/{{$hotel->id}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </form></td>

    @endforeach
    </table>
    @endsection
