<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Analisis Dana Fakultas - CAKRA</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#073763",
                        "accent": "#741847",
                        "background-dark": "#0A192F",
                    },
                    fontFamily: {
                        "display": ["Orbitron", "sans-serif"],
                        "body": ["Poppins", "sans-serif"]
                    },
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        
        .glass-card {
            background-color: rgba(7, 55, 99, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid;
            border-image-source: linear-gradient(to bottom right, rgba(116, 24, 71, 0.5), rgba(7, 55, 99, 0.1));
            border-image-slice: 1;
        }
        .glow-border:hover {
            box-shadow: 0 0 15px rgba(116, 24, 71, 0.4);
            transform: scale(1.01);
            transition: all 0.3s ease-in-out;
        }
        
        .text-gradient {
            background-image: linear-gradient(to right, #4299e1, #c026d3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }

        .stat-badge {
            background: linear-gradient(135deg, #073763, #741847);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #0A192F;
        }

        ::-webkit-scrollbar-thumb {
            background: #1e3a8a;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #741847;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 2px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
    </style>
</head>
<body class="bg-background-dark text-gray-200 font-body">

<div class="flex min-h-screen w-full">
    
    <aside class="w-64 flex-shrink-0 bg-[#0A192F]/95 backdrop-blur-sm border-r border-[#741847]/20 flex flex-col fixed h-screen z-50 transition-all duration-300">
        
        <div class="h-20 flex items-center px-6 border-b border-[#741847]/20 mb-4">
            <h1 class="text-2xl font-bold font-body tracking-wider bg-gradient-to-r from-[#073763] to-[#741847] bg-clip-text text-transparent">
                CAKRA
            </h1>
        </div>

        <nav class="flex flex-col flex-1 px-0 gap-1 overflow-y-auto">
            
            <a href="{{ route('staf_fakultas.dashboard') }}" 
               class="flex items-center gap-4 px-6 py-4 text-gray-400 hover:text-white hover:bg-gradient-to-r hover:from-[#073763]/20 hover:to-[#741847]/10 transition-all border-l-4 border-transparent hover:border-[#741847] group">
                <span class="material-symbols-outlined text-[22px] group-hover:scale-110 transition-transform">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>

            <a href="{{ route('staf_fakultas.analisis_pengajuan') }}" 
               class="flex items-center gap-4 px-6 py-4 text-gray-400 hover:text-white hover:bg-gradient-to-r hover:from-[#073763]/20 hover:to-[#741847]/10 transition-all border-l-4 border-transparent hover:border-[#741847] group">
                <span class="material-symbols-outlined text-[22px] group-hover:scale-110 transition-transform">analytics</span>
                <span class="text-sm font-medium">Analisis Pengajuan</span>
            </a>

            <a href="{{ route('staf_fakultas.analisis_dana') }}" 
               class="flex items-center gap-4 px-6 py-4 text-white bg-gradient-to-r from-[#073763]/20 to-[#741847]/10 border-l-4 border-[#741847] shadow-lg relative">
                <span class="material-symbols-outlined text-[22px]">account_balance_wallet</span>
                <span class="text-sm font-medium">Analisis Dana Fakultas</span>
                <div class="absolute inset-y-0 left-0 w-1 bg-[#741847] shadow-[0_0_10px_#741847]"></div>
            </a>
            
            <div class="mt-8 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                Akun
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center gap-4 px-6 py-4 text-gray-400 hover:text-red-400 hover:bg-red-900/10 transition-all border-l-4 border-transparent hover:border-red-500 group text-left">
                    <span class="material-symbols-outlined text-[22px] group-hover:rotate-180 transition-transform duration-500">logout</span>
                    <span class="text-sm font-medium">Keluar</span>
                </button>
            </form>

        </nav>

        <div class="p-4 border-t border-[#741847]/20 bg-[#050C18]">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#073763] to-[#741847] flex items-center justify-center text-white font-bold border border-white/10 shadow-md">
                    {{ substr(Auth::user()->name ?? 'SF', 0, 1) }}
                </div>
                <div class="flex flex-col overflow-hidden">
                    <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name ?? 'Staf Fakultas' }}</p>
                    <p class="text-xs text-gray-500 truncate">Staf Fakultas</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8 overflow-x-hidden min-h-screen bg-cover bg-fixed" 
          style="background-image: radial-gradient(circle at 80% 20%, rgba(7, 55, 99, 0.15) 0%, transparent 50%), radial-gradient(circle at 20% 80%, rgba(116, 24, 71, 0.15) 0%, transparent 50%);">
        
        <div class="flex flex-col gap-8 max-w-7xl mx-auto">
            
            <form id="filterForm" method="GET" class="border-b border-white/5 pb-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <h1 class="text-3xl md:text-4xl font-black font-display text-white">
                            Analisis <span class="text-gradient">Dana</span>
                        </h1>
                        
                        <div class="relative group">
                            <select name="tahun" onchange="this.form.submit()" 
                                    class="appearance-none bg-[#050C18] text-[#dbb2ff] border border-[rgba(116,24,71,0.4)] hover:border-[#f78ae0] rounded-lg py-2 pl-4 pr-10 font-display font-bold text-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#741847] transition-all shadow-[0_0_10px_rgba(7,55,100,0.3)]">
                                @foreach($availableYears as $y)
                                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }} class="bg-[#0A192F] text-white font-body">
                                        {{ $y }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-[#dbb2ff] group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex h-12 items-center rounded-xl bg-[#050C18] border border-white/10 p-1 shadow-inner overflow-x-auto max-w-full">
                        
                        <label class="cursor-pointer h-full px-4 sm:px-6 flex items-center justify-center rounded-lg whitespace-nowrap {{ $inputTermin == 'Termin1' ? 'bg-primary text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition-all text-sm font-semibold">
                            Termin 1 <span class="hidden sm:inline text-xs font-normal ml-1 opacity-70">(Feb-Jun)</span>
                            <input class="hidden" name="termin" type="radio" value="Termin1" onchange="this.form.submit()" {{ $inputTermin == 'Termin1' ? 'checked' : '' }}/>
                        </label>

                        <label class="cursor-pointer h-full px-4 sm:px-6 flex items-center justify-center rounded-lg whitespace-nowrap {{ $inputTermin == 'Termin2' ? 'bg-primary text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition-all text-sm font-semibold">
                            Termin 2 <span class="hidden sm:inline text-xs font-normal ml-1 opacity-70">(Juli-Nov)</span>
                            <input class="hidden" name="termin" type="radio" value="Termin2" onchange="this.form.submit()" {{ $inputTermin == 'Termin2' ? 'checked' : '' }}/>
                        </label>

                        <label class="cursor-pointer h-full px-4 sm:px-6 flex items-center justify-center rounded-lg whitespace-nowrap {{ $inputTermin == 'Annual' ? 'bg-primary text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition-all text-sm font-semibold">
                            Tahunan
                            <input class="hidden" name="termin" type="radio" value="Annual" onchange="this.form.submit()" {{ $inputTermin == 'Annual' ? 'checked' : '' }}/>
                        </label>

                    </div>
                </div>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="glass-card p-6 rounded-xl flex flex-col gap-2 hover:bg-white/[0.02] transition-colors glow-border">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3 text-base font-medium text-gray-400">
                            <span class="material-symbols-outlined text-accent">paid</span>
                            <span>Pengeluaran</span>
                        </div>
                        
                        <span class="stat-badge whitespace-nowrap">{{ $badgeTermin }}</span>
                    
                    </div>
                    <p class="text-white tracking-tight text-2xl font-bold font-display mt-2 truncate" title="Rp {{ number_format($totalDicairkan, 0, ',', '.') }}">
                        Rp {{ number_format($totalDicairkan, 0, ',', '.') }}
                    </p>
                    <div class="flex flex-col gap-1 mt-2">
                        <p class="text-gray-400 text-xs font-medium">
                            vs Prev: <span class="{{ $growth >= 0 ? 'text-green-400' : 'text-red-400' }} font-bold">{{ number_format($growth, 0) }}%</span>
                        </p>
                        <p class="flex items-center gap-1 {{ $growth >= 0 ? 'text-green-400' : 'text-red-400' }} text-sm font-medium">
                            <span class="material-symbols-outlined text-sm">{{ $growth >= 0 ? 'trending_up' : 'trending_down' }}</span>
                            Rp {{ number_format(abs($diffAmount), 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-xl flex flex-col gap-2 hover:bg-white/[0.02] transition-colors glow-border">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3 text-base font-medium text-gray-400">
                            <span class="material-symbols-outlined text-accent">emoji_events</span>
                            <span>Top User</span>
                        </div>
                        <span class="stat-badge bg-yellow-600/20 text-yellow-300 border border-yellow-500/30">#1 Rank</span>
                    </div>
                    @if($topSpender)
                    <div class="flex items-center gap-3 mt-2">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary to-accent flex items-center justify-center text-white font-bold shrink-0 shadow-lg">
                            {{ substr($topSpender->ormawa->nama_ormawa, 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-white tracking-tight text-xl font-bold font-display truncate">{{ $topSpender->ormawa->nama_ormawa }}</p>
                            <p class="text-gray-400 text-sm truncate">Rp {{ number_format($topSpender->total, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2 text-xs">
                        <span class="text-gray-400">{{ number_format($topSpenderShare, 0) }}% dari total</span>
                        <span class="text-yellow-400 font-medium">{{ $topSpender->kegiatan }} kegiatan</span>
                    </div>
                    @else
                    <p class="text-gray-500 mt-4 text-sm italic">Belum ada data</p>
                    @endif
                </div>

                <div class="glass-card p-6 rounded-xl flex flex-col gap-2 hover:bg-white/[0.02] transition-colors glow-border">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3 text-base font-medium text-gray-400">
                            <span class="material-symbols-outlined text-accent">compare_arrows</span>
                            <span>Antar Termin</span>
                        </div>
                        <span class="stat-badge">Comp</span>
                    </div>
                    <p class="text-white tracking-tight text-3xl font-bold font-display mt-2">
                         {{ $growth > 0 ? '+' : '' }}{{ number_format($growth, 0) }}%
                    </p>
                    <div class="flex flex-col gap-1 mt-2 text-xs text-gray-400">
                        <div class="flex justify-between">
                            <span>T1: Rp {{ number_format($barData['Termin 1'], 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>T2: Rp {{ number_format($barData['Termin 2'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-1 text-green-400 text-xs font-medium mt-2">
                        <span class="material-symbols-outlined text-sm">trending_up</span>
                        <span>Puncak: {{ $puncak }}</span>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-xl flex flex-col gap-2 hover:bg-white/[0.02] transition-colors glow-border">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3 text-base font-medium text-gray-400">
                            <span class="material-symbols-outlined text-accent">donut_small</span>
                            <span class="truncate">{{ $labelCard4 }}</span>
                        </div>
                    </div>
                    <p class="text-white tracking-tight text-2xl font-bold font-display mt-2 truncate" title="Rp {{ number_format($totalDicairkan, 0, ',', '.') }}">
                        Rp {{ number_format($totalDicairkan, 0, ',', '.') }}
                    </p>
                    <div class="flex items-center justify-between mt-2">
                        <p class="text-gray-400 text-sm">{{ $subLabelCard4 }}</p>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                <div class="lg:col-span-3 glass-card flex flex-col gap-4 p-6 rounded-xl relative overflow-hidden">
                    <div class="flex items-center justify-between z-10">
                        <div>
                            <p class="text-white text-lg font-medium font-display">Perbandingan Termin {{ $tahun }}</p>
                            <p class="text-xs text-gray-400">Total visualisasi data per termin</p>
                        </div>
                        <span class="material-symbols-outlined text-accent">bar_chart</span>
                    </div>
                    
                    <div class="relative flex items-end justify-center gap-16 h-[240px] w-full px-4 pb-8 mt-4 border-b border-white/10">
                        
                        <div class="absolute inset-0 flex flex-col justify-between pointer-events-none pb-8">
                            <div class="w-full h-px bg-white/5 border-t border-dashed border-white/10"></div>
                            <div class="w-full h-px bg-white/5 border-t border-dashed border-white/10"></div>
                            <div class="w-full h-px bg-white/5 border-t border-dashed border-white/10"></div>
                            <div class="w-full h-px bg-white/5 border-t border-dashed border-white/10"></div>
                        </div>

                        @foreach($barData as $label => $val)
                        <div class="relative flex flex-col items-center justify-end h-full group w-24"> 
                            <div class="mb-2 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 absolute bottom-full z-20">
                                <div class="bg-[#050C18] text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-xl border border-white/20 whitespace-nowrap">
                                    Rp {{ number_format($val, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="w-full rounded-t-lg shadow-[0_0_15px_rgba(116,24,71,0.3)] transition-all duration-500 ease-out relative overflow-hidden group-hover:shadow-[0_0_25px_rgba(116,24,71,0.5)] cursor-pointer" 
                                 style="height: {{ $maxBar > 0 ? ($val / $maxBar) * 100 : 0 }}%; background: linear-gradient(180deg, #741847 0%, #073763 100%);">
                                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="absolute -bottom-8 flex flex-col items-center w-32">
                                <span class="text-gray-300 text-sm font-semibold">{{ $label }}</span>
                                <span class="text-[10px] text-gray-500 font-mono">Rp {{ number_format($val, 0, ',', '.') }}</span> 
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-2 glass-card flex flex-col gap-4 p-6 rounded-xl">
                    <div class="flex items-center justify-between border-b border-white/5 pb-4">
                        <div>
                            <p class="text-white text-lg font-medium font-display">Persentase Pengeluaran</p>
                            <p class="text-gray-400 text-xs">Market Share Dana per ORMAWA</p>
                        </div>
                        <span class="material-symbols-outlined text-gray-500">pie_chart</span>
                    </div>
                    
                    <div class="flex flex-row items-center justify-center gap-4 mt-2 h-full">
                        
                        <div class="relative w-32 h-32 shrink-0 rounded-full shadow-[0_0_20px_rgba(0,0,0,0.5)] border-4 border-[#0A192F]"
                             style="background: conic-gradient(
                                @php $start = 0; $colors = ['#3b82f6', '#a855f7', '#ec4899', '#eab308']; @endphp
                                @foreach($chartComparison->take(4) as $idx => $d)
                                    @php 
                                        $pct = $totalDisetujui > 0 ? ($d->rab / $totalDisetujui) * 100 : 0;
                                        $end = $start + $pct;
                                        $color = $colors[$idx] ?? '#6b7280';
                                    @endphp
                                    {{ $color }} {{ $start }}% {{ $end }}%{{ !$loop->last ? ',' : '' }}
                                    @php $start = $end; @endphp
                                @endforeach
                             );">
                            <div class="absolute inset-0 m-auto w-20 h-20 bg-[#0A192F] rounded-full flex flex-col items-center justify-center z-10 shadow-inner">
                                <span class="text-[8px] text-gray-400 uppercase tracking-widest font-semibold">TOTAL</span>
                                <span class="text-white font-bold text-[10px]">Rp {{ number_format($totalDisetujui / 1000000, 1) }}M</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 w-full overflow-y-auto max-h-[200px] pr-1 custom-scrollbar">
                            @foreach($chartComparison->take(4) as $idx => $d)
                                @php 
                                    $color = $colors[$idx] ?? '#6b7280';
                                    $pct = $totalDisetujui > 0 ? ($d->rab / $totalDisetujui) * 100 : 0;
                                @endphp
                                <div class="flex items-center justify-between p-2 rounded-lg bg-white/[0.03] border border-white/5 hover:bg-white/5 transition-colors group">
                                    <div class="flex items-center gap-2 overflow-hidden">
                                        <div class="w-2 h-2 rounded-full shrink-0 shadow-[0_0_5px_currentColor]" style="background-color: {{ $color }}; color: {{ $color }}"></div>
                                        <div class="flex flex-col overflow-hidden">
                                            <p class="text-gray-300 text-[10px] font-bold truncate group-hover:text-white transition-colors uppercase">
                                                {{ $d->ormawa->nama_ormawa }}
                                            </p>
                                            <p class="text-[9px] text-gray-500 font-mono">Rp {{ number_format($d->rab, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <span class="text-white font-bold text-[10px] bg-white/10 px-1.5 py-0.5 rounded ml-1 min-w-[35px] text-center">
                                        {{ number_format($pct, 1) }}%
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card flex flex-col gap-4 p-6 rounded-xl mb-10">
                <div class="flex items-center justify-between">
                    <h3 class="text-white text-lg font-medium font-display">Ranking Penggunaan Dana ORMAWA</h3>
                    <span class="material-symbols-outlined text-accent">leaderboard</span>
                </div>
                <div class="overflow-x-auto rounded-lg border border-white/5">
                    <table class="w-full text-left text-sm text-gray-400">
                        <thead class="bg-[#050C18] border-b border-[rgba(116,24,71,0.3)] uppercase text-xs">
                            <tr>
                                <th class="py-4 px-6 font-semibold tracking-wider">Rank</th>
                                <th class="py-4 px-6 font-semibold tracking-wider">ORMAWA</th>
                                <th class="py-4 px-6 font-semibold tracking-wider">Dana Disetujui</th>
                                <th class="py-4 px-6 font-semibold tracking-wider text-center">Kegiatan</th>
                                <th class="py-4 px-6 font-semibold tracking-wider text-center">Item (RAB/LPJ)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[rgba(116,24,71,0.2)]">
                            @forelse($tableData as $index => $row)
                            <tr class="hover:bg-[rgba(7,55,100,0.4)] transition-colors duration-200">
                                <td class="py-4 px-6">
                                    <div class="w-8 h-8 rounded-full bg-yellow-500/20 flex items-center justify-center text-yellow-300 font-bold text-xs shadow-lg shadow-yellow-500/10">
                                        {{ $index + 1 }}
                                    </div>
                                </td>
                                <td class="py-4 px-6 font-semibold text-white">
                                    {{ $row->ormawa->nama_ormawa }}
                                </td>
                                <td class="py-4 px-6 text-green-400 font-bold font-mono tracking-tight">Rp {{ number_format($row->total_rab, 0, ',', '.') }}</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="px-3 py-1 bg-white/5 rounded-full text-xs font-bold text-gray-300">{{ $row->jumlah_kegiatan }}</span>
                                </td>
                                <td class="py-4 px-6 text-center text-sm font-mono text-gray-300">
                                    {{ $row->total_item_rab }} / {{ $row->total_item_lpj }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500 flex flex-col items-center gap-2">
                                    <span class="material-symbols-outlined text-4xl opacity-30">inbox</span>
                                    <span>Data tidak tersedia untuk filter ini.</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</div>
</body>
</html>