<div>
    <div class="mb-4">
        <a class="bg-slate-900 text-white p-2 rounded-md" href="/veiculos/create" wire:navigate>New vehicle</a>
    </div>

    <div class="mb-4 flex items-center space-x-2">
        <input type="text"
            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Pesquisar por nome..." wire:model.live="query" aria-label="Pesquisar Usuário">
    </div>


    <!-- Tabela de Usuários -->
    <table class="min-w-full table-auto border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">#</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nome</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicle as $vehicle)
                <tr class="border-b">
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $vehicle->placa }}</td>
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $vehicle->marca }}</td>
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $vehicle->modelo }}</td>
                    <td class="px-4 flex gap-2 md:block py-2 text-sm text-gray-800">
                        <button class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600"><i
                                class="bx bxs-edit"></i></button>
                        <button wire:click="delete({{ $vehicle->id }})" class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600"><i
                                class="bx bxs-trash"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-sm text-gray-800">Nenhum usuário encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginação -->
    <div class="mt-4">
        {{-- {{ $results->links() }} <!-- Links de paginação com Tailwind --> --}}
    </div>
</div>
