@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">

<div class="thanks__content">
  <div class="thanks__background">
    <p>Thank you</p>
  </div>
  
  <div class="thanks__foreground">
    <div class="thanks__message">
      <p>お問い合わせありがとうございました</p>
    </div>
    <div class="thanks__button">
      <a href="/" class="thanks__button-link">HOME</a>
    </div>
  </div>
</div>
@endsection