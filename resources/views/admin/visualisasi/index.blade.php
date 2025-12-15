<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisis Aktivitas - Admin CAKRA</title>
    
    {{-- CSS & Plugins --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <style>
        /* --- 1. CONFIG GLOBAL (SAMA PERSIS DASHBOARD) --- */
        :root {
            --primary: #073763;
            --accent: #741847;
            --bg-dark: #0A192F;
            --text-dark: #E0E6F1;
            --subtext-dark: #94A3B8;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        body {
            background-color: var(--bg-dark);
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden; /* Hilangkan scroll horizontal */
            /* Background Gradient yang sama persis */
            background-image: radial-gradient(circle at 20% 80%, rgba(116, 24, 71, 0.15) 0%, transparent 50%),
                              radial-gradient(circle at 80% 20%, rgba(7, 55, 99, 0.15) 0%, transparent 50%);
        }

        .font-orbitron { font-family: 'Orbitron', sans-serif; }

        /* --- 2. SIDEBAR (KOPI DARI KELOLA USER) --- */
        .sidebar {
            width: 250px;
            background: rgba(7, 55, 99, 0.1);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(116, 24, 71, 0.2);
            padding: 20px 0;
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            overflow-y: auto; overflow-x: hidden;
            z-index: 50; /* Z-Index aman */
        }
        
        .logo { padding: 0 20px 20px; border-bottom: 1px solid rgba(116, 24, 71, 0.2); margin-bottom: 20px; }
        .logo h1 {
            font-size: 1.5rem; font-weight: 700;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        
        .nav-item {
            padding: 12px 20px; display: flex; align-items: center; color: var(--subtext-dark);
            text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; cursor: pointer;
        }
        .nav-item:hover, .nav-item.active {
            background: linear-gradient(90deg, rgba(7, 55, 99, 0.2), rgba(116, 24, 71, 0.1));
            color: var(--text-dark); border-left: 3px solid var(--accent); transform: translateX(5px);
        }
        .nav-item .material-icons { margin-right: 10px; font-size: 20px; transition: all 0.3s ease; }
        .nav-item:hover .material-icons { color: var(--accent); transform: scale(1.1); }

        /* --- 3. MAIN CONTENT (PADDING & WIDTH DIPERBAIKI) --- */
        .main-content { 
            margin-left: 250px; /* Geser konten agar tidak ketutupan sidebar */
            padding: 40px;      /* Padding lebih lega */
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        /* --- 4. HEADER TITLE STYLE --- */
        .page-header {
            display: flex; justify-content: space-between; align-items: flex-start; 
            margin-bottom: 30px; flex-wrap: wrap; gap: 20px;
        }
        .page-title { font-size: 1.8rem; font-weight: 600; color: white; display: flex; align-items: center; gap: 12px; }
        .page-subtitle { color: var(--subtext-dark); font-size: 0.9rem; margin-top: 5px; margin-left: 44px; }
        
        /* Icon Bulat di Judul */
        .title-icon {
            width: 32px; height: 32px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; color: white; border: 1px solid var(--accent);
        }

        /* --- 5. CARD & WIDGET STYLE (Clean Version) --- */
        .glass-card {
            background: rgba(7, 55, 99, 0.15); /* Lebih transparan agar menyatu */
            backdrop-filter: blur(12px);
            border: 1px solid rgba(116, 24, 71, 0.2); 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px; 
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .glass-card:hover { 
            border-color: var(--accent); 
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Input Date Modern */
        .input-date {
            background: rgba(10, 25, 47, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.2);
            color: #E0E6F1;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            outline: none;
            transition: 0.3s;
        }
        .input-date:focus { border-color: var(--accent); }

        /* Scrollbar Halus */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(7, 55, 99, 0.5); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent); }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo">
            <h1>CAKRA ADMIN</h1>
        </div>
        
        <a href="{{ route('admin.dashboard') }}" class="nav-item">
            <span class="material-icons">dashboard</span>
            <span class="nav-text">Dashboard</span>
        </a>
        <a href="{{ route('admin.users.index') }}" class="nav-item">
            <span class="material-icons">people</span>
            <span class="nav-text">Kelola User</span>
        </a>
        <a href="{{ route('admin.visualisasi') }}" class="nav-item active">
            <span class="material-icons">insights</span>
            <span class="nav-text">Visualisasi Data</span>
        </a>
        <a href="{{ route('logout') }}" class="nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="material-icons">logout</span>
            <span class="nav-text">Keluar</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>

    <div class="main-content">
        
        <div class="page-header">
            <div>
                <h1 class="page-title">
                    <div class="title-icon"><span class="material-icons" style="font-size:18px">bar_chart</span></div>
                    Analisis Aktivitas
                </h1>
                <p class="page-subtitle">Monitoring kinerja screening & revisi</p>
            </div>

            <form action="{{ route('admin.visualisasi') }}" method="GET" class="flex items-center gap-3 bg-[#073763]/20 px-4 py-2 rounded-xl border border-[#741847]/30">
                <div class="flex flex-col">
                    <label class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Dari</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" class="input-date h-8">
                </div>
                <span class="text-slate-500 mt-4">-</span>
                <div class="flex flex-col">
                    <label class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Sampai</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="input-date h-8">
                </div>
                <button type="submit" class="mt-4 bg-[#741847] hover:bg-[#9d2262] text-white w-10 h-9 rounded-lg flex items-center justify-center transition shadow-lg">
                    <i class="bi bi-funnel-fill text-xs"></i>
                </button>
            </form>
        </div>

        <div class="space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="glass-card p-5 relative group">
                    <div class="flex justify-between items-start mb-3">
                        <div class="p-2 bg-yellow-500/20 rounded-lg"><i class="bi bi-trophy text-yellow-400 text-xl"></i></div>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-yellow-500/20 text-yellow-300 border border-yellow-500/30">MVP</span>
                    </div>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Top Performer</p>
                    <h3 class="text-xl font-bold text-white truncate">{{ $mvp->user->name ?? '-' }}</h3>
                    <div class="mt-2 text-xs text-green-400 flex items-center gap-1"><i class="bi bi-caret-up-fill"></i> {{ $mvp->total ?? 0 }} Aktivitas</div>
                </div>

                <div class="glass-card p-5 relative group">
                    <div class="flex justify-between items-start mb-3">
                        <div class="p-2 bg-red-500/20 rounded-lg"><i class="bi bi-exclamation-triangle text-red-400 text-xl"></i></div>
                    </div>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Total Revisi</p>
                    <h3 class="text-2xl font-bold text-white">{{ $totalRevisi }}</h3>
                    <div class="mt-2 text-xs text-slate-500">Dalam periode ini</div>
                </div>

                <div class="glass-card p-5 relative group">
                    <div class="flex justify-between items-start mb-3">
                        <div class="p-2 bg-blue-500/20 rounded-lg"><i class="bi bi-activity text-blue-400 text-xl"></i></div>
                    </div>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Total Aktivitas</p>
                    <h3 class="text-2xl font-bold text-white">{{ $totalAktivitas }}</h3>
                    <div class="mt-2 text-xs text-slate-500">Log tercatat</div>
                </div>

                <div class="glass-card p-5 relative group">
                    <div class="flex justify-between items-start mb-3">
                        <div class="p-2 bg-green-500/20 rounded-lg"><i class="bi bi-hdd-network text-green-400 text-xl"></i></div>
                    </div>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Status Sistem</p>
                    <h3 class="text-2xl font-bold text-white">Online</h3>
                    <div class="mt-2 text-xs text-green-400">Database Connected</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="glass-card p-6 lg:col-span-1 flex flex-col">
                    <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider mb-4 border-l-2 border-[#741847] pl-3">Leaderboard Petugas</h3>
                    <div class="space-y-3 flex-1 overflow-y-auto custom-scrollbar pr-1 h-60">
                        @foreach($leaderboard as $index => $lb)
                        <div class="p-3 rounded-lg flex items-center gap-3 bg-white/5 hover:bg-white/10 transition cursor-pointer border-l-2 {{ $index == 0 ? 'border-yellow-400' : 'border-transparent' }}">
                            <div class="font-bold {{ $index == 0 ? 'text-yellow-400' : 'text-slate-500' }} text-lg w-6">0{{ $index + 1 }}</div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-white truncate">{{ $lb->user->name }}</h4>
                                <p class="text-xs text-slate-400">{{ $lb->total }} Aktivitas</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="glass-card p-6 lg:col-span-2">
                    <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider mb-4 border-l-2 border-[#741847] pl-3">Trend Aktivitas</h3>
                    <div class="relative h-60 w-full">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="glass-card p-6">
                <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider mb-4 border-l-2 border-[#741847] pl-3">Detail Kinerja & Efisiensi</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-500 text-xs uppercase tracking-wider border-b border-white/5">
                                <th class="pb-3 pl-2 font-semibold">Petugas</th>
                                <th class="pb-3 font-semibold">Total Aksi</th>
                                <th class="pb-3 font-semibold">Jml. Revisi</th>
                                <th class="pb-3 font-semibold">Rasio</th>
                                <th class="pb-3 text-center font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-slate-300">
                            @foreach($kinerjaPetugas as $petugas)
                            <tr class="hover:bg-white/5 transition border-b border-white/5 last:border-0">
                                <td class="py-3 pl-2 font-medium text-white">{{ $petugas->name }}</td>
                                <td class="py-3">{{ $petugas->total_screening }}</td>
                                <td class="py-3 text-red-300">{{ $petugas->jumlah_revisi }}</td>
                                <td class="py-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 bg-slate-700 rounded-full h-1.5">
                                            <div class="{{ $petugas->rasio_revisi < 15 ? 'bg-green-500' : ($petugas->rasio_revisi < 30 ? 'bg-yellow-500' : 'bg-[#741847]') }} h-1.5 rounded-full" style="width: {{ min($petugas->rasio_revisi, 100) }}%"></div>
                                        </div>
                                        <span class="text-[10px] text-slate-400">{{ $petugas->rasio_revisi }}%</span>
                                    </div>
                                </td>
                                <td class="py-3 text-center">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide 
                                        {{ $petugas->label == 'Excellent' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 
                                          ($petugas->label == 'Good' ? 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20') }}">
                                        {{ $petugas->label }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div> 
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Chart.defaults.font.family = 'Poppins';
            Chart.defaults.color = '#94A3B8';
            
            const ctx = document.getElementById('activityChart').getContext('2d');
            const labels = {!! json_encode($chartLabels) !!};
            const dataTotal = {!! json_encode($chartValues) !!};

            let gradientScreening = ctx.createLinearGradient(0, 0, 0, 300);
            gradientScreening.addColorStop(0, 'rgba(7, 55, 99, 0.5)');
            gradientScreening.addColorStop(1, 'rgba(7, 55, 99, 0.05)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Aktivitas',
                        data: dataTotal,
                        borderColor: '#4da8da',
                        backgroundColor: gradientScreening,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.3,
                        pointRadius: 3,
                        pointBackgroundColor: '#073763',
                        pointBorderColor: '#4da8da'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { grid: { color: 'rgba(255, 255, 255, 0.03)' }, beginAtZero: true },
                        x: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
</body>
</html>