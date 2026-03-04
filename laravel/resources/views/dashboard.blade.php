<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:block">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-indigo-600">Co-Livo</h1>
            </div>
            <nav class="mt-4 px-4 space-y-2">
                <a href="{{ route('user.dashboard') }}" class="flex items-center p-3 text-indigo-600 bg-indigo-50 rounded-xl group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="ml-3 font-bold">Dashboard</span>
                </a>
                <a href="{{ route('user.expenses.index') }}" class="flex items-center p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m.599-.741l1.347-1.347M12 17a5.978 5.978 0 01-4.599-2M12 12H9m3 0h3"></path>
                    </svg>
                    <span class="ml-3 font-medium">Expenses</span>
                </a>

                {{-- Admin Dashboard --}}
                @if(auth()->check() && auth()->user()->role_id == 1)
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 p-4 rounded-2xl font-bold text-[11px] uppercase tracking-widest text-rose-500 hover:bg-rose-50 transition-all {{ request()->routeIs('admin.*') ? 'bg-rose-50' : '' }}">
                    <i class="fas fa-user-shield text-sm"></i> Admin Panel
                </a>
                @endif
            </nav>
        </aside>

        <main class="flex-1 p-8">
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Welcome back, {{ Auth::user()->name }}!</h2>
                    <p class="text-gray-500">Here’s what’s happening in your colocation.</p>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('user.expenses.index') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                        + Add Expense
                    </a>
                </div>
            </header>

            {{-- Summary Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total Shared</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalSpent, 2) }} DH</h3>
                    <div class="text-indigo-500 text-sm font-medium mt-2">Colocation: {{ $membership->colocation->name ?? 'None' }}</div>
                </div>

                @php
                // Get the specific balance for the logged-in user
                $myBalance = collect($balances)->firstWhere('user_id', Auth::id());
                @endphp

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Your Balance</p>
                    <h3 class="text-2xl font-bold mt-1 {{ $myBalance['balance'] >= 0 ? 'text-emerald-500' : 'text-red-500' }}">
                        {{ number_format($myBalance['balance'] ?? 0, 2) }} DH
                    </h3>
                    <div class="text-gray-400 text-sm mt-2">
                        {{ $myBalance['balance'] >= 0 ? 'Group owes you' : 'You owe the group' }}
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">My Role</p>
                    <div class="flex items-center mt-1">
                        <h3 class="text-2xl font-bold text-gray-800 capitalize">{{ $membership->role ?? 'N/A' }}</h3>
                        @if(($membership->role ?? '') === 'owner')
                        <span class="ml-2 px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full font-bold">Admin</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Recent Activity Table --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h4 class="font-bold text-gray-800">Recent Activity</h4>
                    <a href="{{ route('user.expenses.index') }}" class="text-indigo-600 text-sm font-semibold hover:underline">View History</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-400 text-xs uppercase font-semibold">
                            <tr>
                                <th class="px-6 py-3">Expense</th>
                                <th class="px-6 py-3">Category</th>
                                <th class="px-6 py-3">Payer</th>
                                <th class="px-6 py-3">Amount</th>
                                <th class="px-6 py-3 text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                            @forelse($expenses->take(5) as $expense)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $expense->title }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-md text-xs uppercase font-bold">
                                        {{ $expense->category->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $expense->payer->name }}</td>
                                <td class="px-6 py-4 font-bold">{{ number_format($expense->amount, 2) }} DH</td>
                                <td class="px-6 py-4 text-right text-gray-400">
                                    {{ \Carbon\Carbon::parse($expense->date)->format('d M, Y') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">No recent expenses found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>