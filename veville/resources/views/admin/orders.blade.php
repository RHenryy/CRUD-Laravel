@extends('layouts.app')
@section('content')
<h1>Consultez l'historique des locations</h1>
    <form action="/agencies" method="POST">
        @csrf

        <select style="width:25%;" class=" container form-select flex" name="v_agency" id="v_agency"
            onchange="location = this.value">

            <option hidden value="">Choose your agency</option>
            <option value="/orders/">All Agencies</option>
            @foreach ($orders as $order)
                <option value="/orders/{{ $order->agency }}">Agence de {{ $order->agency }}</option>
            @endforeach
        </select>

        <table class="members center;">
            <tr>
                <th>Commande</th>
                <th>Membre</th>
                <th>Vehicule</th>
                <th>Agence</th>
                <th>date et heure</th>
                <th>date et heure</th>
                <th>Price</th>
                <th>Date et heure d'enregistrement</th>

                <th>actions</th>

            </tr>
            @foreach ($orders as $order)
                <tr onclick="window.location='/locations/show/{{ $order->id_order }}';">
                    <td> {{ $order->id_order }} </td>
                    <td> {{ $order->name }} - {{ $order->email }} </td>
                    <td> {{ $order->location }}</td>
                    <td> {{ $order->agency }} </td>
                    <td> {{ $order->begin_date_time }} </td>
                    <td> {{ $order->end_date_time }} </td>
                    <td> {{ $order->total_price }}€ </td>
                    <td> {{ $order->register_date }} </td>


                    <td> <a href="/agencies/delete/{{ $order->id_order }}">
                            <i class="fa-solid fa-trash"></i></a>

                        <a href="/agencies/edit/{{ $order->id_order }}">
                            <i class="fa-solid fa-pen-fancy"></i>
                        </a>
                    </td>

                </tr>
            @endforeach
        </table><br />
    @endsection
