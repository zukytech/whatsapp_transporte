<?php
    $dnl="\n\n";
    $nl="\n\n";
    $tabSpace="      ";
?>
{{ __("Hi, I'd like to request a ride")." ๐"}} 

๐ {{ __('Pickup location') }}
{{ $order->pickup_address }}
{{ config('app.url')."/p/".$order->md }}

๐ {{ __('Destination') }}
{{ $order->delivery_address }}

๐ {{ __('Route') }}
{{ config('app.url')."/d/".$order->md }}

๐ฑ {{ __('My phone') }}
{{ $order->phone }}


๐งพ {{__('Estimated cost: ').money(($order->order_price_with_discount+$order->delivery_price), config('settings.cashier_currency'), config('settings.do_convertion')) }}
@if (strlen($order->comment)>1)   
๐ {{ __('Comment') }}
{{ $order->comment }}  
@endif

๐ {{ __('Vehicle info') }}
{{ $order->driver->name }}
{{ $order->driver->getConfig('plate_number','') }}