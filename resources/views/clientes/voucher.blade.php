@extends('layout')
@section('header')
   Voucher Foco Hotel
@endsection
@section('nav')
    @endsection
@section ('conteudo')
    <center><span>Reserva nº {{$data->n_reserva}}</span></center>
    <br>
    <form method="post" action="">
        @csrf
        <div class="form-group row">
            <div class="form-group col-md-6">
                <label for="NomeCliente">Nome do cliente</label>
                <input name="nomeCliente" readonly type="text" class="form-control" value="{{$data->nome_cliente}}" id="NomeCliente" placeholder="Nome Completo" required>
            </div>
            <div class="form-group col-md-6">
                <label for="cpfCliente">CPF/CNPJ</label>
                <input type="tel" readonly name="cpfCliente" class="form-control" id="cpfCliente"  value="{{$data->cliente_cpf}}" placeholder="CPF/CNPJ">
            </div></div>
        <hr>
        <div class="form-group row">
            <div class="form-group col-md-6">
                <label for="emailCliente">Email do cliente</label>
                <input type="email" readonly name="mailCliente" class="form-control" id="emailCliente"  value="{{$data->cliente_email}}" placeholder="exemplo@email.com">
            </div>
            <div class="form-group col-md-6">
                <label for="telCliente">Telefone</label>
                <input type="tel" readonly name="telCliente" class="form-control" id="telCliente"  value="{{$data->cliente_telefone}}" placeholder="exemplo@email.com">
            </div></div>
        <hr>
        <div class="form-group row">
            <div class="form-group col-md-6">
                <label for="checkin">Check-In:</label>
                <input type="date" readonly name="Checkin" value="{{$data->checkin}}" class="form-control"></div>
            <div class="form-group col-md-6">
                <label for="checkout">Check-Out:</label>
                <input type="date" readonly name="CheckOut" value="{{$data->checkout}}" class="form-control"></div>
        </div>
        <div class="form-group row">
            <div class="form-group col-md-6">
                <label for="criancas">Crianças:</label>
                <input type="number" readonly name="kids" min="0" step="1"  max="7" value="{{$data->criancas}}" class="form-control"></div>
            <div class="form-group col-md-6">
                <label for="checkout">Adultos:</label>
                <input type="number"  readonly name="adultos" min="0" step="1" max="7" value="{{$data->adultos}}" class="form-control"></div>
        </div>
        <div class="form-group">
            <label for="SelectStatus">Status da Reserva</label>
            <input type="text"  readonly value="{{ucfirst($data->status_reserva)}}" class="form-control"></div>
            </select>


        </div>
        <center>
            <a class="btn btn-success" href="/">Voltar</a>
            <a class="btn btn-warning" onclick="window.print();" href="#">Imprimir</a>
        <br><br><br>
    </form>

@endsection

