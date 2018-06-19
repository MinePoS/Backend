    @extends('layouts.app')

@section('content')
    <center><h3>Redirecting to paypal</h3></center>
    <img width="301" style="margin: auto;" src="http://i.imgur.com/GCNyjJY.gif"></img>
    <form name="myform" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="business" value="{{\Setting::get('paypal_email')}}" />
    <input type="hidden" name="notify_url" value="{{route('paypal.ipn')}}" />
    <input type="hidden" name="cancel_return" value="{{route('store.index')}}" />
    <input type="hidden" name="rm" value="2" />
    <input type="hidden" name="return" value="{{route('store.paymentdone')}}" />
    <input type="hidden" name="no_note" value="1" />
    <input type="hidden" name="custom" value="{{$order->id}}|{{$order->username}}"/>
    <input type="hidden" name="currency_code" value="USD" />
    <input type="hidden" name="page_style" value="paypal" />
    <input type="hidden" name="charset" value="utf-8" />
    <input type="hidden" name="item_name" value="{{\Store::homeTitle()}} Order: {{$order->id}}" />
    <input type="hidden" name="item_number" value="{{$order->id}}" />
    <input type="hidden" name="cbt" value="Back to FormGet" />
    <input type="hidden" value="_xclick" name="cmd"/>
    <input type="hidden" name="amount" value="{{$order->total}}" />
    <script type="text/javascript">
        document.myform.submit();
        document.getElementById("myform").innerHTML = "";
    </script>

    @endsection
