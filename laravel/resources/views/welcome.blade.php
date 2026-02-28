<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc - Simplifiez votre vie en colocation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,700;0,800;1,800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F9FD] text-slate-900">

    <nav class="flex items-center justify-between px-12 py-8">
        <div class="text-indigo-600 font-black text-2xl italic tracking-tighter uppercase">
            <i class="fas fa-home-alt"></i> EasyColoc
        </div>
        <div class="space-x-8 flex items-center">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition">Connexion</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-xl shadow-indigo-100 hover:scale-105 transition">Créer un compte</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-12 py-20 flex flex-col lg:flex-row items-center gap-16">
        <div class="lg:w-1/2 space-y-8">
            <span class="bg-indigo-50 text-indigo-600 px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest italic">🚀 L'app n°1 pour les colocs</span>
            <h1 class="text-7xl font-black italic text-slate-900 leading-[0.9] tracking-tighter">
                GÉREZ VOS <br> <span class="text-indigo-600">DÉPENSES</span> <br> SANS STRESS.
            </h1>
            <p class="text-slate-500 font-medium leading-relaxed max-w-md">
                Fini les calculs interminables et les oublis. EasyColoc s'occupe de répartir les factures pour vous.
            </p>
            <div class="flex items-center gap-6">
                <a href="{{ route('register') }}" class="bg-slate-900 text-white px-10 py-5 rounded-[1.8rem] font-black text-xs uppercase tracking-[0.2em] shadow-2xl hover:bg-indigo-600 transition-all">
                    Commencer l'aventure
                </a>
            </div>
        </div>

        <div class="lg:w-1/2 relative">
            <div class="bg-white p-8 rounded-[3.5rem] shadow-2xl border border-slate-50 relative z-10">
                <div class="flex justify-between items-center mb-10 border-b border-slate-50 pb-6">
                    <h3 class="text-sm font-black italic text-slate-800 uppercase tracking-widest">Dépenses récentes</h3>
                    <div class="w-8 h-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center text-xs italic font-black">A</div>
                </div>
                <div class="space-y-6">
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm text-indigo-400">
                                <i class="fas fa-wifi text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase italic">Facture Internet</p>
                                <p class="text-[8px] text-slate-400 font-bold uppercase">Payé par Admin</p>
                            </div>
                        </div>
                        <p class="font-black text-lg italic">90,00 €</p>
                    </div>
                </div>
            </div>
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-600/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-600/10 rounded-full blur-3xl"></div>
        </div>
    </main>

    <section class="bg-white py-24 border-t border-slate-50">
        <div class="max-w-7xl mx-auto px-12 grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="space-y-4">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                    <i class="fas fa-users-viewfinder"></i>
                </div>
                <h4 class="text-sm font-black uppercase italic tracking-widest">Gestion de Tribu</h4>
                <p class="text-xs text-slate-400 font-medium leading-relaxed">Créez votre colocation et invitez vos amis en un clic.</p>
            </div>
            <div class="space-y-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <h4 class="text-sm font-black uppercase italic tracking-widest">Équilibre Automatique</h4>
                <p class="text-xs text-slate-400 font-medium leading-relaxed">L'app calcule automatiquement qui doit combien à qui. Plus de disputes !</p>
            </div>
            <div class="space-y-4">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                    <i class="fas fa-star"></i>
                </div>
                <h4 class="text-sm font-black uppercase italic tracking-widest">Score Réputation</h4>
                <p class="text-xs text-slate-400 font-medium leading-relaxed">Gagnez des points en étant le meilleur colocataire.</p>
            </div>
        </div>
    </section>

</body>
</html>