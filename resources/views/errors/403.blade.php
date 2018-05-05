@extends('errors::layout')

@section('title', 'Action Unauthorized')

@section('message', $exception->getMessage())
