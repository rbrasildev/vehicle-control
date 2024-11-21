   <table class="min-w-full table-auto border-collapse">
       <thead class="bg-gray-100">
           <tr>
               <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Data</th>
               <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Quilometragem</th>
               <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Tipo Óleo</th>
               <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Observações</th>
               <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Ações</th>
           </tr>
       </thead>
       <tbody>
           @forelse($oilChange as $item)
               <tr class="border-b">
                   <td class="px-4 py-2 text-sm text-gray-800">{{ $item->data_troca }}</td>
                   <td class="px-4 py-2 text-sm text-gray-800">{{ $item->quilometragem }}</td>
                   <td class="px-4 py-2 text-sm text-gray-800">{{ $item->tipo_oleo }}</td>
                   <td class="px-4 py-2 text-sm text-gray-800">{{ $item->observacoes }}</td>
                   <td class="px-4 flex gap-2 md:block py-2 text-sm text-gray-800">
                       <button class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600"><i
                               class="bx bxs-edit"></i></button>
                       <button wire:click="delete({{ $item->id }})"
                           class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600"><i
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
