@extends('layouts.public')

@section('title', 'JIACRS - Jimma University')

@section('content')

    @include('home.sections.hero')

    @include('home.sections.features')

    @include('home.sections.how-it-works')

    @include('home.sections.categories')

    {{-- "Why Use JIACRS" and the Track Your Report panel sit side by side,
         so track-report is included inside why-jiacrs. --}}
    @include('home.sections.why-jiacrs')

    @include('home.sections.case-lifecycle')

    @include('home.sections.faq')

    @include('home.sections.contact')

@endsection