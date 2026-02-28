@extends('layout.app')
@section('title', 'USER DASHBOARD')

@section('content')

<div class="max-w-6xl mx-auto space-y-12">

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-600 px-6 py-4 rounded-2xl font-bold text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 text-red-600 px-6 py-4 rounded-2xl font-bold text-sm">
            {{ session('error') }}
        </div>
    @endif


    {{-- ============================= --}}
    {{-- CREER COLOCATION --}}
    {{-- ============================= --}}
    @if(!$membership)

    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-50">
        <h2 class="text-xl font-black uppercase text-slate-800 mb-8">
            Créer une colocation
        </h2>

        <form method="get" action="{{ route('user.colocation.store') }}" class="flex gap-4">
            @csrf

            <input type="text"
                   name="name"
                   placeholder="Nom de la colocation"
                   class="w-full bg-slate-50 rounded-2xl px-5 py-4 text-sm border-none focus:ring-2 focus:ring-indigo-200">

            <button type="submit"
                    class="bg-indigo-500 hover:bg-indigo-600 transition text-white px-8 py-4 rounded-2xl text-xs font-black uppercase">
                Créer
            </button>
        </form>
    </div>

    @endif


    {{-- ============================= --}}
    {{-- MA COLOCATION --}}
    {{-- ============================= --}}
    @if($membership)

    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-50">
        <h2 class="text-xl font-black uppercase text-slate-800 mb-8">
            Ma Colocation
        </h2>

        <div class="flex justify-between items-center">

            <div>
                <p class="text-lg font-black text-slate-800">
                    {{ $membership->colocation->name }}
                </p>

                <p class="text-xs text-slate-400 mt-2 uppercase tracking-wider">
                    Rôle : 
                    <span class="{{ $membership->role === 'owner' ? 'text-indigo-600' : 'text-slate-600' }}">
                        {{ $membership->role }}
                    </span>
                </p>
            </div>

            @if($membership->role === 'member')
                <form method="GET" action="{{ route('user.leave') }}">
                    @csrf
                    <button class="px-6 py-3 bg-red-500 hover:bg-red-600 transition text-white text-xs rounded-xl font-black uppercase">
                        Quitter
                    </button>
                </form>
            @else
                <div class="bg-indigo-50 text-indigo-600 px-6 py-4 rounded-2xl text-xs font-bold">
                    Vous êtes le propriétaire
                </div>
            @endif

        </div>
    </div>

    @endif


    {{-- ============================= --}}
    {{-- INVITATIONS --}}
    {{-- ============================= --}}
    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-50">

        <h2 class="text-xl font-black uppercase text-slate-800 mb-10">
            Mes Invitations
        </h2>

        @forelse($invitations as $invitation)

            <div class="flex justify-between items-center p-6 mb-6 bg-slate-50 rounded-2xl">

                <div>
                    <p class="text-sm font-black text-slate-800">
                        {{ $invitation->colocation->name }}
                    </p>

                    <p class="text-xs text-slate-400 mt-1">
                        Invitation en attente
                    </p>
                </div>

                <div class="flex gap-4">

                    <form method="post" action="{{ route('user.invitation.accept', $invitation->id) }}">
                        @csrf
                        <button class="px-5 py-2 bg-emerald-500 hover:bg-emerald-600 transition text-white text-xs rounded-xl font-black uppercase">
                            Accepter
                        </button>
                    </form>

                    <form method="post" action="{{ route('user.invitation.refuse', $invitation->id) }}">
                        @csrf
                        <button class="px-5 py-2 bg-red-500 hover:bg-red-600 transition text-white text-xs rounded-xl font-black uppercase">
                            Refuser
                        </button>
                    </form>

                </div>
            </div>

        @empty
            <div class="text-center text-slate-400 text-sm">
                Aucune invitation pour le moment
            </div>
        @endforelse

    </div>

</div>

@endsection