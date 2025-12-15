<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Analisis Pengajuan - Staf Fakultas</title>
    
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
               class="flex items-center gap-4 px-6 py-4 text-white bg-gradient-to-r from-[#073763]/20 to-[#741847]/10 border-l-4 border-[#741847] shadow-lg relative">
                <span class="material-symbols-outlined text-[22px]">analytics</span>
                <span class="text-sm font-medium">Analisis Pengajuan</span>
                <div class="absolute inset-y-0 left-0 w-1 bg-[#741847] shadow-[0_0_10px_#741847]"></div>
            </a>

            <a href="{{ route('staf_fakultas.analisis_dana') }}" 
               class="flex items-center gap-4 px-6 py-4 text-gray-400 hover:text-white hover:bg-gradient-to-r hover:from-[#073763]/20 hover:to-[#741847]/10 transition-all border-l-4 border-transparent hover:border-[#741847] group">
                <span class="material-symbols-outlined text-[22px] group-hover:scale-110 transition-transform">account_balance_wallet</span>
                <span class="text-sm font-medium">Analisis Dana Fakultas</span>
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
            
            <div class="flex flex-col lg:flex-row flex-wrap justify-between items-center gap-6 pb-2 border-b border-white/5 pb-6">
                
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-4xl text-gradient">calendar_view_week</span>
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <h1 class="text-white text-3xl md:text-4xl font-black font-display">
                            Analisis <span class="text-gradient">Pengajuan</span>
                        </h1>

                        <form method="GET" action="{{ route('staf_fakultas.analisis_pengajuan') }}">
                            <input type="hidden" name="termin" value="{{ $semesterPilih }}">
                            
                            <div class="relative group">
                                <select name="tahun" onchange="this.form.submit()" 
                                        class="appearance-none bg-[#050C18] text-[#dbb2ff] border border-[rgba(116,24,71,0.4)] hover:border-[#f78ae0] rounded-lg py-1 pl-3 pr-8 font-display font-bold text-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#741847] transition-all shadow-[0_0_10px_rgba(7,55,100,0.3)]">
                                    @foreach($availableYears as $y)
                                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }} class="bg-[#0A192F] text-white font-body">
                                            {{ $y }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-[#dbb2ff] group-hover:text-white transition-colors">
                                    <span class="material-symbols-outlined text-xl">expand_more</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 flex-wrap">
                    <div class="flex gap-1 p-1 bg-[#050C18] border border-white/10 rounded-xl shadow-inner">
                        <a href="{{ route('staf_fakultas.analisis_pengajuan', ['termin' => 1, 'tahun' => $tahun]) }}" 
                           class="h-10 flex items-center justify-center rounded-lg px-6 text-sm font-semibold transition-all duration-300 {{ $semesterPilih == 1 ? 'bg-primary text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                           Termin 1 <span class="hidden sm:inline text-xs font-normal ml-1 opacity-70">(Feb-Jun)</span>
                        </a>
                        <a href="{{ route('staf_fakultas.analisis_pengajuan', ['termin' => 2, 'tahun' => $tahun]) }}" 
                           class="h-10 flex items-center justify-center rounded-lg px-6 text-sm font-semibold transition-all duration-300 {{ $semesterPilih == 2 ? 'bg-primary text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                           Termin 2 <span class="hidden sm:inline text-xs font-normal ml-1 opacity-70">(Jul-Nov)</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                <div class="glass-card flex flex-col gap-4 p-6 rounded-xl hover:bg-white/[0.02] transition-colors group">
                    <div class="flex items-start justify-between">
                        <div class="w-12 h-12 rounded-lg bg-primary/30 border border-primary/50 flex items-center justify-center text-blue-300 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-2xl">summarize</span>
                        </div>
                        <span class="stat-badge">Termin {{ $semesterPilih }}</span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm font-medium">Total Dana Diajukan</p>
                        <p class="text-white tracking-tight text-2xl font-bold font-display mt-1">
                            Rp {{ number_format($totalDanaTermin, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="glass-card flex flex-col gap-4 p-6 rounded-xl hover:bg-white/[0.02] transition-colors group">
                    <div class="flex items-start justify-between">
                        <div class="w-12 h-12 rounded-lg bg-purple-900/30 border border-purple-500/50 flex items-center justify-center text-purple-300 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-2xl">account_balance</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm font-medium">Rata-rata / Ormawa</p>
                        <p class="text-white tracking-tight text-2xl font-bold font-display mt-1">
                            Rp {{ number_format($avgDanaPerOrmawa, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="glass-card flex flex-col gap-4 p-6 rounded-xl hover:bg-white/[0.02] transition-colors group">
                    <div class="flex items-start justify-between">
                        <div class="w-12 h-12 rounded-lg bg-yellow-900/30 border border-yellow-500/50 flex items-center justify-center text-yellow-300 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-2xl">emoji_events</span>
                        </div>
                        <span class="stat-badge bg-yellow-600 border border-yellow-400/30 text-yellow-100">#1 TOP</span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm font-medium mb-1">Paling Aktif</p>
                        @if($ormawaTeraktif)
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-primary to-accent flex items-center justify-center text-white font-bold text-xs shadow-md">
                                {{ substr($ormawaTeraktif->ormawa->nama_ormawa ?? '?', 0, 1) }}
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-white font-bold font-display truncate w-full text-lg leading-tight">
                                    {{ $ormawaTeraktif->ormawa->nama_ormawa ?? '-' }}
                                </p>
                                <p class="text-gray-500 text-xs">{{ $ormawaTeraktif->total_pengajuan }} Pengajuan</p>
                            </div>
                        </div>
                        @else
                        <p class="text-gray-500 italic text-sm">Belum ada data</p>
                        @endif
                    </div>
                </div>

                <div class="glass-card flex flex-col gap-4 p-6 rounded-xl hover:bg-white/[0.02] transition-colors group">
                    <div class="flex items-start justify-between">
                        <div class="w-12 h-12 rounded-lg bg-green-900/30 border border-green-500/50 flex items-center justify-center text-green-300 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-2xl">group</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm font-medium">Partisipasi Mhs</p>
                        <div class="flex items-baseline gap-2 mt-1">
                            <p class="text-white tracking-tight text-2xl font-bold font-display">
                                {{ number_format($avgPengajuanUser, 1) }}x
                            </p>
                            <span class="text-gray-500 text-xs">/ mahasiswa</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                
                <div class="lg:col-span-3 glass-card flex flex-col gap-4 p-6 rounded-xl">
                    <div class="flex items-center justify-between border-b border-white/5 pb-4">
                        <div>
                            <p class="text-white text-lg font-medium font-display">Top Pengajuan Dana</p>
                            <p class="text-gray-400 text-xs">Termin {{ $semesterPilih }}</p>
                        </div>
                        <span class="material-symbols-outlined text-gray-500">bar_chart</span>
                    </div>
                    
                    <div class="flex items-end justify-between h-[240px] px-2 pt-6 pb-2 gap-4">
                        @php $maxDana = $chartDanaOrmawa->max('total_dana'); @endphp

                        @forelse($chartDanaOrmawa as $data)
                            @php 
                                $height = $maxDana > 0 ? ($data->total_dana / $maxDana) * 100 : 0;
                                $height = max($height, 10); // Min height 10% agar bar terlihat
                            @endphp
                            <div class="flex flex-col items-center justify-end w-full group h-full relative">
                                <div class="absolute bottom-[calc(100%+8px)] opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 bg-[#050C18] text-white text-xs p-2 rounded-lg whitespace-nowrap z-20 border border-white/20 shadow-xl pointer-events-none">
                                    <span class="font-bold text-blue-300">Rp {{ number_format($data->total_dana) }}</span>
                                    <br><span class="text-[10px] text-gray-400">{{ $data->ormawa->nama_ormawa }}</span>
                                </div>
                                
                                <div class="w-full max-w-[40px] bg-gradient-to-t from-blue-600 to-purple-600 rounded-t-md hover:brightness-125 transition-all duration-500 relative overflow-hidden shadow-[0_0_15px_rgba(59,130,246,0.4)]" 
                                     style="height: {{ $height }}%;">
                                     <div class="absolute top-0 left-0 w-full h-1 bg-white/30"></div>
                                </div>
                                
                                <p class="text-gray-400 text-[10px] md:text-xs font-bold mt-3 truncate w-full text-center group-hover:text-white transition-colors">
                                    {{ explode(' ', $data->ormawa->nama_ormawa)[0] }}
                                </p>
                            </div>
                        @empty
                            <div class="w-full flex flex-col items-center justify-center text-gray-500 h-full gap-2">
                                <span class="material-symbols-outlined text-3xl opacity-50">data_loss_prevention</span>
                                <span>Tidak ada data pengajuan</span>
                            </div>
                        @endforelse
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
                    
                    <div class="flex-1 flex flex-row items-center justify-center gap-6 mt-2">
                        <div class="relative w-40 h-40 shrink-0 rounded-full shadow-[0_0_20px_rgba(0,0,0,0.5)] border-4 border-[#0A192F]"
                             style="background: conic-gradient(
                                @foreach($pieChartData as $data)
                                    {{ $data['color'] }} {{ $data['start'] }}% {{ $data['end'] }}%{{ !$loop->last ? ',' : '' }}
                                @endforeach
                             );">
                            <div class="absolute inset-0 m-auto w-24 h-24 bg-[#0A192F] rounded-full flex flex-col items-center justify-center z-10">
                                <span class="text-[10px] text-gray-400 uppercase tracking-widest">Total</span>
                                <span class="text-white font-bold text-xs">Rp {{ number_format($totalDanaTermin / 1000000, 1) }}M</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 w-full overflow-y-auto max-h-[200px] pr-1 custom-scrollbar">
                            @forelse($pieChartData as $data)
                                <div class="flex items-center justify-between p-2 rounded-lg bg-white/[0.02] border border-white/5 hover:bg-white/5 transition-colors group">
                                    <div class="flex items-center gap-2 overflow-hidden">
                                        <div class="w-3 h-3 rounded-full shrink-0 shadow-[0_0_5px_currentColor]" style="background-color: {{ $data['color'] }}; color: {{ $data['color'] }}"></div>
                                        <div class="flex flex-col overflow-hidden">
                                            <p class="text-gray-300 text-xs font-bold truncate group-hover:text-white transition-colors">
                                                {{ $data['label'] }}
                                            </p>
                                            <p class="text-[10px] text-gray-500">Rp {{ number_format($data['value'], 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <span class="text-white font-bold text-xs bg-white/10 px-1.5 py-0.5 rounded ml-2">
                                        {{ $data['percent'] }}%
                                    </span>
                                </div>
                            @empty
                                <div class="text-center text-gray-500 text-xs py-4">Belum ada data.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card flex flex-col gap-4 p-6 rounded-xl mb-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-white text-lg font-medium font-display">Ranking Aktivitas ORMAWA</h3>
                        <p class="text-gray-400 text-xs mt-1">Data diurutkan berdasarkan jumlah proposal</p>
                    </div>
                </div>
                <div class="overflow-x-auto rounded-lg border border-white/5">
                    <table class="w-full text-left">
                        <thead class="bg-[#050C18] text-xs uppercase text-gray-400">
                            <tr>
                                <th class="p-4 font-semibold tracking-wider">Rank</th>
                                <th class="p-4 font-semibold tracking-wider">Nama ORMAWA</th>
                                <th class="p-4 font-semibold tracking-wider text-center">Jml Pengajuan</th>
                                <th class="p-4 font-semibold tracking-wider text-right">Total Dana</th>
                                <th class="p-4 font-semibold tracking-wider text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-white/5">
                            @forelse($rankingOrmawa as $index => $row)
                            <tr class="hover:bg-white/[0.02] transition-colors group">
                                <td class="p-4">
                                    @if($index == 0)
                                        <div class="w-6 h-6 rounded-full bg-yellow-500 text-black flex items-center justify-center font-bold text-xs shadow-lg shadow-yellow-500/20">1</div>
                                    @elseif($index == 1)
                                        <div class="w-6 h-6 rounded-full bg-gray-300 text-black flex items-center justify-center font-bold text-xs shadow-lg shadow-white/10">2</div>
                                    @elseif($index == 2)
                                        <div class="w-6 h-6 rounded-full bg-orange-600 text-white flex items-center justify-center font-bold text-xs shadow-lg shadow-orange-500/20">3</div>
                                    @else
                                        <span class="text-gray-500 ml-2 font-bold">{{ $index + 1 }}</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <span class="font-medium text-white group-hover:text-blue-300 transition-colors">{{ $row->ormawa->nama_ormawa }}</span>
                                </td>
                                <td class="p-4 text-center">
                                    <span class="px-3 py-1 bg-white/5 rounded-full font-bold text-gray-300">{{ $row->jumlah_pengajuan }}</span>
                                </td>
                                <td class="p-4 text-right font-mono text-green-400 tracking-tight">
                                    Rp {{ number_format($row->total_dana, 0, ',', '.') }}
                                </td>
                                <td class="p-4 text-center">
                                    @if($row->jumlah_pengajuan >= 5)
                                        <span class="px-2 py-1 text-[10px] rounded-full bg-green-500/10 text-green-400 border border-green-500/20">Sangat Aktif</span>
                                    @elseif($row->jumlah_pengajuan >= 3)
                                        <span class="px-2 py-1 text-[10px] rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 text-[10px] rounded-full bg-gray-500/10 text-gray-400 border border-gray-500/20">Normal</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500 flex flex-col items-center">
                                    <span class="material-symbols-outlined text-4xl mb-2 opacity-30">inbox</span>
                                    <span>Belum ada data untuk termin ini.</span>
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