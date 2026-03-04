<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EasyColoc')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#F8F9FD]">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white border-r border-slate-100 flex flex-col fixed h-full shadow-sm">
            <div class="p-8 text-indigo-600 font-black text-2xl italic tracking-tighter">
                EasyColoc<span class="text-slate-300">.</span>
            </div>

            <nav class="flex-1 px-6 space-y-3">
                {{-- User Dashboard --}}
                <a href="{{ route('user.dashboard') }}"
                    class="flex items-center gap-3 p-4 rounded-2xl font-bold text-[11px] uppercase tracking-widest transition-all 
                   {{ request()->routeIs('user.dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-slate-400 hover:bg-slate-50' }}">
                    <i class="fas fa-th-large text-sm"></i> Dashboard
                </a>

                {{-- User Expenses --}}
                <a href="{{ route('user.expenses.index') }}"
                    class="flex items-center gap-3 p-4 rounded-2xl font-bold text-[11px] uppercase tracking-widest transition-all 
                   {{ request()->routeIs('user.expenses.index') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-slate-400 hover:bg-slate-50' }}">
                    <i class="fas fa-wallet text-sm"></i> Expenses
                </a>

                <div class="pt-6 pb-2">
                    <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.2em] px-4">System</p>
                </div>

                {{-- Admin Panel: Only shows if user has role_id 1 --}}
                @auth
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 p-4 rounded-2xl font-bold text-[11px] uppercase tracking-widest text-rose-500 hover:bg-rose-50 transition-all {{ request()->routeIs('admin.*') ? 'bg-rose-50' : '' }}">
                    <i class="fas fa-user-shield text-sm"></i> Admin Panel
                </a>
                @endif
                @endauth

                <a href="{{ url('/') }}"
                    class="flex items-center gap-3 p-4 rounded-2xl font-bold text-[11px] uppercase tracking-widest text-slate-400 hover:bg-slate-50 transition-all">
                    <i class="fas fa-arrow-left text-sm"></i> Back Home
                </a>
            </nav>

            {{-- Logout Section --}}
            <div class="p-6 border-t border-slate-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 p-3 text-slate-400 hover:text-red-500 font-bold text-[10px] uppercase transition-colors">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 ml-64 min-h-screen">
            <div class="p-10">
                {{-- Flash Messages for Success/Error --}}
                @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-50 text-emerald-600 rounded-2xl border border-emerald-100 text-xs font-bold uppercase tracking-wider">
                    {{ session('success') }}
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>