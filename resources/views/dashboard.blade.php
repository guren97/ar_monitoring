<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center"> 
                        <div class="text-lg font-medium text-gray-900">
                            Total Original BSN
                        </div>
                    </div> 
                    <div class="mt-2">
                        <p class="text-2xl font-bold">{{ $total_original_bsn }}</p> 
                    </div>
                </div>
            </div> 

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center"> 
                        <div class="text-lg font-medium text-gray-900">
                            Total Processed BSN
                        </div>
                    </div> 
                    <div class="mt-2">
                        <p class="text-2xl font-bold">{{ $total_processed_bsn }}</p> 
                    </div>
                </div>
            </div> 

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center"> 
                        <div class="text-lg font-medium text-gray-900">
                          Total Workloads
                        </div>
                    </div> 
                    <div class="mt-2">
                        <p class="text-2xl font-bold">{{ $total_enumeration_area }}</p> 
                    </div>
                </div>
            </div> 

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center"> 
                        <div class="text-lg font-medium text-gray-900">
                          Some card here
                        </div>
                    </div> 
                    <div class="mt-2">
                        <p class="text-2xl font-bold">Card details</p> 
                    </div>
                </div>
            </div>   

        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 "> 
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center"> 
                            <div class="text-lg font-medium text-gray-900">
                              Progress
                            </div>
                        </div> 
                        <div class="mt-2">
                            <p class="text-2xl font-bold">Graph here...</p> 
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div> 
</x-app-layout>

 