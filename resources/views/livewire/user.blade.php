<div>
    <a href="/user/create" type="button"
        class="text-white bg-[#24292F] hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-[#050708]/30 mb-2">
        Novo usuário
    </a>
    <div class="w-full flex justify-between items-center mb-3 mt-1">
        <div class="my-4 max-w-20 flex justify-center ">
            <select wire:model.live='perPage'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="ml-3">
            <div class="w-full max-w-sm min-w-[200px] relative">
                <div class="relative">
                    <input wire:model.live="search"
                        class=" bg-white dark:bg-gray-800 w-full pr-11 h-10 pl-3 py-2 px-6 bg-transparent placeholder:text-slate-400 dark:text-slate-200 text-slate-700 text-sm border border-slate-200 rounded-lg transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                        placeholder="Busca por usuários..." />
                    <button
                        class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex justify-center items-center bg-wdark:hite dark:bg-gr bg-gray-200adark:y-800 rounded "
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="currentColor" class="w-8 h-8 text-slate-600 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <div
        class="relative overflow-x-auto sm:rounded-lg flex flex-col w-full h-full text-gray-700 shadow-md rounded-lg bg-clip-border">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="p-4 border-b dark:border-gray-700 bg-gray-200 dark:bg-gray-800">
                        <p class="text-sm font-normal leading-none text-slate-500">
                            Nome
                        </p>
                    </th>
                    <th class="p-4 border-b dark:border-gray-700 bg-gray-200 dark:bg-gray-800">
                        <p class="text-sm font-normal leading-none text-slate-500">
                            Email
                        </p>
                    </th>
                    <th class="p-4 border-b dark:border-gray-700 bg-gray-200 dark:bg-gray-800">
                        <p class="text-sm font-normal leading-none text-slate-500">
                            Privilégio
                        </p>
                    </th>
                    <th class="p-4 border-b dark:border-gray-700 bg-gray-200 dark:bg-gray-800">
                        <p class="text-sm text-center font-normal leading-none text-slate-500">
                            Ações
                        </p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($user as $users)
                    <tr wire:key="{{ $users->id }}" class=" border-b border-slate-200 dark:border-gray-700">
                        <td class="p-4 py-5 flex gap-1">
                            <p class="block font-semibold text-sm text-slate-800 dark:text-slate-300">
                                {{ $users->name }}</p>
                                <p class="block font-semibold text-sm text-slate-800 dark:text-slate-300">
                                    {{ $users->last_name }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">{{ $users->email }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">{{ $users->level == 0 ? 'admin' : 'usuário' }}</p>
                        </td>
                        <td class="p-4 py-5 text-center">
                            <button
                                onclick="confirm('Are you sure want to delete {{ $users->name }}?') || event.stopImmediatePropagation()"
                                wire:click="delete({{ $users->id }})"><i
                                    class="bx bx-trash cursor-pointer text-red-500"></i></button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-sm text-gray-800">Nenhum usuário
                            encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        <div class="px-4 py-3">
            {{ $user->links() }}
        </div>
    </div>

</div>
