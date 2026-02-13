<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN - Western Visayas Economic Profile</title>
    <link rel="icon" type="image/png" href="{{ asset('dti-logo.png') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'], },
                    colors: {
                        arbitra: {
                            black: '#000000',
                            dark: '#0A0A0A',
                            emerald: '#10b981',
                            gray: '#888888',
                        }
                    },
                    borderRadius: { 'bento': '2rem', }
                }
            }
        }
    </script>
    
    <style>
        body { background-color: #000000; color: #FFFFFF; font-size: 14px; }
        [x-cloak] { display: none !important; }
        .bento-card {
            background: rgba(28, 28, 30, 0.6);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .bento-card:hover { border-color: rgba(16, 185, 129, 0.6); }
        .emerald-text { color: #10b981; }
        .nav-link { font-size: 12px; font-weight: 600; color: #888888; transition: all 0.2s ease; }
        .nav-link:hover, .nav-link.active { color: #FFFFFF; }
        
        /* Admin Specific */
        .admin-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            z-index: 50;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .admin-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            color: white;
            width: 100%;
        }
        .admin-label {
            font-size: 10px;
            font-weight: 800;
            color: #10b981;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
    </style>
</head>
<body x-data="adminApp()" class="antialiased font-sans">
    <nav class="fixed top-0 w-full z-40 bg-arbitra-black/80 backdrop-blur-xl border-b border-white/5 py-4">
        <div class="max-w-[1240px] mx-auto px-8 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="bg-arbitra-emerald text-arbitra-black px-3 py-1 rounded-md font-black text-[10px] uppercase">ADMIN PANEL</span>
                <h1 class="text-sm font-black tracking-tight uppercase">Dashboard Control</h1>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="flex bg-white/5 rounded-lg p-1 mr-4">
                    <a href="/admin?year={{ $selectedYear }}" class="px-4 py-1.5 rounded-md text-[10px] font-black uppercase transition-all bg-arbitra-emerald text-arbitra-black">Visual Edit</a>
                    <a href="/admin/grid?year={{ $selectedYear }}" class="px-4 py-1.5 rounded-md text-[10px] font-black uppercase transition-all text-arbitra-gray hover:text-white">Spreadsheet</a>
                </div>

                <a href="/admin/export?year={{ $selectedYear }}" class="flex items-center gap-2 bg-white/5 border border-white/10 px-4 py-2 rounded-full text-xs font-bold hover:bg-white/10 transition-all mr-4">
                    <svg class="w-3 h-3 text-arbitra-emerald" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    EXCEL
                </a>

                @foreach($years as $year)
                    <a href="?year={{ $year }}" 
                       class="px-3 py-1 rounded-full text-[10px] font-bold transition-all {{ $selectedYear == $year ? 'bg-arbitra-emerald text-arbitra-black' : 'text-arbitra-gray hover:text-white' }}">
                        {{ $year }}
                    </a>
                @endforeach
                <button @click="showAddYear = true" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-arbitra-emerald hover:text-arbitra-black transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                </button>
                
                <div class="h-6 w-px bg-white/10 mx-2"></div>
                
                <button @click="confirmDeleteYear('{{ $selectedYear }}')" class="group flex items-center gap-2 text-arbitra-gray hover:text-red-500 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    <span class="text-[10px] font-black uppercase tracking-widest hidden group-hover:block">Delete Year</span>
                </button>
            </div>

            <a href="/" class="text-xs font-bold text-arbitra-emerald hover:underline">View Public Site</a>
        </div>
    </nav>

    <main class="pt-28 pb-20 px-8">
        <div class="max-w-[1240px] mx-auto space-y-16">
            
            @php $hero = $contents->where('type', 'hero')->first(); @endphp
            <div id="section-hero" class="scroll-mt-32">
                @if($hero)
                    <div x-data="{ 
                        editing: false, 
                        techy: false,
                        editingModal: false,
                        form: @js($hero->content), 
                        title: @js($hero->section_title), 
                        source: @js($hero->source),
                        modalJson: JSON.stringify(@js($hero->content['modal_details'] ?? null), null, 4),
                        init() {
                            this.$watch('form.modal_details', (val) => {
                                this.modalJson = JSON.stringify(val, null, 4);
                            });
                        }
                    }" class="grid grid-cols-1 lg:grid-cols-3 gap-6 relative">
                        <!-- Hero Content Preview (Match Public Site) -->
                        <div @click="editing = true" class="lg:col-span-2 bento-card p-12 flex flex-col justify-center bg-gradient-to-br from-arbitra-dark to-arbitra-black cursor-pointer group hover:border-arbitra-emerald/60 transition-all relative overflow-hidden">
                            <div class="absolute inset-0 bg-arbitra-emerald/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            <div class="relative z-10">
                                <div class="flex items-center gap-3 mb-10">
                                    <span class="px-5 py-1.5 rounded-full bg-arbitra-emerald/10 text-arbitra-emerald font-black text-[10px] uppercase tracking-[0.2em] border border-arbitra-emerald/20">Investment Motivation</span>
                                    <div class="px-3 py-1 rounded-full bg-white/5 border border-white/10 text-[10px] font-bold text-white/50 group-hover:text-white group-hover:bg-arbitra-emerald/20 transition-all flex items-center gap-2">
                                        <span>CLICK TO EDIT</span>
                                    </div>
                                </div>
                                <h2 class="text-6xl font-black mb-10 leading-[1] tracking-tighter uppercase italic group-hover:text-white transition-colors" x-text="form.title || 'Why Invest in Western Visayas?'"></h2>
                                <p class="text-lg text-arbitra-gray max-w-xl leading-relaxed font-medium group-hover:text-white/80 transition-colors" x-text="form.description"></p>
                            </div>

                            <div class="pt-8 mt-auto border-t border-white/5 relative z-10">
                                <span class="text-[10px] font-bold text-arbitra-gray uppercase tracking-widest block mb-1">Source</span>
                                <p class="text-xs text-arbitra-emerald font-bold" x-text="source"></p>
                            </div>
                            
                            <!-- Admin Edit Overlay (Inside Hero) -->
                            <div x-show="editing" x-cloak class="admin-overlay overflow-y-auto">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-xl font-black uppercase italic text-arbitra-emerald">Editing Hero</h3>
                                    <button @click.stop="techy = !techy" class="text-[10px] font-black uppercase text-white/40 hover:text-white border border-white/10 px-3 py-1 rounded" x-text="techy ? 'Switch to Easy Mode' : 'Switch to Techy Mode'"></button>
                                </div>
                                <div x-show="techy">
                                    <label class="admin-label">Raw JSON Data</label>
                                    <textarea @click.stop x-model="JSON.stringify(form, null, 2)" @change="try { form = JSON.parse($event.target.value) } catch(e) { alert('Invalid JSON') }" class="admin-input h-64 font-mono text-[10px]"></textarea>
                                </div>

                                <div x-show="!techy" class="space-y-4">
                                    <label class="admin-label">Section Title (Internal)</label>
                                    <input @click.stop type="text" x-model="title" class="admin-input">

                                    <label class="admin-label">Hero Title (Public)</label>
                                    <input @click.stop type="text" x-model="form.title" class="admin-input">
                                    
                                    <label class="admin-label">Description</label>
                                    <textarea @click.stop x-model="form.description" class="admin-input h-32"></textarea>
                                </div>
                                
                                <label class="admin-label">Source</label>
                                <input @click.stop type="text" x-model="source" class="admin-input">

                                {{-- Popup Editor for Hero --}}
                                <div class="mt-8 pt-8 border-t border-white/10">
                                    <div class="flex items-center justify-between mb-6">
                                        <h4 class="text-xs font-black uppercase tracking-widest text-arbitra-emerald">Hero Popup (Investment Motivation)</h4>
                                        <button @click.stop="if(!form.modal_details) form.modal_details = {}; editingModal = true" x-show="!editingModal" class="text-[10px] font-black uppercase bg-white/5 px-4 py-1.5 rounded-full border border-white/10 hover:bg-arbitra-emerald hover:text-arbitra-black transition-all">Edit Pop-up</button>
                                    </div>

                                    <div x-show="editingModal" class="space-y-6 bg-black/20 p-6 rounded-2xl border border-white/5">
                                        <div class="flex justify-between items-center bg-white/5 -m-6 mb-6 p-4 rounded-t-2xl">
                                            <span class="text-[10px] font-bold text-arbitra-gray uppercase">JSON Content</span>
                                            <button @click.stop="editingModal = false" class="text-[10px] font-black text-arbitra-emerald">HIDE</button>
                                        </div>
                                        <textarea @click.stop x-model="modalJson" 
                                                  @input="try { form.modal_details = JSON.parse($event.target.value) } catch(e) {}"
                                                  class="admin-input h-64 font-mono text-xs"></textarea>
                                    </div>
                                </div>
                                
                                <div class="flex gap-4 mt-auto pt-6">
                                    <button @click.stop="save({{ $hero->id }}, {section_title: title, content: form, source: source}); editing = false" class="bg-arbitra-emerald text-arbitra-black px-6 py-2 rounded-full font-black text-xs">SAVE CHANGES</button>
                                    <button @click.stop="editing = false" class="text-white px-6 py-2 rounded-full font-black text-xs border border-white/20">CANCEL</button>
                                </div>
                            </div>
                        </div>

                        <!-- Highlight Stats -->
                        <div class="flex flex-col gap-6">
                            <template x-for="(stat, index) in form.highlight_stats" :key="index">
                                <div @click="editing = true" class="bento-card flex-1 p-10 flex flex-col justify-between group relative cursor-pointer hover:border-arbitra-emerald/60">
                                    <span class="text-sm font-bold text-arbitra-gray uppercase tracking-widest" x-text="stat.label"></span>
                                    <div class="mt-4">
                                        <h3 class="text-5xl font-black emerald-text tracking-tighter" x-text="stat.value"></h3>
                                        <span class="text-[10px] font-black text-arbitra-gray uppercase tracking-widest mt-2 block opacity-40" x-text="stat.label"></span>
                                    </div>
                                    
                                    <div x-show="editing" x-cloak class="admin-overlay">
                                        <label class="admin-label">Label</label>
                                        <input @click.stop type="text" x-model="stat.label" class="admin-input">
                                        <label class="admin-label mt-4">Value</label>
                                        <input @click.stop type="text" x-model="stat.value" class="admin-input">
                                        <button @click.stop="editing = false" class="bg-arbitra-emerald text-arbitra-black p-2 rounded mt-4 font-black text-[10px] uppercase">DONE</button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                @else
                    <div class="bento-card p-20 border-dashed border-arbitra-emerald/30 flex flex-col items-center justify-center text-center">
                        <h2 class="text-2xl font-black text-white/20 uppercase mb-4">No Hero Section for {{ $selectedYear }}</h2>
                        <button @click="addSection('hero')" class="bg-arbitra-emerald/20 text-arbitra-emerald border border-arbitra-emerald/50 px-8 py-3 rounded-full font-black text-xs hover:bg-arbitra-emerald hover:text-arbitra-black transition-all">CREATE HERO SECTION</button>
                    </div>
                @endif
            </div>

            <!-- Dynamic Sections -->
            @foreach($contents->whereNotIn('type', ['hero'])->sortBy('page_number') as $content)
                <section x-data="{ 
                    editing: false, 
                    techy: false,
                    editingModal: false,
                    form: @js($content->content), 
                    title: @js($content->section_title), 
                    source: @js($content->source),
                    modalJson: JSON.stringify(@js($content->content['modal_details'] ?? null), null, 4),
                    init() {
                        this.$watch('form.modal_details', (val) => {
                            this.modalJson = JSON.stringify(val, null, 4);
                        });
                    }
                }" 
                class="scroll-mt-32 pb-20 group relative">
                    
                    @if($content->type === 'stats_grid')
                        <div @click="editing = true" class="cursor-pointer">
                            <div class="flex items-center gap-4 mb-8">
                                <span class="bg-arbitra-emerald/10 text-arbitra-emerald px-3 py-1 rounded font-black text-[10px] uppercase">STATS GRID</span>
                                <h2 class="text-2xl font-black uppercase tracking-tight" x-text="title"></h2>
                                <button @click.stop="deleteSection({{ $content->id }})" class="opacity-0 group-hover:opacity-100 text-arbitra-gray hover:text-red-500 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                                <span class="text-[10px] font-bold text-arbitra-emerald/50 uppercase ml-auto">Click to edit</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                <template x-for="(stat, index) in form.stats">
                                    <div class="bg-white/5 p-6 rounded-2xl border border-white/10 relative group/item hover:border-arbitra-emerald/40 transition-all">
                                        <span class="text-[10px] font-bold text-arbitra-gray uppercase block" x-text="stat.label"></span>
                                        <h3 class="text-2xl font-black mt-2" x-text="stat.value"></h3>
                                    </div>
                                </template>
                            </div>
                        </div>
                    @elseif($content->type === 'metadata')
                        <div @click="editing = true" class="cursor-pointer bg-arbitra-emerald/5 p-8 rounded-2xl border border-arbitra-emerald/10 hover:border-arbitra-emerald transition-all">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 rounded-2xl bg-arbitra-emerald/20 flex items-center justify-center border border-arbitra-emerald/20">
                                    <svg class="w-8 h-8 text-arbitra-emerald" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-extrabold text-white" x-text="form.site_title"></h4>
                                    <p class="text-sm text-arbitra-gray mt-1 uppercase font-black tracking-widest text-[10px]">Site Configuration / CLICK TO EDIT</p>
                                </div>
                            </div>
                        </div>
                    @elseif($content->type === 'grid')
                        <div @click="editing = true" class="cursor-pointer">
                            <div class="flex items-center gap-4 mb-8">
                                <span class="bg-arbitra-emerald/10 text-arbitra-emerald px-3 py-1 rounded font-black text-[10px] uppercase">INFO GRID</span>
                                <h2 class="text-2xl font-black uppercase tracking-tight" x-text="title"></h2>
                                <button @click.stop="deleteSection({{ $content->id }})" class="opacity-0 group-hover:opacity-100 text-arbitra-gray hover:text-red-500 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <template x-for="(item, index) in form.items">
                                    <div class="bg-white/5 p-6 rounded-2xl border border-white/10 relative group/item hover:border-arbitra-emerald/40">
                                        <h4 class="font-black uppercase mb-2" x-text="item.name"></h4>
                                        <p class="text-xs text-arbitra-gray line-clamp-3" x-text="item.details"></p>
                                    </div>
                                </template>
                            </div>
                        </div>
                    @elseif($content->type === 'marquee')
                        <div @click="editing = true" class="cursor-pointer relative overflow-hidden whitespace-nowrap py-10 border-y border-white/5 hover:bg-white/5 transition-all">
                            <div class="absolute top-2 left-4 px-3 py-1 rounded-full bg-arbitra-emerald/10 text-arbitra-emerald font-black text-[8px] uppercase tracking-widest">PARTNERS MARQUEE / CLICK TO EDIT</div>
                            <div class="flex gap-8 animate-marquee whitespace-nowrap opacity-50">
                                <template x-for="item in form.items">
                                    <span class="text-xl font-black uppercase tracking-widest text-white" x-text="item"></span>
                                </template>
                            </div>
                        </div>
                    @elseif($content->type === 'cta')
                        <div @click="editing = true" class="cursor-pointer bento-card p-12 text-center bg-gradient-to-br from-arbitra-emerald/10 to-transparent border-arbitra-emerald/20 hover:border-arbitra-emerald/60 transition-all">
                            <h3 class="text-4xl font-black uppercase italic mb-6" x-text="form.title"></h3>
                            <p class="text-lg text-arbitra-gray max-w-xl mx-auto mb-8" x-text="form.description"></p>
                            <div class="inline-block bg-arbitra-emerald text-arbitra-black px-8 py-3 rounded-full font-black text-xs uppercase tracking-widest">Connect Feedback Form</div>
                        </div>
                    @elseif($content->type === 'chart')
                        <div @click="editing = true" class="cursor-pointer">
                            <div class="flex items-center gap-4 mb-8">
                                <span class="bg-arbitra-emerald/10 text-arbitra-emerald px-3 py-1 rounded font-black text-[10px] uppercase">DYNAMIC CHART</span>
                                <h2 class="text-2xl font-black uppercase tracking-tight" x-text="title"></h2>
                                <button @click.stop="deleteSection({{ $content->id }})" class="opacity-0 group-hover:opacity-100 text-arbitra-gray hover:text-red-500 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                            <div class="bg-white/5 p-8 rounded-2xl border border-white/10 hover:border-arbitra-emerald/40" 
                                 x-init="
                                    const options = {
                                        series: @json($content->content['series'] ?? []),
                                        chart: { type: '{{ $content->content['chart_type'] ?? 'bar' }}', height: 250, toolbar: {show: false}, background: 'transparent' },
                                        theme: { mode: 'dark' },
                                        xaxis: { categories: @json($content->content['categories'] ?? []), labels: {style: {colors: '#888'}} },
                                        yaxis: { labels: {style: {colors: '#888'}} },
                                        colors: ['#10b981'],
                                        plotOptions: { bar: { borderRadius: 4, distributed: {{ count($content->content['series'] ?? []) <= 1 ? 'true' : 'false' }} } }
                                    };
                                    const chart = new ApexCharts($el.querySelector('.main-chart'), options);
                                    chart.render();
                                 ">
                                <div class="main-chart w-full h-64"></div>
                            </div>
                        </div>
                    @endif

                    <!-- Edit Overlay -->
                    <div x-show="editing" x-cloak class="admin-overlay overflow-y-auto" @click.stop>
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-black uppercase italic text-arbitra-emerald">Editing Section</h3>
                            <button @click="techy = !techy" class="text-[10px] font-black uppercase text-white/40 hover:text-white border border-white/10 px-3 py-1 rounded" x-text="techy ? 'Switch to Easy Mode' : 'Switch to Techy Mode'"></button>
                        </div>
                        
                        <label class="admin-label">Section Title</label>
                        <input type="text" x-model="title" class="admin-input mb-4">
                        
                        <div x-show="techy">
                            <label class="admin-label">Raw JSON Data</label>
                            <textarea x-model="JSON.stringify(form, null, 2)" @change="try { form = JSON.parse($event.target.value) } catch(e) { alert('Invalid JSON') }" class="admin-input h-64 font-mono text-[10px]"></textarea>
                        </div>

                        <div x-show="!techy" class="space-y-6">
                            @if($content->type === 'stats_grid')
                                <div class="space-y-4">
                                    <template x-for="(stat, index) in form.stats" :key="index">
                                        <div class="flex gap-4 items-end bg-white/5 p-4 rounded-xl">
                                            <div class="flex-1">
                                                <label class="admin-label">Label</label>
                                                <input type="text" x-model="stat.label" class="admin-input">
                                            </div>
                                            <div class="flex-1">
                                                <label class="admin-label">Value</label>
                                                <input type="text" x-model="stat.value" class="admin-input">
                                            </div>
                                            <button @click="form.stats.splice(index, 1)" class="p-2 text-red-500 hover:bg-red-500/10 rounded">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </div>
                                    </template>
                                    <button @click="form.stats.push({label: 'New Label', value: '0'})" class="w-full py-2 border-2 border-dashed border-white/10 rounded-xl text-arbitra-gray hover:border-arbitra-emerald hover:text-white transition-all font-bold text-xs uppercase">+ Add New Stat</button>
                                </div>
                            @elseif($content->type === 'grid')
                                <div class="space-y-4">
                                    <template x-for="(item, index) in form.items" :key="index">
                                        <div class="flex gap-4 items-start bg-white/5 p-4 rounded-xl">
                                            <div class="flex-1 space-y-2">
                                                <label class="admin-label">Name</label>
                                                <input type="text" x-model="item.name" class="admin-input">
                                                <label class="admin-label">Details</label>
                                                <textarea x-model="item.details" class="admin-input h-20"></textarea>
                                            </div>
                                            <button @click="form.items.splice(index, 1)" class="p-2 text-red-500 hover:bg-red-500/10 rounded">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </div>
                                    </template>
                                    <button @click="form.items.push({name: 'New Item', details: 'Description...'})" class="w-full py-2 border-2 border-dashed border-white/10 rounded-xl text-arbitra-gray hover:border-arbitra-emerald hover:text-white transition-all font-bold text-xs uppercase">+ Add New Item</button>
                                </div>
                            @elseif($content->type === 'chart')
                                <div class="space-y-6">
                                    <div class="bg-black/40 p-6 rounded-2xl border border-white/5"
                                         x-init="
                                            let chart = null;
                                            $watch('editing', (val) => {
                                                if (val && !chart) {
                                                    setTimeout(() => {
                                                        const options = {
                                                            series: JSON.parse(JSON.stringify(form.series)),
                                                            chart: { type: 'bar', height: 200, animations: {enabled: false}, toolbar: {show: false}, background: 'transparent' },
                                                            theme: { mode: 'dark' },
                                                            xaxis: { categories: JSON.parse(JSON.stringify(form.categories)), labels: {style: {colors: '#888'}} },
                                                            colors: ['#10b981'],
                                                            plotOptions: { bar: { borderRadius: 4 } }
                                                        };
                                                        chart = new ApexCharts($el.querySelector('.preview-chart'), options);
                                                        chart.render();
                                                    }, 200);
                                                }
                                            });
                                            
                                            $watch('form.categories', (val) => { if(chart) chart.updateOptions({ xaxis: { categories: val } }) });
                                            $watch('form.series', (val) => { if(chart) chart.updateSeries(JSON.parse(JSON.stringify(val))) }, { deep: true });
                                         ">
                                        <div class="preview-chart w-full h-48"></div>
                                    </div>
                                    <div class="space-y-4">
                                        <template x-for="(cat, index) in form.categories" :key="index">
                                            <div class="flex gap-4 items-center bg-white/5 p-4 rounded-xl">
                                                <div class="flex-[2]">
                                                    <label class="admin-label">Label</label>
                                                    <input type="text" x-model="form.categories[index]" class="admin-input">
                                                </div>
                                                <div class="flex-1 space-y-4">
                                                    <template x-for="(s, sIndex) in form.series" :key="sIndex">
                                                        <div>
                                                            <label class="admin-label text-[8px]" x-text="s.name"></label>
                                                            <input type="number" step="0.1" x-model.number="s.data[index]" class="admin-input">
                                                        </div>
                                                    </template>
                                                </div>
                                                <button @click="form.categories.splice(index, 1); form.series.forEach(s => s.data.splice(index, 1))" class="p-2 text-red-500 hover:bg-red-500/10 rounded">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </div>
                                        </template>
                                        <button @click="form.categories.push('New Label'); form.series.forEach(s => s.data.push(0))" class="w-full py-2 border-2 border-dashed border-white/10 rounded-xl text-arbitra-gray hover:border-arbitra-emerald hover:text-white transition-all font-bold text-xs uppercase">+ Add Data Point</button>
                                    </div>
                                    
                                    <div class="mt-6 pt-6 border-t border-white/5">
                                        <label class="admin-label">Data Series Names</label>
                                        <div class="grid grid-cols-2 gap-4 mt-2">
                                            <template x-for="(s, sIndex) in form.series" :key="sIndex">
                                                <div class="flex gap-2 items-center bg-white/5 p-2 rounded">
                                                    <input type="text" x-model="s.name" class="admin-input text-[10px] py-1">
                                                    <button @click="form.series.splice(sIndex, 1)" class="text-red-500 p-1">×</button>
                                                </div>
                                            </template>
                                            <button @click="form.series.push({name: 'New Series', data: new Array(form.categories.length).fill(0)})" class="text-[10px] font-bold text-arbitra-emerald uppercase">+ Add Series</button>
                                        </div>
                                    </div>
                                </div>
                            @elseif($content->type === 'marquee')
                                <div class="space-y-4">
                                    <label class="admin-label">Partners / Logos (Marquee)</label>
                                    <template x-for="(item, index) in form.items" :key="index">
                                        <div class="flex gap-4 items-center bg-white/5 p-4 rounded-xl">
                                            <input type="text" x-model="form.items[index]" class="admin-input">
                                            <button @click="form.items.splice(index, 1)" class="p-2 text-red-500 hover:bg-red-500/10 rounded">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </div>
                                    </template>
                                    <button @click="form.items.push('NEW PARTNER')" class="w-full py-2 border-2 border-dashed border-white/10 rounded-xl text-arbitra-gray hover:border-arbitra-emerald hover:text-white transition-all font-bold text-xs uppercase">+ Add Partner</button>
                                </div>
                            @elseif($content->type === 'cta')
                                <div class="space-y-4">
                                    <label class="admin-label">CTA Title</label>
                                    <input type="text" x-model="form.title" class="admin-input">
                                    <label class="admin-label">CTA Description</label>
                                    <textarea x-model="form.description" class="admin-input h-32"></textarea>
                                </div>
                            @elseif($content->type === 'metadata')
                                <div class="space-y-4">
                                    <label class="admin-label">Browser Tab Title</label>
                                    <input type="text" x-model="form.browser_tab_title" class="admin-input">
                                    
                                    <label class="admin-label">Navbar Title</label>
                                    <input type="text" x-model="form.site_title" class="admin-input">
                                    
                                    <label class="admin-label">Logo Subtitle (e.g. DTI Region 6)</label>
                                    <input type="text" x-model="form.logo_text" class="admin-input">
                                </div>
                            @endif

                            {{-- Dynamic Popup (Modal) Editor --}}
                            <div class="mt-8 pt-8 border-t border-white/10">
                                <div class="flex items-center justify-between mb-6">
                                    <h4 class="text-xs font-black uppercase tracking-widest text-arbitra-emerald">Popup Details (Interactive Modal)</h4>
                                    <button @click="if(!form.modal_details) form.modal_details = {}; editingModal = true" x-show="!editingModal" class="text-[10px] font-black uppercase bg-white/5 px-4 py-1.5 rounded-full border border-white/10 hover:bg-arbitra-emerald hover:text-arbitra-black transition-all">Enable/Edit Pop-up</button>
                                </div>

                                <div x-show="editingModal" class="space-y-6 bg-black/20 p-6 rounded-2xl border border-white/5">
                                    <div class="flex justify-between items-center bg-white/5 -m-6 mb-6 p-4 rounded-t-2xl">
                                        <span class="text-[10px] font-bold text-arbitra-gray uppercase">JSON Data Structure</span>
                                        <button @click="editingModal = false" class="text-[10px] font-black text-arbitra-emerald">HIDE EDITOR</button>
                                    </div>
                                    <textarea x-model="modalJson" 
                                              @input="try { form.modal_details = JSON.parse($event.target.value) } catch(e) {}"
                                              class="admin-input h-64 font-mono text-xs" 
                                              placeholder='{"Why Invest?": {"Points": ["Point 1", "Point 2"]}}'></textarea>
                                    <p class="text-[10px] text-arbitra-gray/50 italic">Note: Advanced users only. Editing raw JSON allows full control over maps, lists, and grids in the popups.</p>
                                </div>
                            </div>
                        </div>
                        
                        <label class="admin-label mt-4">Source</label>
                        <input @click.stop type="text" x-model="source" class="admin-input">

                        <div class="flex gap-4 mt-8 pt-6 border-t border-white/5">
                            <button @click.stop="save({{ $content->id }}, {section_title: title, content: form, source: source}); editing = false" class="bg-arbitra-emerald text-arbitra-black px-6 py-2 rounded-full font-black text-xs">SAVE SECTION</button>
                            <div class="flex-1"></div>
                            <button @click.stop="deleteSection({{ $content->id }})" class="text-red-500 px-6 py-2 rounded-full font-black text-xs border border-red-500/20 hover:bg-red-500/10">DELETE SECTION</button>
                            <button @click.stop="editing = false" class="text-white px-6 py-2 rounded-full font-black text-xs border border-white/20">CANCEL</button>
                        </div>
                    </div>
                </section>
            @endforeach

            <!-- Add Section Placeholders -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <button @click="addSection('stats_grid')" class="bento-card p-10 border-dashed border-white/10 flex flex-col items-center justify-center opacity-40 hover:opacity-100 transition-all">
                    <span class="text-3xl mb-2">+</span>
                    <span class="font-black text-[10px] uppercase">Add Stats Grid</span>
                </button>
                <button @click="addSection('grid')" class="bento-card p-10 border-dashed border-white/10 flex flex-col items-center justify-center opacity-40 hover:opacity-100 transition-all">
                    <span class="text-3xl mb-2">+</span>
                    <span class="font-black text-[10px] uppercase">Add Info Grid</span>
                </button>
                <button @click="addSection('chart')" class="bento-card p-10 border-dashed border-white/10 flex flex-col items-center justify-center opacity-40 hover:opacity-100 transition-all">
                    <span class="text-3xl mb-2">+</span>
                    <span class="font-black text-[10px] uppercase">Add Chart</span>
                </button>
                <button @click="addSection('metadata')" class="bento-card p-10 border-dashed border-white/10 flex flex-col items-center justify-center opacity-40 hover:opacity-100 transition-all">
                    <span class="text-3xl mb-2">+</span>
                    <span class="font-black text-[10px] uppercase">Site Settings</span>
                </button>
            </div>

        </div>

        <!-- Inquiries Section -->
        <section id="section-inquiries" class="max-w-[1240px] mx-auto bento-card p-12 mt-16 bg-gradient-to-br from-arbitra-emerald/5 to-transparent border-arbitra-emerald/10">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-black uppercase tracking-tight italic">Investor Inquiries</h2>
                <span class="bg-arbitra-emerald/10 text-arbitra-emerald px-4 py-1.5 rounded-full text-[10px] font-black uppercase">{{ $inquiries->count() }} RECEIVED</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/5">
                            <th class="pb-4 text-[10px] font-black uppercase text-arbitra-gray tracking-widest">Date</th>
                            <th class="pb-4 text-[10px] font-black uppercase text-arbitra-gray tracking-widest">Investor</th>
                            <th class="pb-4 text-[10px] font-black uppercase text-arbitra-gray tracking-widest">Contact</th>
                            <th class="pb-4 text-[10px] font-black uppercase text-arbitra-gray tracking-widest">Message</th>
                            <th class="pb-4 text-[10px] font-black uppercase text-arbitra-gray tracking-widest text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($inquiries as $inquiry)
                            <tr class="group hover:bg-white/[0.02] transition-colors">
                                <td class="py-6 text-xs font-medium text-arbitra-gray">{{ $inquiry->created_at->format('M d, Y') }}</td>
                                <td class="py-6">
                                    <div class="text-sm font-bold text-white">{{ $inquiry->name }}</div>
                                    <div class="text-[10px] text-arbitra-gray">{{ $inquiry->email }}</div>
                                </td>
                                <td class="py-6 text-xs text-arbitra-gray">{{ $inquiry->contact }}</td>
                                <td class="py-6 text-xs text-white max-w-xs truncate" title="{{ $inquiry->message }}">{{ $inquiry->message }}</td>
                                <td class="py-6 text-right">
                                    <button @click="deleteInquiry({{ $inquiry->id }})" class="text-arbitra-gray hover:text-red-500 transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center text-arbitra-gray uppercase text-[10px] font-black tracking-[0.2em] italic">No inquiries received yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <div x-show="showAddYear" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-xl px-6">
        <div class="bg-arbitra-dark p-12 rounded-[2.5rem] border border-white/10 max-w-md w-full">
            <h3 class="text-2xl font-black mb-6 italic uppercase tracking-tighter">Add New Year Profile</h3>
            
            <label class="admin-label">Year Range (e.g., 2030-2031)</label>
            <input type="text" x-model="newYear" class="admin-input mt-2 mb-6">
            
            <div class="flex items-center gap-3 mb-8 bg-white/5 p-4 rounded-2xl border border-white/5">
                <input type="checkbox" x-model="duplicateFromCurrent" id="dupCheck" class="w-4 h-4 accent-arbitra-emerald">
                <label for="dupCheck" class="text-xs font-bold text-white cursor-pointer uppercase tracking-wider">Duplicate from {{ $selectedYear }}</label>
            </div>

            <div class="flex gap-4">
                <button @click="createYear()" class="flex-1 bg-arbitra-emerald text-arbitra-black py-3 rounded-full font-black text-xs">CREATE PROFILE</button>
                <button @click="showAddYear = false" class="flex-1 border border-white/20 py-3 rounded-full font-black text-xs">CANCEL</button>
            </div>
        </div>
    </div>

    <script>
        function adminApp() {
            return {
                showAddYear: false,
                newYear: '',
                duplicateFromCurrent: true,
                selectedYear: @js($selectedYear),
                
                async save(id, data) {
                    try {
                        const response = await fetch(`/admin/content/${id}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(data)
                        });
                        if (response.ok) {
                            alert('Section updated successfully!');
                        }
                    } catch (e) {
                        alert('Error saving data');
                    }
                },

                async deleteSection(id) {
                    if (!confirm('Are you sure you want to delete this section? This cannot be undone.')) return;
                    
                    try {
                        const response = await fetch(`/admin/content/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        if (response.ok) {
                            window.location.reload();
                        }
                    } catch (e) {
                        alert('Error deleting section');
                    }
                },

                async confirmDeleteYear(year) {
                    if (!confirm(`CRITICAL WARNING: This will delete ALL data for the year range ${year}. This action is permanent. Are you sure?`)) return;
                    
                    try {
                        const response = await fetch(`/admin/year/${year}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        if (response.ok) {
                            window.location.href = '/admin';
                        }
                    } catch (e) {
                        alert('Error deleting year');
                    }
                },

                async createYear() {
                    if (!this.newYear) return;
                    
                    if (this.duplicateFromCurrent) {
                        try {
                            const response = await fetch('/admin/year/duplicate', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    source_year: this.selectedYear,
                                    target_year: this.newYear
                                })
                            });
                            if (response.ok) {
                                window.location.href = `?year=${this.newYear}`;
                            } else {
                                const data = await response.json();
                                alert(data.message || 'Error duplicating year');
                            }
                        } catch (e) {
                            alert('Error duplicating year');
                        }
                    } else {
                        // To simplify, we just redirect and let the "empty skeleton" logic handle the first section creation
                        window.location.href = `?year=${this.newYear}`;
                    }
                },

                async addSection(type) {
                    const titles = {
                        hero: 'New Hero Section',
                        stats_grid: 'New Stats Overview',
                        grid: 'New Industry Focus',
                        chart: 'New Performance Chart'
                    };
                    
                    const defaultContent = {
                        hero: { description: 'Edit this description', highlight_stats: [{label: 'Stat 1', value: '100%'}] },
                        stats_grid: { stats: [{label: 'Stat 1', value: 'Value 1'}] },
                        grid: { items: [{name: 'Feature Name', details: 'Detailed description goes here'}] },
                        chart: { chart_type: 'bar', series: [{name: 'Data', data: [10, 20, 30]}], categories: ['A', 'B', 'C'] },
                        marquee: { items: ['FIRM 1', 'FIRM 2', 'FIRM 3'] },
                        cta: { title: 'Ready to Lead?', description: 'Join over 85,000 thriving businesses.' },
                        metadata: { site_title: 'Western Visayas: Investment Profile', browser_tab_title: 'WV Region 6 Profile', logo_text: 'DTI Region 6' }
                    };

                    try {
                        const response = await fetch('/admin/content', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                year_range: this.selectedYear,
                                type: type,
                                section_title: titles[type],
                                content: defaultContent[type],
                                page_number: 100 // High number for new sections
                            })
                        });
                        if (response.ok) {
                            window.location.reload();
                        }
                    } catch (e) {
                        alert('Error creating section');
                    }
                },

                async deleteInquiry(id) {
                    if (!confirm('Delete this inquiry record?')) return;
                    try {
                        const response = await fetch(`/admin/inquiry/${id}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                        });
                        if (response.ok) window.location.reload();
                    } catch (e) { alert('Error deleting inquiry'); }
                }
            }
        }
    </script>
</body>
</html>
