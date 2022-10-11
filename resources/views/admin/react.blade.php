@extends('admin.layouts.master')

@section('content')


@component('admin.components.navbar')
@slot('title',"React")
@endcomponent

<?php

$order_id = 24;


?>

<div id="root" data-order_id="{{$order_id}}"  ></div>
<script src="{{mix('js/TestPage.js')}}" ></script>


@endsection
