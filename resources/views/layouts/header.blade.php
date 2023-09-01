<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ClientBookManager - Calendar</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="{{ asset('icons/icons8-calendar-plus-96.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('icons/icons8-calendar-plus-96.png') }}" type="image/x-icon">

    <link rel="stylesheet" href='{{ asset('css/bootstrap.min.css') }}'>
    <link rel="stylesheet" href='{{ asset('css/fullcalendar.min.css') }}'>
    <link rel="stylesheet" href='{{ asset('css/toastr.min.css') }}'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
