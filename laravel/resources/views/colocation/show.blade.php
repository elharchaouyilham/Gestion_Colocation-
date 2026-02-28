@extends('layout.app')
@section('title', 'COLOC 1')

@section('content')
<div class="space-y-8">
    <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-2xl flex items-center gap-3 text-emerald-600 font-bold text-sm">
        <i class="fas fa-check-circle"></i> Depense ajoutee.
    </div>

    <div class="flex justify-end gap-3">
        <form action="#" method="POST">
            @csrf @method('DELETE')
            <button class="bg-rose-50 text-rose-500 px-6 py-2.5 rounded-xl font-black text-[10px] uppercase border border-rose-100">
                <i class="fas fa-ban mr-1"></i> Annuler la colocation
            </button>
        </form>
        <a href="#" class="bg-slate-900 text-white px-6 py-2.5 rounded-xl font-black text-[10px] uppercase flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-slate-50">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="text-xl font-black italic text-slate-800 uppercase">Dépenses récentes</h3>
                    <button class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-black text-xs uppercase shadow-lg shadow-indigo-100">+ Nouvelle dépense</button>
                </div>
                
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-black uppercase text-slate-300 border-b border-slate-50">
                            <th class="pb-6">TITRE / CATÉGORIE</th>
                            <th class="pb-6 text-center">PAYEUR</th>
                            <th class="pb-6">MONTANT</th>
                            <th class="pb-6 text-right">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-slate-50">
                            <td class="py-6">
                                <p class="font-black text-slate-800 italic">facture wifi</p>
                                <span class="text-[9px] bg-slate-50 text-slate-400 px-2 py-0.5 rounded uppercase font-black">Internet</span>
                            </td>
                            <td class="py-6 text-center">
                                <span class="inline-flex w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full items-center justify-center font-black text-xs">A</span>
                            </td>
                            <td class="py-6 font-black text-xl italic text-slate-900">90,00 €</td>
                            <td class="py-6 text-right">
                                <button class="text-rose-400 hover:text-rose-600"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white rounded-[3rem] p-8 shadow-sm border border-slate-50">
                <h3 class="text-xl font-black italic text-slate-800 uppercase mb-8">Qui doit à qui ?</h3>
                <div class="space-y-4">
                    <div class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase">user 1 <i class="fas fa-arrow-right mx-1 text-indigo-300"></i> admin</p>
                            <p class="text-2xl font-black text-emerald-500 mt-1 italic">30,00 €</p>
                        </div>
                        <button class="bg-white px-4 py-2 rounded-xl text-[9px] font-black uppercase border border-slate-200 shadow-sm">Marquer payé</button>
                    </div>
                </div>
            </div>

            <div class="bg-[#111827] rounded-[3rem] p-8 text-white">
                <h3 class="text-sm font-bold uppercase tracking-tighter mb-6 italic">Membres de la coloc <span class="ml-2 text-[9px] bg-slate-800 px-2 py-0.5 rounded text-slate-400">ACTIFS</span></h3>
                <div class="space-y-4 mb-8">
                    <div class="flex items-center justify-between p-4 bg-slate-800/30 rounded-2xl border border-slate-800">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 bg-slate-800 text-slate-400 rounded-lg flex items-center justify-center text-xs font-black">A</span>
                            <div>
                                <p class="text-xs font-black uppercase">admin</p>
                                <p class="text-[8px] text-amber-500 font-black uppercase tracking-widest italic"><i class="fas fa-crown"></i> OWNER</p>
                            </div>
                        </div>
                        <span class="text-xs font-black text-emerald-500 italic">0</span>
                    </div>
                </div>
                <button class="w-full bg-slate-800 hover:bg-slate-700 py-4 rounded-2xl text-[9px] font-black uppercase tracking-widest flex items-center justify-center gap-2 transition">
                    <i class="fas fa-user-plus"></i> Inviter un membre
                </button>
            </div>
        </div>
    </div>
</div>
@endsection