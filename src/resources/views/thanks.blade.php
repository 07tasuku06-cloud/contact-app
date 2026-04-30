@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')

<div class="thanks">

    <div class="thanks__container">

        <h2 class="thanks__title">Thank you</h2>

        <p class="thanks__text">
            お問い合わせありがとうございました
        </p>

        <a href="/" class="thanks__link">
            HOMEへ戻る
        </a>

    </div>

</div>

@endsection