<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc - Simplifiez votre colocation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F8F9FD] text-slate-900">

    {{-- Navigation: Aligned with Dashboard Header --}}
    <nav class="bg-white border-b border-slate-100 py-6">
        <div class="max-w-7xl mx-auto px-10 flex items-center justify-between">
            <div class="text-indigo-600 font-black text-2xl italic tracking-tighter uppercase">
                EasyColoc<span class="text-slate-300">.</span>
            </div>

            <div class="flex items-center gap-8">
                @auth
                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}"
                    class="text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-[11px] font-black uppercase tracking-widest text-rose-500 hover:text-rose-700 transition">
                        Déconnexion
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                    class="bg-indigo-600 text-white px-8 py-3 rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-lg shadow-indigo-100 transition">
                    Commencer
                </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero Section: Professional Split --}}
    <main class="max-w-7xl mx-auto px-10 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

            {{-- Left Side: Text --}}
            <div class="lg:col-span-6 space-y-8">
                <div class="inline-flex items-center gap-2 bg-indigo-50 text-indigo-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest">
                    <i class="fas fa-rocket"></i> Plateforme de gestion
                </div>
                <h1 class="text-6xl font-black text-slate-800 leading-[1.1] tracking-tight">
                    Gérez vos <span class="text-indigo-600">dépenses</span> partagées en toute clarté.
                </h1>
                <p class="text-slate-500 text-lg font-medium leading-relaxed max-w-lg">
                    La solution structurée pour les colocations modernes. Suivez les factures, gérez les remboursements et maintenez l'équilibre financier de votre maison.
                </p>
                <div class="flex items-center gap-4 pt-4">
                    <a href="{{ route('register') }}" class="bg-slate-900 text-white px-10 py-5 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] shadow-xl hover:bg-indigo-600 transition-all">
                        Créer une colocation
                    </a>
                </div>
            </div>

            {{-- Right Side: Clean UI Preview (Matches Expense UI) --}}
            <div class="lg:col-span-6">
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100">
                    <div class="flex justify-between items-center mb-10 border-b border-slate-50 pb-6">
                        <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Aperçu des dépenses</h3>
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[9px] font-black rounded-full uppercase">En direct</span>
                    </div>

                    <div class="space-y-4">
                        {{-- Mock Expense 1 --}}
                        <div class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-transparent hover:border-slate-100 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm text-indigo-500">
                                    <i class="fas fa-plug text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-[11px] font-black text-slate-800 uppercase tracking-tight">Facture Électricité</p>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">Payé par Admin • Cuisine</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-slate-800 tracking-tight">120.00 DH</p>
                            </div>
                        </div>

                        {{-- Mock Expense 2 --}}
                        <div class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-transparent hover:border-slate-100 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm text-amber-500">
                                    <i class="fas fa-shopping-basket text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-[11px] font-black text-slate-800 uppercase tracking-tight">Courses Communes</p>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">Payé par Sarah • Alimentation</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-slate-800 tracking-tight">345.50 DH</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Stats/Features Section --}}
    <section class="border-t border-slate-100 bg-white py-20">
        <div class="max-w-7xl mx-auto px-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="p-8 rounded-[2rem] bg-slate-50 border border-slate-100">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-indigo-600 mb-6">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest mb-3">Sécurité & Rôles</h4>
                    <p class="text-[11px] text-slate-500 font-medium leading-relaxed uppercase tracking-tight">Gestion stricte par propriétaire. Seul l'admin contrôle les catégories et les membres.</p>
                </div>

                <div class="p-8 rounded-[2rem] bg-slate-50 border border-slate-100">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-emerald-600 mb-6">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest mb-3">Calcul Automatique</h4>
                    <p class="text-[11px] text-slate-500 font-medium leading-relaxed uppercase tracking-tight">Oubliez Excel. Notre système calcule les soldes en temps réel après chaque dépense.</p>
                </div>

                <div class="p-8 rounded-[2rem] bg-slate-50 border border-slate-100">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-amber-600 mb-6">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest mb-3">Suivi Simplifié</h4>
                    <p class="text-[11px] text-slate-500 font-medium leading-relaxed uppercase tracking-tight">Visualisez l'historique complet de vos colocations et gardez une trace de chaque centime.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer Simple --}}
    <footer class="py-10 text-center border-t border-slate-100">
        <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">© 2024 EasyColoc System. All Rights Reserved.</p>
    </footer>

</body>

</html>