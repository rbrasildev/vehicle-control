<div>
    <!-- Botão de exemplo para abrir o modal -->
    <button wire:click="openModal(1)" >
        <i class="bx bxs-edit"></i>
    </button>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
                <h2 class="text-lg font-bold mb-4">Editar Veículo</h2>

                <!-- Formulário -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700">Placa</label>
                        <input type="text" wire:model="placa" class="w-full border rounded p-2" />
                        @error('placa')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Marca</label>
                        <input type="text" wire:model="marca" class="w-full border rounded p-2" />
                        @error('marca')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Modelo</label>
                        <input type="text" wire:model="modelo" class="w-full border rounded p-2" />
                        @error('modelo')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Ano</label>
                        <input type="text" wire:model="ano" class="w-full border rounded p-2" />
                        @error('ano')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Quilometragem</label>
                        <input type="text" wire:model="quilometragem" class="w-full border rounded p-2" />
                        @error('quilometragem')
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
