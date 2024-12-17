<div>
    <div class="w-full max-w-sm min-w-[200px] relative">
        <div class="relative">
            <input wire:model.live="search"
                class=" bg-white dark:bg-gray-800 w-full pr-11 h-10 pl-3 py-2 px-6 bg-transparent placeholder:text-slate-400 dark:text-slate-200 text-slate-700 text-sm border border-slate-200 rounded-lg transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                placeholder="Digite a placa..." />
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


    <a href="#"
        class="flex mt-4 flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
            src="https://www.github.com/rbrasildev.png" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $vehicle->marca }}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$vehicle->placa}}.</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$vehicle->quilometragem}}.</p>
        </div>
    </a>

</div>
