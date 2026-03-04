@extends('layout.app')
@section('title', 'Dashboard')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    {{-- Header --}}
    <header class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Welcome back, {{ Auth::user()->name }}!</h2>
            <p class="text-slate-400 font-medium text-sm mt-1">Manage your home and shared expenses.</p>
        </div>
        @if($membership)
        <a href="{{ route('user.expenses.index') }}"
            class="bg-indigo-600 text-white px-8 py-4 rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-indigo-700 transition shadow-xl shadow-indigo-100">
            <i class="fas fa-plus mr-2"></i> Add Expense
        </a>
        @endif
    </header>

    @if($membership)
    {{-- Stats Grid (Working Statistics) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Total Shared Card --}}
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Shared</p>
            <h3 class="text-2xl font-black text-slate-800 mt-2">
                {{ number_format($totalSpent, 2) }} DH
            </h3>
            <div class="text-indigo-500 text-[10px] font-bold mt-2 uppercase tracking-wide">
                {{ $membership->colocation->name }}
            </div>
        </div>

        {{-- Your Balance Card --}}
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Your Balance</p>
            @php
            // Find your specific balance from the collection passed by the controller
            $myRecord = collect($balances)->firstWhere('user_id', Auth::id());
            $val = $myRecord['balance'] ?? 0;
            @endphp

            <h3 class="text-2xl font-black mt-2 {{ $val >= 0 ? 'text-emerald-500' : 'text-rose-500' }}">
                {{ $val > 0 ? '+' : '' }}{{ number_format($val, 2) }} DH
            </h3>

            <div class="text-slate-400 text-[10px] font-bold mt-2 uppercase tracking-wide">
                @if($val > 0)
                Owed to you
                @elseif($val < 0)
                    You owe the group
                    @else
                    You are all settled
                    @endif
                    </div>
            </div>

            {{-- Role Card --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Role</p>
                <div class="flex items-center mt-2">
                    <h3 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">{{ $membership->role }}</h3>
                    @if($membership->role === 'owner')
                    <span class="ml-3 px-3 py-1 bg-amber-100 text-amber-600 text-[9px] rounded-full font-black uppercase">Admin</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Invitations Section --}}
            <div class="lg:col-span-7 space-y-8">
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-50">
                    <h2 class="text-lg font-black uppercase text-slate-800 mb-8 tracking-tight">Invitations</h2>

                    {{-- Only Owner can see the Invitation Form --}}
                    @if($membership->role === 'owner')
                    <form method="POST" action="{{ route('user.invitation.send') }}" class="flex gap-3 mb-10">
                        @csrf
                        <input type="email" name="email" required placeholder="User email..."
                            class="flex-1 bg-slate-50 rounded-2xl px-6 py-4 text-sm border-none focus:ring-2 focus:ring-indigo-100">
                        <button type="submit" class="bg-slate-800 text-white px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-black transition">
                            Invite
                        </button>
                    </form>
                    @endif

                    <div class="space-y-4">
                        @forelse($invitations as $invitation)
                        <div class="flex justify-between items-center p-6 bg-slate-50 rounded-[2rem] border border-white">
                            <div>
                                <p class="text-sm font-black text-slate-800 uppercase tracking-tighter">{{ $invitation->colocation->name }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">Pending Request</p>
                            </div>
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('user.invitation.accept', $invitation->id) }}"> @csrf
                                    <button class="px-5 py-3 bg-emerald-500 text-white text-[10px] font-black rounded-xl uppercase">Accept</button>
                                </form>
                                <form method="POST" action="{{ route('user.invitation.refuse', $invitation->id) }}"> @csrf
                                    <button class="px-5 py-3 bg-white text-rose-500 border border-rose-100 text-[10px] font-black rounded-xl uppercase">Refuse</button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <p class="text-center text-slate-400 text-xs italic py-4">No pending invitations.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Categories Section --}}
            <div class="lg:col-span-5 space-y-8">
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-50">
                    <h2 class="text-lg font-black uppercase text-slate-800 mb-8 tracking-tight">Categories</h2>

                    @if($membership->role === 'owner')
                    <form method="POST" action="{{ route('user.categories.store') }}" class="mb-8">
                        @csrf
                        <div class="flex gap-2">
                            <input type="text" name="name" required placeholder="New Category..."
                                class="flex-1 bg-slate-50 rounded-2xl px-5 py-3 text-sm border-none focus:ring-2 focus:ring-indigo-100">
                            <button type="submit" class="bg-indigo-50 text-indigo-600 px-5 py-3 rounded-2xl text-[10px] font-black uppercase">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </form>
                    @else
                    <div class="mb-8 p-4 bg-slate-50 rounded-2xl text-center">
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest leading-loose">
                            <i class="fas fa-lock mr-2"></i> Category management is <br> restricted to the owner
                        </p>
                    </div>
                    @endif

                    <div class="space-y-3">
                        @forelse($categories as $cat)
                        <div class="flex justify-between items-center bg-slate-50 p-4 rounded-2xl group hover:bg-white border border-transparent hover:border-slate-100 transition-all">
                            <span class="text-xs font-black text-slate-600 uppercase tracking-tighter">{{ $cat->name }}</span>

                            @if($membership->role === 'owner')
                            <form method="POST" action="{{ route('user.categories.destroy', $cat->id) }}" onsubmit="return confirm('Delete category?')">
                                @csrf @method('DELETE')
                                <button class="text-slate-300 hover:text-rose-500 transition px-2">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                        @empty
                        <p class="text-slate-400 text-xs italic text-center py-4">No categories created.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Colocation Actions --}}
                <div class="p-4 text-center">
                    <form method="POST" action="{{ $membership->role === 'member' ? route('user.leave', $membership->colocation_id) : route('user.cancel', $membership->colocation_id) }}"
                        onsubmit="return confirm('Confirm this action?')">
                        @csrf
                        <button type="submit" class="text-slate-300 hover:text-rose-500 text-[9px] font-black uppercase tracking-[0.2em] transition">
                            {{ $membership->role === 'member' ? 'Leave Colocation' : 'Disband Colocation' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @else
        {{-- Not in a Colocation View --}}
        <div class="max-w-xl mx-auto py-20 text-center">
            <h2 class="text-2xl font-black text-slate-800 uppercase">No House Found</h2>
            <p class="text-slate-400 mt-2 mb-10">Create a colocation or check your invites to get started.</p>
            <form method="POST" action="{{ route('user.colocation.store') }}" class="bg-indigo-600 p-10 rounded-[3rem] shadow-xl">
                @csrf
                <input type="text" name="name" required placeholder="House Name" class="w-full bg-white/10 border-none rounded-2xl px-6 py-4 text-white mb-4">
                <button class="w-full bg-white text-indigo-600 py-4 rounded-2xl font-black uppercase text-xs">Create House</button>
            </form>
        </div>
        @endif
    </div>
    @endsection