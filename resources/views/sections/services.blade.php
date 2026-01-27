<section id="services" class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">خدماتنا</h2>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                ['icon'=>'fa-cube','title'=>'النماذج الأولية','price'=>50],
                ['icon'=>'fa-industry','title'=>'القطع الصناعية','price'=>80],
                ['icon'=>'fa-palette','title'=>'الموديلات الفنية','price'=>120],
            ] as $service)
                <div class="service-card bg-white rounded-xl shadow-lg p-6 text-center">
                    <i class="fas {{ $service['icon'] }} text-5xl text-purple-600 mb-4"></i>
                    <h3 class="text-xl font-bold">{{ $service['title'] }}</h3>
                    <p class="text-purple-600 font-bold mt-2">
                        {{ $service['price'] }} ريال / سم³
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
