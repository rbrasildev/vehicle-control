<div>
    <!-- Botão para abrir o modal -->
    <button wire:click="openModal"
        class="p-2 dark:bg-blue-950 bg-blue-500 rounded-md mb-2 px-4 text-gray-200 shadow hover:bg-blue-900 transition-all duration-75">Troca
        de óleo</button>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
                <h2 class="text-lg font-bold mb-4">Criar nova troca de óleo</h2>

                <!-- Formulário -->
                <div class="space-y-4">
                    <div>
                        <input hidden type="number" wire:model="vehicleId" class="w-full border rounded p-2" />
                    </div>
                    <div>
                        <label class="block text-gray-700">Data</label>
                        <input type="date" wire:model="data_troca" class="w-full border rounded p-2" />
                        @error('data_troca')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">km atual</label>
                        <input type="text" wire:model="quilometragem" class="w-full border rounded p-2" />
                        @error('quilometragem')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <select wire:model="tipo_de_oleo_id"
                            class="mt-1 border  p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                            <option  disabled selected>Selecione um tipo de óleo</option>
                            @foreach ($tiposDeOleo as $tipoDeOleo)
                                <option value="{{ $tipoDeOleo->id }}">{{ $tipoDeOleo->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Valor</label>
                        <input type="text" wire:model="valor" class="w-full border rounded p-2" />
                        @error('valor')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Observações</label>
                        <input type="text" wire:model="observacoes" class="w-full border rounded p-2" />
                        @error('observacoes')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Botões -->
                <div class="flex justify-end mt-6">
                    <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">
                        Cancelar
                    </button>
                    <button wire:click="save" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Salvar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
