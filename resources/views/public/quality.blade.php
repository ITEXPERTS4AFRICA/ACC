@extends('layouts.public')
@section('page-title', app()->getLocale() === 'fr' ? 'Qualité & Certifications — ACC' : 'Quality & Certifications — ACC')

@section('content')

{{-- HERO --}}
<section class="relative h-[460px] flex items-end bg-dark overflow-hidden" style="background-image: url('{{ asset("images/quality/hero-quality.png") }}')">
    <div class="absolute inset-0 bg-gradient-to-t from-dark/90 via-dark/50 to-dark/10"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 pb-16 w-full ">
        <p class="section-tag mb-3">Global Standards</p>
        <h1 class="font-playfair text-5xl font-bold text-white leading-tight max-w-3xl">
            {{ app()->getLocale() === 'fr' ? 'Excellence et Conformité' : 'Excellence and Compliance' }}
        </h1>
        <p class="text-white/60 text-sm mt-4 max-w-2xl leading-relaxed">
            {{ app()->getLocale() === 'fr'
                ? "Notre Système de Management Intégré de la Qualité garantit que chaque gramme de cacao livré répond aux standards internationaux — engagement envers la sécurité, la pureté et l'approvisionnement éthique."
                : "Our Integrated Quality Management System ensures that every gram of cocoa meeting the international trade market standards is a testament to our commitment to safety, purity, and ethical sourcing." }}
        </p>
    </div>
</section>

{{-- CERTIFIÉ POUR LA LOGISTIQUE GLOBALE --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-12">
            <h2 class="font-playfair text-3xl font-bold text-navy mb-2">{{ app()->getLocale() === 'fr' ? 'Certifié pour la Logistique Mondiale' : 'Certified for Global Logistics' }}</h2>
            <p class="text-gray-500 text-sm">{{ app()->getLocale() === 'fr' ? 'Nous adhérons aux standards les plus rigoureux de sécurité alimentaire et d\'éthique du travail.' : 'We adhere to the world\'s most rigorous food safety and ethical labor standards to provide institutional partners with total transparency.' }}</p>
    {{-- HERO --}}
    <section class="relative h-[460px] flex items-end bg-dark overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-dark/90 via-dark/50 to-dark/10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 pb-16 w-full">
            <p class="section-tag mb-3">Global Standards</p>
            <h1 class="font-playfair text-5xl font-bold text-white leading-tight max-w-3xl">
                {{ app()->getLocale() === 'fr' ? 'Excellence et Conformité' : 'Excellence and Compliance' }}
            </h1>
            <p class="text-white/60 text-sm mt-4 max-w-2xl leading-relaxed">
                {{ app()->getLocale() === 'fr'
        ? "Notre Système de Management Intégré de la Qualité garantit que chaque gramme de cacao livré répond aux standards internationaux — engagement envers la sécurité, la pureté et l'approvisionnement éthique."
        : "Our Integrated Quality Management System ensures that every gram of cocoa meeting the international trade market standards is a testament to our commitment to safety, purity, and ethical sourcing." }}
            </p>
        </div>
    </section>

    {{-- CERTIFIÉ POUR LA LOGISTIQUE GLOBALE --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-12">
                <h2 class="font-playfair text-3xl font-bold text-navy mb-2">
                    {{ app()->getLocale() === 'fr' ? 'Certifié pour la Logistique Mondiale' : 'Certified for Global Logistics' }}
                </h2>
                <p class="text-gray-500 text-sm">
                    {{ app()->getLocale() === 'fr' ? 'Nous adhérons aux standards les plus rigoureux de sécurité alimentaire et d\'éthique du travail.' : 'We adhere to the world\'s most rigorous food safety and ethical labor standards to provide institutional partners with total transparency.' }}
                </p>
            </div>

            {{-- Grille certifications --}}
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                {{-- FSSC 22000 --}}
                <div class="border border-gray-200 rounded-sm p-6">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-navy/5 rounded-sm flex items-center justify-center text-2xl flex-shrink-0">
                            🛡️</div>
                        <div>
                            <h3 class="font-bold text-navy text-lg">FSSC 22000</h3>
                            <p class="text-gray-500 text-sm mt-1 leading-relaxed">
                                {{ app()->getLocale() === 'fr' ? 'Certification Système de Sécurité Alimentaire garantissant une gestion complète des risques sanitaires sur toute la chaîne de production.' : 'Food Safety System Certification ensuring comprehensive management of safety hazards across the production chain.' }}
                            </p>
                        </div>
                    </div>
                    <a href="#"
                        class="text-navy text-[10px] font-bold uppercase tracking-widest inline-flex items-center gap-1 hover:text-amber transition">
                        View Compliance <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- SEDEX --}}
                <div class="border border-gray-200 rounded-sm p-6 grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="font-bold text-navy text-lg mb-2">SEDEX 4 Pillars Audited</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            {{ app()->getLocale() === 'fr' ? 'Nos installations sont auditées selon les 4 piliers : Standards du Travail, Santé & Sécurité, Environnement et Éthique des Affaires.' : 'Our facilities are audited against four key pillars: Labour Standards, Health & Safety, Environment, and Business Ethics.' }}
                        </p>
                        <div class="grid grid-cols-2 gap-2 mt-4">
                            @foreach(['Labour Standards', 'Health & Safety', 'Environment', 'Business Ethics'] as $p)
                                <div class="text-[10px] text-gray-500 flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-navy flex-shrink-0"></span>{{ $p }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="rounded-sm overflow-hidden bg-gray-50 flex items-center justify-center">
                        <span class="text-5xl opacity-20">🌿</span>
                    </div>
                </div>

                {{-- ISO --}}
                <div class="border border-gray-200 rounded-sm p-6">
                    <h3 class="font-bold text-navy text-lg mb-2">ISO Certifications</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">
                        {{ app()->getLocale() === 'fr' ? 'Maintien d\'un management de qualité élevé (ISO 9001) et d\'un management environnemental (ISO 14001) dans nos usines d\'Abidjan et du Cameroun.' : 'Maintaining high-level quality management (ISO 9001) and environmental management (ISO 14001) throughout our Abidjan and Cameroon plants.' }}
                    </p>
                    <div class="flex gap-3">
                        @foreach(['ISO 9001:2015', 'ISO 14001:2015'] as $iso)
                            <span
                                class="border border-navy text-navy text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-sm">{{ $iso }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/quality/sedex-logo.png') }}" alt="SEDEX Logo" class="h-full object-cover">
                </div>

                {{-- EUDR --}}
                <div class="border border-gray-200 rounded-sm p-6 bg-navy/2">
                    <h3 class="font-bold text-navy text-lg mb-2">EUDR Ready</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">
                        {{ app()->getLocale() === 'fr' ? 'Respect strict du Règlement européen sur la déforestation. Chaque lot de cacao est géolocalisé et tracé jusqu\'à sa parcelle d\'origine.' : 'Strict adherence to the EU Deforestation Regulation. Every batch of cocoa is geolocated and traced back to its plot of origin.' }}
                    </p>
                    <span
                        class="inline-flex items-center gap-2 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-sm">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        Traceability Verified
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- LABORATOIRES --}}
    <section class="py-20 bg-surface">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="font-playfair text-3xl font-bold text-navy mb-6">
                    {{ app()->getLocale() === 'fr' ? 'Laboratoires Analytiques Avancés' : 'Advanced Analytical Laboratories' }}
                </h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-8">
                    {{ app()->getLocale() === 'fr'
        ? "Nos laboratoires internes au Cameroun et en Côte d'Ivoire réalisent des tests physiques, chimiques et microbiologiques rigoureux sur chaque production."
        : "Our on-site laboratories in Cameroon and Ivory Coast perform rigorous physical, chemical, and microbiological testing on every production run." }}
                </p>
                <div class="space-y-5">
                    @foreach([
                            ['num' => '01', 'title' => app()->getLocale() === 'fr' ? 'Évaluation Sensorielle' : 'Sensory Evaluation', 'body' => app()->getLocale() === 'fr' ? 'Panels organoleptiques experts assurant la cohérence des profils.' : 'Expert organoleptic panels ensure profile consistency.'],
                            ['num' => '02', 'title' => app()->getLocale() === 'fr' ? 'Tests de Contaminants' : 'Contaminant Testing', 'body' => app()->getLocale() === 'fr' ? 'Tests HPLC avancés pour la pureté et la conformité de sécurité.' : 'Advanced HPLC testing for purity and safety compliance.'],
                        ] as $lab)
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-navy flex items-center justify-center flex-shrink-0">
                                <span class="text-white text-[10px] font-bold">{{ $lab['num'] }}</span>
                            </div>
                            <div>
                                <p class="font-bold text-navy text-sm">{{ $lab['title'] }}</p>
                                <p class="text-gray-500 text-sm mt-1">{{ $lab['body'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>


                        </div>


                        <div class="grid grid-cols-2 gap-3">
                <div class="aspect-[3/4] bg-gray-100 rounded-sm overflow-hidden"><div class="w-full h-full flex items-center justify-center text-5xl opacity-20">🔬</div></div>
                <div class="aspect-[3/4] bg-gray-100 rounded-sm overflow-hidden mt-6"><div class="w-full h-full flex items-center justify-center text-5xl opacity-20">🧪</div></div>
            </div>
        </div>
    </section>

    {{-- TABLEAU DOCUMENTS --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="font-playfair text-3xl font
                        -bold text-navy">

                                        {{ app()->getLocale() === 'fr' ? 'Standards & Documents de Sécurité' : 'Safety Standards & Docs' }}
                    </h2>

                                   <p class="text-gray-500 text-sm mt-1">{{ app()->getLocale() === 'fr' ? 'Téléchargez nos derniers documents de certification pour vos dossiers de conformité.' : 'Download our latest certification documents for your compliance files.' }}</p>
                </div>
                <a href="#" class="inline-flex items-center gap-2 text-navy text-xs font-bold uppercase tracking-widest hover:text-amber transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download All (ZIP)
                </a>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div class="aspect-[3/4] bg-gray-100 rounded-sm overflow-hidden"> <img src="{{ asset('images/quality/laboratory-1.png') }}" alt="Laboratory Image" class="w-full h-full object-cover"> </div>
            <div class="aspect-[3/4] bg-gray-100 rounded-sm overflow-hidden mt-6"> <img src="{{ asset('images/quality/laboratory-2.png') }}" alt="Laboratory Image" class="w-full h-full object-cover"> </div>
        </div>
    </div>
</section>

            <div class="border border-gray-200 rounded-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">

                                                    <tr>


                                                                                   <th
                                class="px-6 py-3"></th>

                                                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ app()->getLocale() === 'fr' ? 'Document' : 'Document Name' }}</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider hidden md:table-cell">Type</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider hidden lg:table-cell">{{ app()->getLocale() === 'fr' ? 'Date d\'émission' : 'Issue Date' }}</th>
                            <th class="text-center px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($certifications as $cert)
                            <tr class="hover:bg-gray-50 transition-colors">

                                                               <td class="px-6 py-4 w-16">
                                    @if($cert->logo)

                                        <img src="{{ asset('storage/' . $cert->logo) }}" alt="{{ $cert->name_locale }}" class="h-8 w-auto object-contain">
                                    @else
                                        <div class="h-8 w-8 bg-gray-50 rounded-sm flex items-center justify-center text-lg">🛡️</div>
                                    @endif
                                 </td>
                                <td class="px-6 py-4">
                                    <a href="{{ $cert->pdf ? asset('storage/' . $cert->pdf) : '#' }}"
                                       class="font-medium text-navy hover:text-amber transition">
                                    {{ $cert->name_locale }}</a>
                                </td>
                                <td class
                                       ="px-6 py-4 text-gray-400 text-xs hidden md:table-cell">PDF</td>
                                <td class="px-6 py-4 text-gray-400 text-xs hidden lg:table-cell">{{ $cert->created_at->format('M Y') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-widest px-2 py-0.5 rounded-sm">Active</span>
                                </td>

                                                               <td class="px-6 py-4 text-right">



                                                                    @if($cert->pdf)
                                                                        <a href="{{ asset('storage/' . $cert->pdf) }}" download class="text-navy hover:text-amber transition">
                                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                                        </a>
                                                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if($certifications->isEmpty())











                             @foreach(['FSSC 22000 Certificate — Cameroon Plant|Jan 2024', 'SEDEX SMETA Audit Summary 2024|Feb 2024', 'Product Specification: Cocoa Liquor Premium|Dec 2023', 'ISO 14001:2015 — Ivory Coast Operations|Nov 2023'] as $row)
                                @php [$doc, $date] = explode('|', $row); @endphp
                                <tr class="hover:bg-gray-50"><td class="px-6 py-4 text-navy font-medium">{{ $doc }}</td><td class="px-6 py-4 text-gray-400 text-xs hidden md:table-cell">PDF</td><td class="px-6 py-4 text-gray-400 text-xs hidden lg:table-cell">{{ $date }}</td><td class="px-6 py-4 text-center"><span class="bg-green-100 text-green-700 text-[10px] font-bold uppercase px-2 py-0.5 rounded-sm">Active</span></td><td class="px-6 py-4 text-right"><svg class="w-5 h-5 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg></td></tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-slate py-14 text-center">


                    <div class="max-w-xl mx-auto px-6">
            <h2 class="font-playfair text-2xl font-bold text-white m
                   b-3">Ready for Partnership?</h2>

                           <p class="text-white/60 text-sm mb-8">{{ app()->getLocale() === 'fr' ? 'Notre équipe est prête à discuter de vos exigences qualité et de vos besoins en chaîne d\'approvisionnement.' : 'Our team is ready to discuss your specific quality requirements and supply chain needs.' }}</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route(app()->getLocale() . '.contact') }}" class="bg-white text-navy uppercase tracking-widest text-xs font-bold px-7 py-3 rounded-sm hover:bg-cream transition">Request Documentation</a>
                <a href="{{ route(app()->getLocale() . '.contact') }}" class="border border-white/40 text-white uppercase tracking-widest text-xs font-bold px-7 py-3 rounded-sm hover:bg-white/10 transition">Contact Sales</a>
            </div>
        </div>
    </section>

@endsection
