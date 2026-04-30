<x-layouts::app :title="__('My Servers')">

    <div class="flex flex-col gap-6 max-w-7xl mx-auto py-6">

        {{-- HEADER & FORM CREATE --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-700 pb-5">
            <div>
                <h1 class="text-2xl font-semibold text-white">My Servers</h1>
                <p class="text-sm text-gray-400 mt-1">Manage and provision your Minecraft servers.</p>
            </div>
            
            {{-- FORM --}}
            <form method="POST" action="{{ route('servers.store') }}" class="flex gap-2 w-full md:w-auto">
                @csrf
                <input 
                    type="text" 
                    name="name" 
                    placeholder="Enter server name..."
                    required
                    class="bg-gray-900 border border-gray-600 text-white text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full md:w-64 px-3 py-2 shadow-sm"
                >
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-700 active:bg-blue-900 transition ease-in-out duration-150 whitespace-nowrap shadow-sm">
                    + Create
                </button>
            </form>
        </div>

        {{-- FLASH MESSAGE --}}
        @if(session('success'))
            <div class="p-4 flex items-center gap-3 text-sm text-green-400 rounded-lg bg-green-500/10 border border-green-500/20" role="alert">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- SERVER LIST (Grid Cards) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-2">
            @forelse($servers as $server)
                <div class="bg-gray-800 rounded-lg shadow-sm border border-gray-700 flex flex-col overflow-hidden hover:border-gray-600 transition-colors">
                    
                    {{-- Card Header --}}
                    <div class="px-5 py-4 border-b border-gray-700 bg-gray-800/50 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-white truncate pr-2" title="{{ $server->name }}">
                            {{ $server->name }}
                        </h3>
                        
                        {{-- Status Badge --}}
                        <div>
                            @if($server->status == 'active')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500/20 text-green-400">Active</span>
                            @elseif($server->status == 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-500/20 text-yellow-400">Pending</span>
                            @elseif($server->status == 'provisioning')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/20 text-blue-400">Provisioning</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500/20 text-red-400">{{ ucfirst($server->status) }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-5 flex-1 text-sm text-gray-400 space-y-3">
                        <div class="flex justify-between border-b border-gray-700/50 pb-2">
                            <span class="text-gray-500">Port</span>
                            <span class="font-medium text-gray-300">{{ $server->port }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-700/50 pb-2">
                            <span class="text-gray-500">Version</span>
                            <span class="font-medium text-gray-300">{{ $server->version }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">IP Address</span>
                            <span class="font-mono font-medium {{ $server->ip ? 'text-blue-400' : 'text-gray-500 italic' }}">
                                {{ $server->ip ?? 'Not assigned yet' }}
                            </span>
                        </div>
                    </div>

                    {{-- Card Footer (Actions) --}}
                    <div class="px-5 py-4 bg-gray-900/30 border-t border-gray-700 mt-auto flex flex-col gap-2">
                        
                        {{-- TOMBOL UTAMA --}}
                        @if($server->status == 'pending')
                            <a href="{{ route('pay.create', $server->id) }}"
                               target="_blank"
                               class="block w-full text-center px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-md transition-colors shadow-sm">
                                Pay Now (Rp 10.000)
                            </a>
                        @elseif($server->status == 'active')
                            <button disabled class="block w-full text-center px-4 py-2 bg-gray-700 text-gray-400 text-sm font-semibold rounded-md cursor-not-allowed border border-gray-600">
                                Server is Running
                            </button>
                        @elseif($server->status == 'provisioning')
                            <button disabled class="block w-full text-center px-4 py-2 bg-blue-900/50 text-blue-400 text-sm font-semibold rounded-md cursor-wait border border-blue-800">
                                Starting up...
                            </button>
                        @endif

                        {{-- TOMBOL HAPUS --}}
                        <form method="POST" action="{{ route('servers.destroy', $server->id) }}" class="w-full m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Yakin ingin menghapus server ini? Semua data di dalamnya akan hilang dan tidak dapat dikembalikan.')"
                                    class="block w-full text-center px-4 py-2 bg-transparent hover:bg-red-900/30 text-red-500 hover:text-red-400 text-sm font-semibold rounded-md transition-colors border border-red-500/30 hover:border-red-500/50">
                                Delete Server
                            </button>
                        </form>

                    </div>

                </div>
            @empty
                <div class="col-span-full p-8 text-center bg-gray-800 rounded-lg border border-gray-700 border-dashed">
                    <svg class="mx-auto h-12 w-12 text-gray-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                    </svg>
                    <p class="text-gray-400">No servers found. Create your first Minecraft server above!</p>
                </div>
            @endforelse
        </div>

    </div>

</x-layouts::app>