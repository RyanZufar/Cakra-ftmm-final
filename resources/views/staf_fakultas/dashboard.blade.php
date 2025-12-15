<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Staf Fakultas - CAKRA</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
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
               class="flex items-center gap-4 px-6 py-4 text-white bg-gradient-to-r from-[#073763]/20 to-[#741847]/10 border-l-4 border-[#741847] shadow-lg relative">
                <span class="material-symbols-outlined text-[22px]">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
                <div class="absolute inset-y-0 left-0 w-1 bg-[#741847] shadow-[0_0_10px_#741847]"></div>
            </a>

            <a href="{{ route('staf_fakultas.analisis_pengajuan') }}" 
               class="flex items-center gap-4 px-6 py-4 text-gray-400 hover:text-white hover:bg-gradient-to-r hover:from-[#073763]/20 hover:to-[#741847]/10 transition-all border-l-4 border-transparent hover:border-[#741847] group">
                <span class="material-symbols-outlined text-[22px] group-hover:scale-110 transition-transform">analytics</span>
                <span class="text-sm font-medium">Analisis Pengajuan</span>
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
            
            <div class="flex flex-col border-b border-white/5 pb-6">
                <h1 class="text-3xl md:text-4xl font-black font-display text-white">
                    Dashboard <span class="text-gradient">Verifikasi</span>
                </h1>
                <p class="text-gray-400 text-sm font-normal mt-2">
                    Selamat datang kembali, <span class="text-blue-300 font-semibold">{{ $user->name }}</span>! Berikut adalah antrian tugas Anda hari ini.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="glass-card p-6 rounded-xl flex items-center gap-4 hover:bg-white/[0.02] transition-colors">
                    <div class="w-12 h-12 rounded-lg bg-orange-500/10 flex items-center justify-center text-orange-400 border border-orange-500/20">
                        <span class="material-symbols-outlined text-2xl">pending_actions</span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wider">Antrian Verifikasi</p>
                        <p class="text-2xl font-bold text-white font-display">{{ $stats['menunggu_verifikasi'] }}</p>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-xl flex items-center gap-4 hover:bg-white/[0.02] transition-colors">
                    <div class="w-12 h-12 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 border border-blue-500/20">
                        <span class="material-symbols-outlined text-2xl">groups</span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wider">Total Ormawa</p>
                        <p class="text-2xl font-bold text-white font-display">{{ $stats['total_ormawa'] }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <div class="glass-card flex flex-col rounded-xl overflow-hidden h-full">
                    <div class="p-6 border-b border-white/10 bg-[#050C18]/50 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-yellow-400">description</span>
                            <h3 class="text-white font-bold font-display text-lg">Verifikasi RAB</h3>
                        </div>
                        <span class="text-xs bg-yellow-500/10 text-yellow-300 px-2 py-1 rounded border border-yellow-500/20">
                            {{ $antrianRab->count() }} Pending
                        </span>
                    </div>
                    
                    <div class="p-0 overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-[#050C18] text-xs uppercase text-gray-500">
                                <tr>
                                    <th class="p-4 font-medium">Judul Kegiatan</th>
                                    <th class="p-4 font-medium text-center">Waktu</th>
                                    <th class="p-4 font-medium text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 text-sm">
                                @forelse ($antrianRab as $pengajuan)
                                <tr class="hover:bg-white/[0.02] transition-colors group">
                                    <td class="p-4">
                                        <div class="font-semibold text-white group-hover:text-yellow-300 transition-colors line-clamp-1">
                                            {{ $pengajuan->judul_kegiatan }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $pengajuan->ormawa->nama_ormawa ?? 'Individu' }}
                                        </div>
                                    </td>
                                    <td class="p-4 text-center text-gray-400 whitespace-nowrap text-xs">
                                        {{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->diffForHumans() }}
                                    </td>
                                    <td class="p-4 text-right">
                                        <a href="{{ route('staf_fakultas.verifikasi.rab', $pengajuan->pengajuan_id) }}" 
                                           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-yellow-500/10 text-yellow-400 hover:bg-yellow-500 hover:text-black transition-all text-xs font-bold border border-yellow-500/30">
                                            <span>Proses</span>
                                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="p-8 text-center text-gray-500 flex flex-col items-center">
                                        <span class="material-symbols-outlined text-4xl mb-2 opacity-30">check_circle</span>
                                        <span>Tidak ada antrian RAB saat ini.</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="glass-card flex flex-col rounded-xl overflow-hidden h-full">
                    <div class="p-6 border-b border-white/10 bg-[#050C18]/50 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-green-400">task_alt</span>
                            <h3 class="text-white font-bold font-display text-lg">Verifikasi LPJ</h3>
                        </div>
                        <span class="text-xs bg-green-500/10 text-green-300 px-2 py-1 rounded border border-green-500/20">
                            {{ $antrianLpj->count() }} Pending
                        </span>
                    </div>
                    
                    <div class="p-0 overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-[#050C18] text-xs uppercase text-gray-500">
                                <tr>
                                    <th class="p-4 font-medium">Judul Kegiatan</th>
                                    <th class="p-4 font-medium text-center">Waktu</th>
                                    <th class="p-4 font-medium text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 text-sm">
                                @forelse ($antrianLpj as $pengajuan)
                                <tr class="hover:bg-white/[0.02] transition-colors group">
                                    <td class="p-4">
                                        <div class="font-semibold text-white group-hover:text-green-300 transition-colors line-clamp-1">
                                            {{ $pengajuan->judul_kegiatan }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $pengajuan->ormawa->nama_ormawa ?? 'Individu' }}
                                        </div>
                                    </td>
                                    <td class="p-4 text-center text-gray-400 whitespace-nowrap text-xs">
                                        {{ \Carbon\Carbon::parse($pengajuan->lpj->tanggal_lapor)->diffForHumans() }}
                                    </td>
                                    <td class="p-4 text-right">
                                        <a href="{{ route('staf_fakultas.verifikasi.lpj.show', $pengajuan->lpj->lpj_id) }}" 
                                           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-green-500/10 text-green-400 hover:bg-green-500 hover:text-black transition-all text-xs font-bold border border-green-500/30">
                                            <span>Proses</span>
                                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="p-8 text-center text-gray-500 flex flex-col items-center">
                                        <span class="material-symbols-outlined text-4xl mb-2 opacity-30">check_circle</span>
                                        <span>Tidak ada antrian LPJ saat ini.</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            
        </div>
    </main>
</div>
</body>
</html>