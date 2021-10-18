@extends('layout')
@section('header')
    Editar Reserva
@endsection
@section('nav')
    <a href="/">Inicio</a> / Editar
@endsection
@section ('conteudo')
    <center><span>Reserva nº {{$data->n_reserva}}</span></center>
    <br>
        <form method="post" action="">
            @csrf
            <div class="form-group row">
                <div class="form-group col-md-6">
                <label for="NomeCliente">Nome do cliente</label>
                <input name="nomeCliente" type="text" class="form-control" value="{{$data->nome_cliente}}" id="NomeCliente" placeholder="Nome Completo" required>
            </div>
            <div class="form-group col-md-6">
                <label for="cpfCliente">CPF/CNPJ</label>
                <input type="tel" name="cpfCliente" class="form-control" id="cpfCliente"  value="{{$data->cliente_cpf}}" placeholder="CPF/CNPJ">
            </div></div>
            <hr>
            <div class="form-group row">
                <div class="form-group col-md-6">
                <label for="emailCliente">Email do cliente</label>
                <input type="email" name="mailCliente" class="form-control" id="emailCliente"  value="{{$data->cliente_email}}" placeholder="exemplo@email.com">
            </div>
            <div class="form-group col-md-6">
                <label for="telCliente">Telefone</label>
                <input type="tel" name="telCliente" class="form-control" id="telCliente"  value="{{$data->cliente_telefone}}" placeholder="exemplo@email.com">
            </div></div>
            <hr>
            <div class="form-group row">
            <div class="form-group col-md-6">
            <label for="checkin">Check-In:</label>
                <input type="date" name="Checkin" value="{{$data->checkin}}" class="form-control"></div>
                <div class="form-group col-md-6">
                    <label for="checkout">Check-Out:</label>
                    <input type="date" name="CheckOut" value="{{$data->checkout}}" class="form-control"></div>
            </div>
            <div class="form-group row">
                <div class="form-group col-md-6">
                    <label for="criancas">Crianças:</label>
                    <input type="number" name="kids" min="0" step="1"  max="7" value="{{$data->criancas}}" class="form-control"></div>
                <div class="form-group col-md-6">
                    <label for="checkout">Adultos:</label>
                    <input type="number"  name="adultos" min="0" step="1" max="7" value="{{$data->adultos}}" class="form-control"></div>
            </div>
            <div class="form-group">
                <label for="SelectStatus">Status da Reserva</label>
                <select name="statusreserva" class="form-control" id="SelectStatus">
                    <option @if($data->status_reserva == 'pendente') selected @endif >Pendente</option>
                    <option @if($data->status_reserva == 'recuperada') selected @endif>Recuperada</option>
                    <option @if($data->status_reserva == 'confirmada') selected @endif>Confirmada</option>
                    <option @if($data->status_reserva == 'cancelada') selected @endif>Cancelada</option>
                </select>


            </div>
            <center><button type="submit" class="btn btn-primary">Salvar Reserva</button>
            <a class="btn btn-warning" href="/editar/xml/{{$id}}">Carregar XML</a>
            <a class="btn btn-danger" href="/">Cancelar Edição</a></center>


            <br><br><br>
        </form>

@endsection
