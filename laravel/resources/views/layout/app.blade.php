<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#F8F9FD]">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-slate-100 flex flex-col fixed h-full">
            <div class="p-6 text-indigo-600 font-black text-xl italic italic">EasyColoc</div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="/dashboard" class="flex items-center gap-3 p-3 bg-indigo-50 text-indigo-600 rounded-2xl font-black text-[10px] uppercase italic">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
            </nav>
        </aside>

        <main class="flex-1 ml-64 p-10">
            @yield('content') {{-- C'est ici que votre code Dashboard va s'afficher --}}
        </main>
    </div>
</body>
</html>