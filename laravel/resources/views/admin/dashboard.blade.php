@extends('layout.app')
@section('title', 'GLOBAL SUPERVISION')

@section('content')
<div class="space-y-10">

    {{-- ================= STATISTICS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-8 rounded-[2rem] border border-slate-50 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Users</p>
            <p class="text-4xl font-black text-slate-900 mb-2">{{ $totalUsers }}</p>
            <span class="text-[9px] font-black bg-emerald-50 text-emerald-500 px-2 py-1 rounded">Total</span>
        </div>

        <div class="bg-white p-8 rounded-[2rem] border border-slate-50 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Banned Users</p>
            <p class="text-4xl font-black text-red-500 mb-2">{{ $bannedUsersCount }}</p>
            <span class="text-[9px] font-black bg-red-50 text-red-500 px-2 py-1 rounded">Blocked</span>
        </div>

        <div class="bg-white p-8 rounded-[2rem] border border-slate-50 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Colocations</p>
            <p class="text-4xl font-black text-indigo-600 mb-2">{{ $totalColocations }}</p>
            <span class="text-[9px] font-black bg-indigo-50 text-indigo-500 px-2 py-1 rounded">Total</span>
        </div>

    </div>


    {{-- ================= USERS TABLE ================= --}}
    <div class="bg-white rounded-[3rem] p-10 border border-slate-50 shadow-sm">

        <div class="flex justify-between items-center mb-10">
            <h3 class="text-xl font-black text-slate-800 uppercase italic">
                User Management
            </h3>
        </div>

        <table class="w-full text-left">
            <thead>
                <tr class="text-[10px] font-black uppercase text-slate-300 border-b border-slate-50">
                    <th class="pb-6">ID</th>
                    <th class="pb-6">User</th>
                    <th class="pb-6">Email</th>
                    <th class="pb-6">Reputation</th>
                    <th class="pb-6">Status</th>
                    <th class="pb-6 text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr class="border-b border-slate-50 hover:bg-slate-50 transition">

                    {{-- ID --}}
                    <td class="py-6 text-[10px] text-slate-300 font-mono">
                        #{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}
                    </td>

                    {{-- Name --}}
                    <td class="py-6 font-black text-slate-800 italic">
                        {{ $user->name }}
                    </td>

                    {{-- Email --}}
                    <td class="py-6 text-xs text-slate-400">
                        {{ $user->email }}
                    </td>

                    {{-- Reputation --}}
                    <td class="py-6 font-black text-xs 
                        {{ $user->reputation >= 0 ? 'text-emerald-500' : 'text-red-500' }}">
                        {{ $user->reputation }} pts
                    </td>

                    {{-- Status Badge --}}
                    <td class="py-6">
                        @if($user->status === 'ban')
                        <span class="text-[9px] font-black uppercase text-red-500 flex items-center gap-1.5 italic">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                            Banned
                        </span>
                        @else
                        <span class="text-[9px] font-black uppercase text-emerald-500 flex items-center gap-1.5 italic">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                            Active
                        </span>
                        @endif
                    </td>

                    {{-- Actions --}}
                    <td class="py-6 text-right">

                        {{-- Protect current logged-in user OR any admin --}}
                        @if(auth()->id() === $user->id || $user->role_id === 1)
                        <button
                            class="text-[9px] font-black uppercase px-4 py-2 rounded-xl bg-slate-50 text-slate-300 border border-slate-100 italic cursor-not-allowed">
                            Protected
                        </button>
                        @else

                        @if($user->status === 'ban')
                        <form method="POST" action="{{ route('admin.unban', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="text-[9px] font-black uppercase px-4 py-2 rounded-xl bg-emerald-50 text-emerald-500 border border-emerald-100 italic hover:bg-emerald-100 transition">
                                Activate
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.ban', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="text-[9px] font-black uppercase px-4 py-2 rounded-xl bg-red-50 text-red-500 border border-red-100 italic hover:bg-red-100 transition">
                                Ban
                            </button>
                        </form>
                        @endif

                        @endif

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>
@endsection