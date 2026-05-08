<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 10px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #888; border-radius: 10px; }
        
        /* Ensures borders stay visible with sticky headers/columns */
        .sticky-border-fix {
            box-shadow: inset -1px 0 0 #e5e7eb, inset 0 -1px 0 #e5e7eb;
        }

        .inline-edit { 
            width: 100%; 
            padding: 4px;
            font-size: 11px;
        }
        
        .inline-edit:focus { 
            background-color: #eff6ff; 
            outline: none; 
            ring: 1px inset #3b82f6; 
        }

        /* Standard cell borders */
        td, th {
            border-right: 1px solid #000000;
            border-bottom: 1px solid #000000;
            color: #000;
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">

<div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
    <div class="p-4 border-b flex justify-between items-center bg-white">
        <h2 class="text-xl font-bold text-gray-800">Warehouse Master List</h2>
        <span class="text-xs text-gray-400 italic">Click any cell to edit - Auto-saves on change</span>
    </div>

    <div class="overflow-x-auto custom-scrollbar">
        <!-- border-separate is required for sticky borders to work -->
        <table class="w-full text-[11px] text-left text-gray-500 whitespace-nowrap border-separate border-spacing-0">
            <thead class="text-gray-700 uppercase bg-gray-200 sticky top-0 z-30">
                <tr>
                    <th class="px-3 py-2 sticky left-0 bg-gray-200 z-40 border-r-2 border-gray-300">CODE NO.</th>
                    <th class="px-3 py-2">STATUS</th>
                    <th class="px-3 py-2">SELLING PRICE</th>
                    <th class="px-3 py-2">LAST PRICE</th>
                    <th class="px-3 py-2">OWNER NAME</th>
                    <th class="px-3 py-2">OWNER CONTACT</th>
                    <th class="px-3 py-2">CONTACT PERSON</th>
                    <th class="px-3 py-2">CP NUMBER</th>
                    <th class="px-3 py-2">EMAIL</th>
                    <th class="px-3 py-2">FB LINK</th>
                    <th class="px-3 py-2">REFERRER AGENT</th>
                    <th class="px-3 py-2">EXACT ADDRESS</th>
                    <th class="px-3 py-2">VICINITY</th>
                    <th class="px-3 py-2">CITY/MUNI</th>
                    <th class="px-3 py-2">LOT AREA</th>
                    <th class="px-3 py-2">FLOOR AREA</th>
                    <th class="px-3 py-2">DESCRIPTION</th>
                    <th class="px-3 py-2">HANDOVER</th>
                    <th class="px-3 py-2">MODE OF PAYMENT</th>
                    <th class="px-3 py-2">RESERVATION</th>
                    <th class="px-3 py-2">DOWNPAYMENT</th>
                    <th class="px-3 py-2">DP TERMS</th>
                    <th class="px-3 py-2">SELLER EXPENSE</th>
                    <th class="px-3 py-2">BUYER EXPENSE</th>
                    <th class="px-3 py-2">MOVE-IN FEE</th>
                    <th class="px-3 py-2">MISC. FEE</th>
                    <th class="px-3 py-2">REMARKS</th>
                    <th class="px-3 py-2 text-blue-600">EXT PHOTOS</th>
                    <th class="px-3 py-2 text-blue-600">INT PHOTOS</th>
                    <th class="px-3 py-2 text-red-600">VERT VIDEOS</th>
                    <th class="px-3 py-2 text-red-600">HORIZ VIDEOS</th>
                    <th class="px-3 py-2 sticky right-0 bg-gray-200 z-40 border-l-2 border-gray-300 text-center">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($Warehouses as $Warehouse)
                <tr class="bg-white hover:bg-gray-50 transition-colors">
                    <!-- Sticky Code Column -->
                    <td class="px-3 py-2 sticky left-0 bg-white z-20 font-bold text-gray-900 border-r-2 border-gray-300">{{ $Warehouse->code_no }}</td>
                    
                    <!-- Status -->
                    <td class="px-2 py-1 min-w-[200px]"> <!-- Added min-width to fit both -->
                        <div class="flex items-center gap-2"> <!-- Flex container for side-by-side layout -->

                            <!-- First Dropdown (Status) -->
                            <select class="inline-edit border border-gray-200 rounded text-[10px] bg-transparent flex-1" data-id="{{ $Warehouse->id }}" data-column="status">
                                <option value="Completed" {{ $Warehouse->status == 'Incomplete' ? 'selected' : '' }}>Incomplete</option>
                                <option value="Posted" {{ $Warehouse->status == 'Complete' ? 'selected' : '' }}>Complete</option>
                            </select>

                            <!-- Second Dropdown (Price Type or Other Property) -->
                            <select class="inline-edit border border-gray-200 rounded text-[10px] bg-transparent flex-1" data-id="{{ $Warehouse->id }}" data-column="price_type">
                                <option value="Net" {{ $Warehouse->Posted == 'Net' ? 'selected' : '' }}>Posted</option>
                                <option value="Gross" {{ $Warehouse->NotPosted == 'Gross' ? 'selected' : '' }}>Not Posted</option>
                            </select>

                        </div>
                    </td>

                    <!-- Prices & Financials -->
                    <td class="px-1 py-1">
                        <input type="text" 
                               class="inline-edit format-number border-none bg-transparent w-28" 
                               value="{{ number_format($Warehouse->selling_price) }}" 
                               data-id="{{ $Warehouse->id }}" 
                               data-column="selling_price">
                    </td>  
                    <td class="px-1 py-1">
                        <input type="text" 
                               class="inline-edit format-number border-none bg-transparent w-28" 
                               value="{{ number_format($Warehouse->last_price) }}" 
                               data-id="{{ $Warehouse->id }}" 
                               data-column="last_price">
                    </td>                  
                    
                    <!-- Owner Info -->
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->owner_name }}" data-id="{{ $Warehouse->id }}" data-column="owner_name"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->owner_contact }}" data-id="{{ $Warehouse->id }}" data-column="owner_contact"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->contact_person }}" data-id="{{ $Warehouse->id }}" data-column="contact_person"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->cp_number }}" data-id="{{ $Warehouse->id }}" data-column="cp_number"></td>
                    
                    <!-- Contact Info -->
                    <td class="px-1 py-1"><input type="email" class="inline-edit border-none bg-transparent w-40" value="{{ $Warehouse->email }}" data-id="{{ $Warehouse->id }}" data-column="email"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-40" value="{{ $Warehouse->fb_link }}" data-id="{{ $Warehouse->id }}" data-column="fb_link"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->referrer_agent }}" data-id="{{ $Warehouse->id }}" data-column="referrer_agent"></td>

                    <!-- Location Info -->
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-48" value="{{ $Warehouse->exact_address }}" data-id="{{ $Warehouse->id }}" data-column="exact_address"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->vicinity }}" data-id="{{ $Warehouse->id }}" data-column="vicinity"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->city_municipality }}" data-id="{{ $Warehouse->id }}" data-column="city_municipality"></td>

                    <!-- Areas -->
                    <td class="px-1 py-1"><input type="number" class="inline-edit border-none bg-transparent w-20 text-center" value="{{ $Warehouse->lot_area }}" data-id="{{ $Warehouse->id }}" data-column="lot_area"></td>
                    <td class="px-1 py-1"><input type="number" class="inline-edit border-none bg-transparent w-20 text-center" value="{{ $Warehouse->floor_area }}" data-id="{{ $Warehouse->id }}" data-column="floor_area"></td>

                    <!-- Details -->
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-48" value="{{ $Warehouse->description }}" data-id="{{ $Warehouse->id }}" data-column="description"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->condition }}" data-id="{{ $Warehouse->id }}" data-column="condition"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->payment_mode }}" data-id="{{ $Warehouse->id }}" data-column="payment_mode"></td>

                    <!-- More Financials -->
                    <td class="px-1 py-1">
                        <input type="text" 
                            class="inline-edit format-number border-none bg-transparent w-28" 
                            value="{{ number_format($Warehouse->reservation_fee) }}" 
                            data-id="{{ $Warehouse->id }}" 
                            data-column="reservation_fee">
                    </td>
                    <td class="px-1 py-1">
                        <input type="text" 
                            class="inline-edit format-number border-none bg-transparent w-28" 
                            value="{{ number_format($Warehouse->downpayment) }}" 
                            data-id="{{ $Warehouse->id }}" 
                            data-column="downpayment">
                    </td>
                    <td class="px-1 py-1"><input type="number" class="inline-edit border-none bg-transparent w-20 text-center" value="{{ $Warehouse->dp_terms }}" data-id="{{ $Warehouse->id }}" data-column="dp_terms"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-40" value="{{ $Warehouse->seller_expense }}" data-id="{{ $Warehouse->id }}" data-column="seller_expense"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-40" value="{{ $Warehouse->buyer_expense }}" data-id="{{ $Warehouse->id }}" data-column="buyer_expense"></td>
                    <td class="px-1 py-1"><input type="number" step="0.01" class="inline-edit border-none bg-transparent w-24" value="{{ $Warehouse->move_in_fee }}" data-id="{{ $Warehouse->id }}" data-column="move_in_fee"></td>
                    <td class="px-1 py-1"><input type="number" step="0.01" class="inline-edit border-none bg-transparent w-24" value="{{ $Warehouse->misc_fees }}" data-id="{{ $Warehouse->id }}" data-column="misc_fees"></td>

                    <!-- Remarks & Links -->
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-64" value="{{ $Warehouse->remarks }}" data-id="{{ $Warehouse->id }}" data-column="remarks"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->ext_photos }}" data-id="{{ $Warehouse->id }}" data-column="ext_photos"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->int_photos }}" data-id="{{ $Warehouse->id }}" data-column="int_photos"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->v_videos }}" data-id="{{ $Warehouse->id }}" data-column="v_videos"></td>
                    <td class="px-1 py-1"><input type="text" class="inline-edit border-none bg-transparent w-32" value="{{ $Warehouse->h_videos }}" data-id="{{ $Warehouse->id }}" data-column="h_videos"></td>

                    <!-- Sticky Action Column -->
                    <td class="px-3 py-2 sticky right-0 bg-white z-20 border-l-2 border-gray-300 text-center">
                        <a href="{{ route('warehouse.show', $Warehouse->id) }}" class="text-blue-600 font-bold hover:underline">VIEW</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="32" class="p-10 text-center">No data found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
document.querySelectorAll('.inline-edit').forEach(el => {
    el.addEventListener('change', function() {
        // Clean the value: remove commas if it's a price/number field
        const rawValue = this.value.replace(/,/g, '');
        
        const payload = {
            id: this.getAttribute('data-id'),
            column: this.getAttribute('data-column'),
            value: rawValue
        };

        // UI Feedback: Show saving state
        const parentCell = this.closest('td');
        this.style.opacity = '0.5';

        fetch("{{ route('warehouse.updateInline') }}", {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json',
                'Accept': 'application/json', // Tell Laravel we want JSON back
                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
            },
            body: JSON.stringify(payload)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            this.style.opacity = '1';
            // Success: Flash Green
            parentCell.style.backgroundColor = '#dcfce7'; 
            setTimeout(() => parentCell.style.backgroundColor = 'transparent', 800);
        })
        .catch(error => {
            console.error('Error:', error);
            this.style.opacity = '1';
            // Error: Flash Red
            parentCell.style.backgroundColor = '#fee2e2'; 
            alert('Failed to save. Please refresh and try again.');
        });
    });
});
// Function to add commas
function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

document.querySelectorAll('.format-number').forEach(input => {
    // 1. Format on typing
    input.addEventListener('input', function() {
        let selectionStart = this.selectionStart;
        let originalLength = this.value.length;
        
        this.value = formatNumber(this.value);
        
        // Fix cursor position after adding commas
        let newLength = this.value.length;
        this.setSelectionRange(selectionStart + (newLength - originalLength), newLength - originalLength + selectionStart);
    });

    // 2. Modify the save logic
    input.addEventListener('change', function() {
        const rawValue = this.value.replace(/,/g, ''); // Remove commas for DB
        
        const payload = {
            id: this.getAttribute('data-id'),
            column: this.getAttribute('data-column'),
            value: rawValue // Send the clean number (25000000)
        };

        // Your existing Fetch/AJAX code here...
        fetch("{{ route('warehouse.updateInline') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify(payload)
        });
    });
});
</script>
</body>
</html>