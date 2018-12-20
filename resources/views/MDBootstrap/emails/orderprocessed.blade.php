@extends('layouts.email')
@section('header')
Order #{{$order->id}} Processed
@endsection
@section('content')
<pre>
ID: {{$order->id}}
Username: {{$order->username}}
Cost: {{$order->lastIPN()['payment_gross']}} {{$order->lastIPN()['mc_currency']}}
Payment Status: {{$order->lastIPN()['payment_status']}}
Payment Date: {{$order->lastIPN()['payment_date']}}
Transaction ID: {{$order->lastIPN()['txn_id']}}

Thank you for your purchase,
Your order has been processed.
</pre>
@endsection

