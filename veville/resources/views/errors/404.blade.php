@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __("La page n'existe pas."))
@section('redirection', 'Vous allez être redirigé.')
