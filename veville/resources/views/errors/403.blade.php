@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: "Vous n'avez pas accès à cette page."))
@section('redirection', 'Vous allez être redirigé.')
