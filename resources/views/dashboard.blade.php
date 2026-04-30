<x-layouts::app :title="__('Dashboard')">

    <div class="flex flex-col gap-6 max-w-7xl mx-auto py-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between border-b border-gray-700 pb-4">
            <div>
                <h1 class="text-2xl font-semibold text-white">Dashboard</h1>
                <p class="text-sm text-gray-400 mt-1">
                    Welcome back, <span class="font-medium text-gray-200">{{ auth()->user()->name }}</span>
                </p>
            </div>
            
            {{-- TOMBOL CREATE CEPAT --}}
            <a href="{{ route('servers.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                + New Server
            </a>
        </div>

        {{-- STATS CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- Total Card --}}
            <div class="bg-gray-800 rounded-lg shadow-sm border border-gray-700 p-5 flex items-center">
                <div class="flex-shrink-0 bg-gray-700 rounded-md p-3">
                    <svg class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                    </svg>
                </div>
                <div class="ml-4">
                    <dt class="text-sm font-medium text-gray-400">Total Servers</dt>
                    <dd class="text-2xl font-semibold text-white">{{ auth()->user()->servers()->count() }}</dd>
                </div>
            </div>

            {{-- Active Card --}}
            <div class="bg-gray-800 rounded-lg shadow-sm border border-gray-700 p-5 flex items-center">
                <div class="flex-shrink-0 bg-gray-700 rounded-md p-3">
                    <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <dt class="text-sm font-medium text-gray-400">Active Servers</dt>
                    <dd class="text-2xl font-semibold text-white">{{ auth()->user()->servers()->where('status','active')->count() }}</dd>
                </div>
            </div>

            {{-- Pending Card --}}
            <div class="bg-gray-800 rounded-lg shadow-sm border border-gray-700 p-5 flex items-center">
                <div class="flex-shrink-0 bg-gray-700 rounded-md p-3">
                    <svg class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <dt class="text-sm font-medium text-gray-400">Pending & Provisioning</dt>
                    <dd class="text-2xl font-semibold text-white">
                        {{ auth()->user()->servers()->whereIn('status',['pending', 'provisioning'])->count() }}
                    </dd>
                </div>
            </div>

        </div>

        {{-- LIST SERVER TERBARU --}}
        <div class="bg-gray-800 rounded-lg shadow-sm border border-gray-700 mt-2 overflow-hidden">
            
            <div class="px-6 py-4 border-b border-gray-700 bg-gray-800/50">
                <h3 class="text-base font-semibold text-white">Your Recent Servers</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead class="bg-gray-900/50 text-gray-400 text-xs uppercase font-medium">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-700">Server Name</th>
                            <th class="px-6 py-3 border-b border-gray-700">Address / IP</th>
                            <th class="px-6 py-3 border-b border-gray-700 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700 text-sm text-gray-300">
                        @forelse(auth()->user()->servers()->latest()->take(5)->get() as $server)
                            <tr class="hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4 font-medium text-white">
                                    {{ $server->name }}
                                </td>
                                <td class="px-6 py-4 font-mono text-gray-400">
                                    {{ $server->ip ?? '127.0.0.1' }}:{{ $server->port }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($server->status == 'active')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500/20 text-green-400">
                                            Active
                                        </span>
                                    @elseif($server->status == 'pending' || $server->status == 'provisioning')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-500/20 text-yellow-400">
                                            {{ ucfirst($server->status) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500/20 text-red-400">
                                            {{ ucfirst($server->status) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-400">
                                    <p>You haven't created any servers yet.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Tombol View All --}}
            <div class="px-6 py-3 bg-gray-800 border-t border-gray-700 text-right">
                <a href="{{ route('servers.index') }}" class="text-sm font-medium text-blue-400 hover:text-blue-300">
                    View all servers &rarr;
                </a>
            </div>

        </div>

    </div>

</x-layouts::app>