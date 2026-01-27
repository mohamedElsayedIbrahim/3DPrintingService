@extends('layouts.app')

@section('title','الرئيسية')

@section('content')

{{-- Hero --}}
<section class="gradient-bg text-white py-20 text-center">
    <h2 class="text-4xl font-bold mb-6">
        حوّل أفكارك إلى واقع مع الطباعة ثلاثية الأبعاد
    </h2>
    <p class="text-xl opacity-90">
        خدمة طباعة 3D احترافية بأعلى جودة وأسرع وقت
    </p>
</section>

{{-- Services --}}
<section id="services" class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">خدماتنا</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $services = [
                    ['icon'=>'cube','title'=>'النماذج الأولية','price'=>50],
                    ['icon'=>'industry','title'=>'القطع الصناعية','price'=>80],
                    ['icon'=>'palette','title'=>'الموديلات الفنية','price'=>120],
                ];
            @endphp

            @foreach($services as $service)
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <i class="fas fa-{{ $service['icon'] }} text-5xl text-purple-600 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">{{ $service['title'] }}</h3>
                    <p class="text-purple-600 font-bold">
                        {{ $service['price'] }} جنية مصرى / سم³
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
