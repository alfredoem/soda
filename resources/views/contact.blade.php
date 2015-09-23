@extends('soda::template')

@section('content')

    <?php $noice = Soda::aloha() ?>
    <h2>{{$noice}}</h2>

@stop