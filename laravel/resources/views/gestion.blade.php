<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>EasyColoc</title>
</head>
<body class="bg-gradient-to-br from-slate-100 via-indigo-50 to-blue-100 font-sans text-slate-800">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-white/70 backdrop-blur-xl border-r border-white/40 hidden lg:flex flex-col sticky top-0 h-screen shadow-xl">
        
        <!-- Logo -->
        <div class="p-8">
            <div class="flex items-center gap-3 text-indigo-600 font-extrabold text-2xl tracking-tight">
                <i class="fas fa-house text-indigo-500"></i>
                <span class="bg-gradient-to-r from-indigo-600 to-blue-500 bg-clip-text text-transparent">
                    EasyColoc
                </span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-6 space-y-3 mt-6">

            <a href="/dashboard" class="flex items-center gap-4 p-4 text-white bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl font-semibold shadow-md hover:scale-[1.03] transition-all duration-300">
                <i class="fas fa-th-large text-lg"></i> Dashboard
            </a>

            <a href="/colocations" class="flex items-center gap-4 p-4 text-slate-500 hover:bg-indigo-50 hover:text-indigo-600 rounded-2xl font-semibold transition-all duration-300">
                <i class="fas fa-users text-lg"></i> Colocations
            </a>

            <a href="/admin" class="flex items-center gap-4 p-4 text-slate-500 hover:bg-indigo-50 hover:text-indigo-600 rounded-2xl font-semibold transition-all duration-300">
                <i class="fas fa-user-shield text-lg"></i> Admin
            </a>

            <a href="/profile" class="flex items-center gap-4 p-4 text-slate-500 hover:bg-indigo-50 hover:text-indigo-600 rounded-2xl font-semibold transition-all duration-300">
                <i class="fas fa-user text-lg"></i> Profile
            </a>
        </nav>

        <!-- Reputation Card -->
        <div class="p-6">
            <div class="bg-gradient-to-br from-indigo-600 to-blue-500 rounded-3xl p-6 text-white shadow-lg">
                <p class="text-xs uppercase tracking-widest opacity-70 font-semibold">Votre réputation</p>
                <p class="text-2xl font-bold mt-1">+0 points</p>

                <div class="w-full bg-white/30 h-2 rounded-full mt-4 overflow-hidden">
                    <div class="bg-white h-full w-1/2 rounded-full"></div>
                </div>
            </div>
        </div>

    </aside>

    <!-- MAIN -->
    <main class="flex-1">

        <!-- HEADER -->
        <header class="h-20 bg-white/60 backdrop-blur-xl border-b border-white/40 flex items-center justify-between px-10 sticky top-0 z-40 shadow-sm">

            <h2 class="text-sm font-bold uppercase tracking-widest text-slate-500">
                @yield('title', 'Tableau de bord')
            </h2>

            <div class="flex items-center gap-6">

                @yield('header_actions')

                <div class="flex items-center gap-4 pl-6 border-l border-slate-200">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-slate-800">ADMIN</p>
                        <p class="text-xs text-emerald-500 font-medium">● En ligne</p>
                    </div>

                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-blue-500 text-white rounded-2xl flex items-center justify-center font-bold shadow-md">
                        A
                    </div>
                </div>

            </div>
        </header>

        <!-- CONTENT -->
        <div class="p-10">
            @yield('content')
        </div>

    </main>

</div>

</body>
</html>