<style>
    #deleteModal {
        animation: fadeIn 0.2s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>

<x-app-layout>
    <x-slot name="header"> 
        <div class="flex flex-wrap justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Accomplishment Report Monitoring') }}
            </h2>
            <!-- Date Filter Form -->
            <form method="GET" action="{{ route('monitoring') }}" class="w-full md:w-auto flex flex-col md:flex-row items-center md:items-end gap-4">
               
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 w-full md:w-auto">
                    <div>
                        {{-- <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label> --}}
                        <input type="date" name="start_date" id="start_date" value="{{ request()->start_date }}" class="mt-1 block w-full text-gray-600 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-xs">
                    </div>
             
                    <div>
                        {{-- <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label> --}}
                        <input type="date" name="end_date" id="end_date" value="{{ request()->end_date }}" class="mt-1 block w-full text-gray-600 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-xs">
                    </div>
                </div>
                <div class="flex flex-col lg:space-x-2 lg:flex-row items-center space-y-4 lg:space-y-0 grid-cols-1 lg:grid-cols-2 w-full lg:w-4/12 lg:justify-between">
                    <div class="w-full">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-medium text-xs rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                           <span><i class="fas fa-filter"></i>&nbsp;Filter</span>
                        </button>
                    </div>
                    <div class="w-full lg:w-auto"> 
                        <a href="{{ route('monitoring') }}" class="px-4 py-2.5 h-full flex items-center justify-cente bg-gray-300 text-gray-800 font-medium text-xs rounded-md hover:bg-gray-500 focus:ring-2 focus:ring-gray-500">
                            <i class="fas fa-rotate-right"></i>   
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </x-slot> 

    <div class="py-4"> 
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> 

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
               
                <div class="text-gray-900">

                    {{-- Searchbar --}}
                    <div class="border-b w-full flex justify-between items-center bg-gray-300  py-4 px-6 -mb-4">
                        <div>
                            <h2 class="font-semibold text-lg text-gray-800 leading-tight -mt-4">
                                {{ __('My workloads') }}
                            </h2>
                        </div>

                        <form class="flex flex-wrap items-center gap-4" method="GET" action="{{ route('monitoring') }}">
                            <div class="flex justify-end w-full md:w-auto">
                                <div class="relative w-full md:w-auto">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="fas fa-magnifying-glass text-gray-600"></i>
                                    </div>
                                    <input
                                        type="text"
                                        id="workload"
                                        name="workload"
                                        class="w-full md:w-80 pl-10 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-xs"
                                        placeholder="Search workload..."
                                        value="{{ request()->get('workload') }}"
                                    />
                                </div>
                            </div>
                            
                            <h2 class="text-gray-400 hidden sm:inline">or</h2>
                            <select name="status" class="w-full md:w-auto bg-white border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-xs text-gray-600">
                                <option value="" disabled selected>search by status</option>
                                <option value="completed" {{ request()->get('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="pending" {{ request()->get('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ request()->get('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            </select>
                            <div class="flex gap-2">
                                <button type="submit" class="px-4 py-2 bg-gray-500 text-white font-medium text-xs rounded-md hover:bg-gray-600 focus:ring-2 focus:ring-blue-500">
                                    <i class="fas fa-search"></i> Search
                                    <span class="sr-only">Search</span>
                                </button>
                                <a href="{{ route('monitoring') }}" class="px-4 py-2 flex items-center justify-cente bg-gray-50 text-gray-800 font-medium text-sm rounded-md hover:bg-gray-200 focus:ring-2 focus:ring-gray-500">
                                    <i class="fas fa-rotate-right"></i>   
                                </a>
                            </div>
                        </form>
                    </div>

                    @if($accomplishment_reports->isEmpty())
                        <p class="text-gray-500 px-6 mt-10 mb-4">No workload(s) found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto border-separate border-spacing-0">
                                <thead>
                                    <tr class="bg-gray-100 border-b"> 
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-900 uppercase whitespace-nowrap">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => request('sort') === 'asc' ? 'desc' : 'asc']) }}">
                                                @if(request('sort') === 'asc')
                                                    <i class="fas fa-sort-up"></i>
                                                @elseif(request('sort') === 'desc')
                                                    <i class="fas fa-sort-down"></i>
                                                @else
                                                    <i class="fas fa-sort"></i>
                                                @endif
                                                <span>&nbsp;Date</span>
                                            </a>
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase whitespace-nowrap">Municipality</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase whitespace-nowrap">Barangay</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase whitespace-nowrap">Enumeration Area</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase whitespace-nowrap">Original BSN</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase whitespace-nowrap">Processed BSN</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase whitespace-nowrap">Remarks</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase whitespace-nowrap">Status</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase whitespace-nowrap">
                                            <div class="flex items-center space-x-2">
                                                <div>Actions</div>
                                                <div>
                                                   <button id="addNewModalBtn" class="flex items-center justify-center bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                                                        <i class="fas fa-plus"></i>&nbsp;New
                                                    </button>
                                                </div>
                                            </div>
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accomplishment_reports as $report)
                                    <tr class="border-b hover:bg-gray-50" data-id="{{ $report->id }}">
                                        <td class="px-6 py-3 text-xs font-semibold text-gray-900 whitespace-nowrap" contenteditable="true" data-field="date">{{ \Carbon\Carbon::parse($report->date)->format('Y-m-d') }}</td>
                                        <td class="px-6 py-2 text-xs text-gray-700" contenteditable="true" data-field="municipality">{{ $report->municipality }}</td>
                                        <td class="px-6 py-2 text-xs text-gray-700" contenteditable="true" data-field="barangay">{{ $report->barangay }}</td>
                                        <td class="px-6 py-2 text-xs text-center text-gray-700" contenteditable="true" data-field="enumeration_area">{{ $report->enumeration_area }}</td>
                                        <td class="px-6 py-2 text-xs text-center text-gray-700" contenteditable="true" data-field="original_bsn">{{ $report->original_bsn }}</td>
                                        <td class="px-6 py-2 text-xs text-center text-gray-700" contenteditable="true" data-field="processed_bsn">{{ $report->processed_bsn }}</td>
                                        <td class="px-6 py-2 text-xs text-gray-700" contenteditable="true" data-field="remarks">{{ $report->remarks ?? 'N/A' }}</td>
                                        <td class="px-6 py-2 text-xs text-gray-700" contenteditable="true" data-field="status">{{ $report->status }}</td>
                                        <td class="px-6 py-2 text-center text-xs text-gray-700">
                                            <div class="flex space-x-2 items-center justify-center">
                                                <div>
                                                    <button class="save-button bg-green-500 hover:bg-green-700 text-white font-bold py-2.5 px-3 rounded-md">
                                                        <i class="fas fa-save"></i>
                                                    </button>
                                                </div>
                                                <div>
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('accomplishment_reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this report?');" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="delete-button flex items-center justify-center bg-red-500 hover:bg-red-700 text-white font-medium py-2.5 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400"
                                                                data-url="{{ route('accomplishment_reports.destroy', $report->id) }}">
                                                            <i class="fas fa-trash"></i>  
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    @endif
                </div>
 
               <!-- Add modal -->
               <div id="add-new-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">
                                Create New Workload
                            </h3>
                            <button id="close-add-new-modal-button" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                       <!-- Modal body -->
                       <form class="p-4 md:p-5" action="{{ route('accomplishment_reports.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="grid gap-4 mb-4 grid-cols-2">
                    
                            <!-- Hidden field for user_id -->
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    
                            <!-- New Fields -->
                            <div class="col-span-2">
                                <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date</label>
                                <input type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                            </div>
                            <div class="col-span-2">
                                <label for="municipality" class="block mb-2 text-sm font-medium text-gray-900">Municipality</label>
                                <input type="text" name="municipality" id="municipality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Municipality" required="">
                            </div>
                            
                            <div class="col-span-2">
                                <label for="barangay" class="block mb-2 text-sm font-medium text-gray-900">Barangay</label>
                                <input type="text" name="barangay" id="barangay" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter barangay" required="">
                            </div>
                            <div class="col-span-2">
                                <label for="enumeration_area" class="block mb-2 text-sm font-medium text-gray-900">Enumeration Area</label>
                                <input type="text" name="enumeration_area" id="enumeration_area" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter enumeration area" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="original_bsn" class="block mb-2 text-sm font-medium text-gray-900">Original BSN</label>
                                <input type="text" name="original_bsn" id="original_bsn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="0000" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="processed_bsn" class="block mb-2 text-sm font-medium text-gray-900">Processed BSN</label>
                                <input type="text" name="processed_bsn" id="processed_bsn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="0000" required="">
                            </div>
                            <div class="col-span-2">
                                <label for="remarks" class="block mb-2 text-sm font-medium text-gray-900">Remarks</label>
                                <textarea id="remarks" name="remarks" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter remarks"></textarea>
                            </div>
                            <div class="col-span-2">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                    <option value="Pending">Pending</option>
                                    <option value="Completed">Completed</option>
                                    <option value="In Progress">In Progress</option>
                                </select>
                            </div>
                    
                        </div>
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Create
                        </button>
                    </form>
                    

                    </div>
                </div>
            </div>
            

               <!-- Success Modal -->
                <div id="successModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
                    <div class="relative p-4 w-full max-w-md">
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Close Button -->
                            <button type="button" class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" id="closeModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>

                            <!-- Modal Content -->
                            <div class="p-4 md:p-5 text-center">
                                <!-- Icon with Circle -->
                                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full">
                                    <i class="fas fa-check text-3xl text-green-600"></i>
                                </div>

                                <h3 class="mb-5 text-lg font-semibold text-gray-700">Success</h3>
                                <p class="text-sm text-gray-500">Row updated successfully!</p>

                                <!-- Action Button -->
                                <button id="closeSuccessModal" type="button" class="mt-5 py-2.5 px-5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg focus:outline-none focus:ring-4 focus:ring-green-300">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


               <!-- Delete Confirmation Modal -->
                <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
                    <div class="relative p-4 w-full max-w-md">
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Close Button -->
                            <button type="button" class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-hide="popup-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>

                            <!-- Modal Content -->
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this report? This action cannot be undone.</h3>

                                <!-- Action Buttons -->
                                <form id="deleteForm" action="" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Yes, I'm sure
                                    </button>
                                </form>

                                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                    No, cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="border-t px-6 py-3">
                    {{ $accomplishment_reports->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<script> 
    document.addEventListener('DOMContentLoaded', function () { 

    // Get modal and button elements
    const modal = document.getElementById('add-new-modal');
        const closeButton = document.getElementById('close-add-new-modal-button');
        const addNewModalBtn = document.getElementById('addNewModalBtn');  // New button to open modal

        // Function to open the modal
        function openModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        // Function to close the modal
        function closeModal() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        // Add event listener to open modal when the "New" button is clicked
        addNewModalBtn.addEventListener('click', openModal);

        // Add event listener to close modal when the close button is clicked
        closeButton.addEventListener('click', closeModal);

        // Optionally, add event listener for clicks outside the modal to close it
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });

        const saveRow = async (row) => {
        const id = row.dataset.id; // Get report ID from data-id
        const fields = {};

        // Iterate through the editable fields and collect their values
        row.querySelectorAll('[contenteditable]').forEach(cell => {
            const field = cell.dataset.field; // Use data-field as the key
            const value = cell.textContent.trim();
            fields[field] = value;
        });

        try {
            const response = await fetch(`/accomplishment-reports/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify(fields)
            });

            if (response.ok) {
            const result = await response.json();
            showSuccessModal(result.message || 'Row updated successfully!');
            } else {
            const error = await response.json();
            alert(error.error || 'Failed to update row!');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while updating the row.');
        }
        };

        // Attach event listener to each Save button
        document.querySelectorAll('.save-button').forEach(button => {
            button.addEventListener('click', (e) => {
                const row = e.target.closest('tr'); // Get the row where the button was clicked
                saveRow(row); // Save the data in the row
            });
        });

        // Function to show the success modal
        const showSuccessModal = (message) => {
            const modal = document.getElementById('successModal');
            const modalMessage = modal.querySelector('p');
            modalMessage.textContent = message;
            modal.classList.remove('hidden'); // Show the modal
        };

        // Close the modal when clicking the close button
        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('successModal').classList.add('hidden');
        });

        // Close the modal when clicking the Close button in the modal
        document.getElementById('closeSuccessModal').addEventListener('click', () => {
            document.getElementById('successModal').classList.add('hidden');
        });
 

        
        // Modal for Delete Workload

        const deleteModal = document.getElementById('popup-modal');   
        const cancelDeleteButtons = document.querySelectorAll('[data-modal-hide="popup-modal"]');   
        const deleteForm = document.getElementById('deleteForm');    
       
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                const deleteUrl = button.getAttribute('data-url');
                deleteForm.setAttribute('action', deleteUrl);   
                deleteModal.classList.remove('hidden');   
            });
        }); 
       
        cancelDeleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                deleteModal.classList.add('hidden');   
            });
        });  
    });
</script>

