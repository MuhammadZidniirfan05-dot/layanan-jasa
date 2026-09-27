@extends('layouts.app')

@section('content')

@php
    $headlineHtml = preg_replace(
        '/\*\*(.*?)\*\*/',
        '<span style="color: var(--brand-accent)">$1</span>',
        e($settings->hero_headline)
    );

    $avgRating = $testimonials->count() ? round($testimonials->avg('rating'), 1) : 5.0;

    $categoryIcons = [
        'website' => 'M12 21a9 9 0 100-18 9 9 0 000 18zM3.6 9h16.8M3.6 15h16.8M12 3c2.5 2.8 3.8 6 3.8 9s-1.3 6.2-3.8 9c-2.5-2.8-3.8-6-3.8-9s1.3-6.2 3.8-9z',
        'tugas-kuliah' => 'M22 9L12 4 2 9l10 5 10-5zM6 11.5V17c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5M22 9v6',
        'presentasi-ppt' => 'M3 5h18v12H3zM3 19h18M9 9l3 2-3 2V9z',
        'desain-grafis' => 'M12 19l7-7 3 3-7 7-3-3zM18 13l-1.5-7.5L11 4l1 6.5L18 13zM3 21c1-1.5 2-2 4-2s3 .5 4 2',
    ];
    $defaultIcon = 'M9 12l2 2 4-4m5.5 2a9.5 9.5 0 11-19 0 9.5 9.5 0 0119 0z';
    $categoryDescs = [
        'website' => 'Landing page, company profile, sampai toko online yang rapi dan responsif.',
        'tugas-kuliah' => 'Bantuan makalah, laporan, dan tugas kuliah dengan hasil rapi dan tepat waktu.',
        'presentasi-ppt' => 'Slide presentasi yang menarik, profesional, dan siap dipresentasikan.',
        'desain-grafis' => 'Logo, poster, dan materi visual kreatif untuk kebutuhan kamu.',
    ];

    $whyUsPoints = [
        ['icon' => 'M12 22a10 10 0 100-20 10 10 0 000 20zM12 6v6l4 2', 'title' => 'Cepat & Tepat Waktu', 'desc' => 'Sesuai deadline yang disepakati.'],
        ['icon' => 'M12 22a10 10 0 100-20 10 10 0 000 20zM12 16a4 4 0 100-8 4 4 0 000 8zM12 12h.01', 'title' => 'Sesuai Kebutuhan', 'desc' => 'Konsultasi dulu sebelum dikerjakan.'],
        ['icon' => 'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75', 'title' => 'Support Responsif', 'desc' => 'Chat cepat dibalas via WhatsApp.'],
    ];
@endphp

@include('partials.navbar')

@include('partials.sections.hero')
@include('partials.sections.layanan')
@include('partials.sections.feature-chips')
@include('partials.sections.about')
@include('partials.sections.portfolio')
@include('partials.sections.testimoni')
@include('partials.sections.faq')
@include('partials.sections.cta')



@endsection