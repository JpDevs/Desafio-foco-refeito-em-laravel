<?php

namespace App\Http\Controllers;
use App\Models\Hotel;
use App\Models\HotelEdit;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Hotel::query()->orderBy('id','desc')->get();
        return view('clientes.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       return view('clientes.create');
        //
    }

    public function ViewCreate()
    {
        return view('clientes.create');
    }
    public function store(Request $request)
    {
        $xml = simplexml_load_file($request->file('xml'));

        foreach($xml->Bookings->Booking as $reserva) {
        $pedido = $reserva['id'];
        $tipo_request = $reserva['type'];
        $reserva_criacao = $reserva['createDateTime'];
        $reserva_source = $reserva['source'];
        $reserva_status = $reserva['status'];
        $reserva_adultos = $reserva->RoomStay->GuestCount['adult'];
        $reserva_kids = $reserva->RoomStay->GuestCount['child'];
        $reserva_cliente = $reserva->PrimaryGuest->Name['givenName'] . ' ' . $reserva->PrimaryGuest->Name['surname'];
        $reserva_cliente_telefone = $reserva->PrimaryGuest->Phone['countryCode'] . $reserva->PrimaryGuest->Phone['cityAreaCode'] . $reserva->PrimaryGuest->Phone['number'];
        $reserva_cliente_email = $reserva->PrimaryGuest->Email;
        $hotel_id = $reserva->Hotel['id'];
        $acomodacao_id = $reserva->RoomStay['roomTypeID'];
        $checkin = $reserva->RoomStay->StayDate['arrival'];
        $checkout = $reserva->RoomStay->StayDate['departure'];
        $bandeira_cartao = $reserva->RoomStay->PaymentCard['cardCode'];
        $numero_cartao = $reserva->RoomStay->PaymentCard['cardNumber'];
        $cartao_validade = $reserva->RoomStay->PaymentCard['expireDate'];

        if($reserva_status == 'pending') {
            $status = 'pendente';
        }

        else if ($reserva_status == 'retrieved') {
            $status = 'recuperada';
        }

        else if ($reserva_status == 'confirmed') {
            $status = 'confirmada';
        }

        else if ($reserva_status == 'expired') {
            $status = 'cancelada';
        } else {
            $status = 'confirmada';
        }

        if($tipo_request == 'cancel') {
            $status = 'cancelada';
        }

        $busca = Hotel::where('n_reserva', $pedido)->first();

        if(!is_null($busca)) {
            $request->session()->flash('red-msg','ERRO: Reserva já existente no sistema!');
            return redirect('/');
        }
        else
        {
        $query = Hotel::create([
        'n_reserva' => $pedido,
        'nome_cliente' => $reserva_cliente ,
        'cliente_email' => $reserva_cliente_email,
        'cliente_telefone' => $reserva_cliente_telefone,
        'status_reserva' => $status,
        'checkin' => $checkin,
        'checkout' => $checkout,
        'adultos' => $reserva_adultos,
        'criancas' => $reserva_kids
        ]);
        $request->session()->flash('msg','Reserva adicionada com sucesso!');
        return redirect ('/');

        }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = Hotel::find($id);
        return view('clientes.edit',compact('data','id'));
        //
    }

    public function editxml($id)
    {
        $data = Hotel::find($id);
        return view('clientes.xml',compact('id','data'));

    }

    public function updatexml($id,Request $request)
    {
        $xml = simplexml_load_file($request->file('xml'));

            foreach($xml->Bookings->Booking as $reserva)
            {
            $pedido = $reserva['id'];
            $tipo_request = $reserva['type'];
            $reserva_criacao = $reserva['createDateTime'];
            $reserva_source = $reserva['source'];
            $reserva_status = $reserva['status'];
            $reserva_adultos = $reserva->RoomStay->GuestCount['adult'];
            $reserva_kids = $reserva->RoomStay->GuestCount['child'];
            $reserva_cliente = $reserva->PrimaryGuest->Name['givenName'] . ' ' . $reserva->PrimaryGuest->Name['surname'];
            $reserva_cliente_telefone = $reserva->PrimaryGuest->Phone['countryCode'] . $reserva->PrimaryGuest->Phone['cityAreaCode'] . $reserva->PrimaryGuest->Phone['number'];
            $reserva_cliente_email = $reserva->PrimaryGuest->Email;
            $hotel_id = $reserva->Hotel['id'];
            $acomodacao_id = $reserva->RoomStay['roomTypeID'];
            $checkin = $reserva->RoomStay->StayDate['arrival'];
            $checkout = $reserva->RoomStay->StayDate['departure'];
            $bandeira_cartao = $reserva->RoomStay->PaymentCard['cardCode'];
            $numero_cartao = $reserva->RoomStay->PaymentCard['cardNumber'];
            $cartao_validade = $reserva->RoomStay->PaymentCard['expireDate'];

            if ($reserva_status == 'pending') {
                $status = 'pendente';
            } else if ($reserva_status == 'retrieved') {
                $status = 'recuperada';
            } else if ($reserva_status == 'confirmed') {
                $status = 'confirmada';
            } else if ($reserva_status == 'expired') {
                $status = 'cancelada';
            } else {
                $status = 'confirmada';
            }

            if ($tipo_request == 'cancel') {
                $status = 'cancelada';
            }
            $query = HotelEdit::where('id',$id)->update([
                'nome_cliente' => $reserva_cliente ,
                'cliente_email' => $reserva_cliente_email,
                'cliente_telefone' => $reserva_cliente_telefone,
                'status_reserva' => $status,
                'checkin' => $checkin,
                'checkout' => $checkout,
                'adultos' => $reserva_adultos,
                'criancas' => $reserva_kids
            ]);

            if($query) {
                $request->session()->flash('msg','Reserva Editada com sucesso');
                return redirect ('/');
            }
        }
    }

    public function getVoucher(Request $request,$id)
    {
        $data = Hotel::find($id);
        return view('clientes.voucher',compact('data','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $query = HotelEdit::where('id',$id)->update([

            'nome_cliente' => $data['nomeCliente'],
            'cliente_cpf' => $data['cpfCliente'],
            'cliente_email' => $data['mailCliente'],
            'cliente_telefone' =>  $data['telCliente'],
            'checkin' => $data['Checkin'],
            'checkout' => $data['CheckOut'],
            'adultos' => $data['adultos'],
            'criancas' => $data['kids'],
            'status_reserva' => $data['statusreserva']
        ]);
        if($query) {
        $request->session()->flash('msg','Reserva atualizada com sucesso');
        return redirect('/');
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Hotel::where('id',$id)->delete();
        $request->session()->flash('red-msg','Reserva deletada com sucesso');
        return redirect('/');
    }
}
