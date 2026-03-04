@extends('layout.app')
@section('title', 'GESTION DES DÉPENSES')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-50 mb-8">
        <h3 class="text-lg font-black uppercase text-slate-800 mb-6">Équilibre de la Coloc</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($balances as $bal)
            <div class="p-4 rounded-2xl {{ $bal['balance'] >= 0 ? 'bg-emerald-50' : 'bg-red-50' }}">
                <p class="text-[10px] font-black uppercase text-slate-400 mb-1">{{ $bal['name'] }}</p>
                <p class="text-lg font-black {{ $bal['balance'] >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                    {{ $bal['balance'] >= 0 ? '+' : '' }}{{ number_format($bal['balance'], 2) }} €
                </p>
                <p class="text-[9px] text-slate-500">Total payé: {{ number_format($bal['paid'], 2) }} €</p>
            </div>
            @endforeach
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-indigo-600 p-8 rounded-[2.5rem] text-white shadow-xl shadow-indigo-100">
            <p class="text-indigo-100 text-xs uppercase font-black tracking-widest mb-2">Dépenses Totales</p>
            <h2 class="text-4xl font-black">{{ number_format($totalSpent, 2) }} €</h2>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <p class="text-slate-400 text-xs uppercase font-black tracking-widest mb-2">Part par personne</p>
            @php
            $memberCount = $membership->colocation->memberships()->whereNull('left_at')->count();
            $share = $memberCount > 0 ? $totalSpent / $memberCount : 0;
            @endphp
            <h2 class="text-4xl font-black text-slate-800">{{ number_format($share, 2) }} €</h2>
        </div>

        <div class="bg-emerald-500 p-8 rounded-[2.5rem] text-white shadow-xl shadow-emerald-100">
            <p class="text-emerald-100 text-xs uppercase font-black tracking-widest mb-2">Membres Actifs</p>
            <h2 class="text-4xl font-black">{{ $memberCount }}</h2>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <div class="lg:col-span-4">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-50 sticky top-8">
                <h3 class="text-lg font-black uppercase text-slate-800 mb-6">Nouvelle Dépense</h3>

                <form action="{{ route('user.expenses.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Title</label>
                        <input type="text" name="title" required placeholder="Ex: Courses Lidl"
                            class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-200 transition">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Montant (DH)</label>
                        <input type="number" step="0.01" name="amount" required placeholder="0.00"
                            class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-200 transition">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Catégorie</label>
                        <select name="categorie_id" required
                            class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-200 transition">
                            <option value="" disabled selected>Choisir...</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Date</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}" required
                            class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-200 transition">
                    </div>

                    <button type="submit" class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-black py-4 rounded-2xl text-xs uppercase tracking-widest transition-all transform hover:scale-[1.02]">
                        Ajouter la dépense
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-8">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-50">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-lg font-black uppercase text-slate-800">Historique des achats</h3>
                    <span class="bg-slate-100 text-slate-500 text-[10px] font-black px-3 py-1 rounded-full uppercase">
                        {{ $expenses->count() }} transactions
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-slate-400 text-[10px] uppercase tracking-widest border-b border-slate-50">
                                <th class="pb-4 text-left font-black">Date</th>
                                <th class="pb-4 text-left font-black">Détails</th>
                                <th class="pb-4 text-left font-black">Payeur</th>
                                <th class="pb-4 text-left font-black">Montant</th>
                                <th class="pb-4 text-right font-black"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($expenses as $expense)
                            <tr class="group hover:bg-slate-50/50 transition">
                                <td class="py-5">
                                    <span class="text-xs font-bold text-slate-400">
                                        {{ \Carbon\Carbon::parse($expense->date)->format('d M') }}
                                    </span>
                                </td>
                                <td class="py-5">
                                    <p class="text-sm font-black text-slate-800 mb-1">{{ $expense->title }}</p>
                                    <span class="bg-indigo-50 text-indigo-500 text-[9px] font-black px-2 py-0.5 rounded uppercase">
                                        {{ $expense->category->name }}
                                    </span>
                                </td>
                                <td class="py-5">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-black text-slate-500">
                                            {{ substr($expense->payer->name, 0, 1) }}
                                        </div>
                                        <span class="text-xs font-bold text-slate-600">{{ $expense->payer->name }}</span>
                                    </div>
                                </td>
                                <td class="py-5">
                                    <span class="text-sm font-black text-slate-800">{{ number_format($expense->amount, 2) }} €</span>
                                </td>
                                <td class="py-5 text-right">
                                    @if($expense->payer_id === Auth::id() || $membership->role === 'owner')
                                    <form action="{{ route('user.expenses.destroy', $expense->id) }}" method="POST"
                                        onsubmit="return confirm('Supprimer cette dépense ?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-slate-300 hover:text-red-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <p class="text-slate-400 text-sm italic font-medium">Aucune dépense enregistrée pour le moment.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection