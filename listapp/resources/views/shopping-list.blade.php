<!DOCTYPE html>
<html>
<head>
    <title>Shopping List</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2/dist/tailwind.min.css">{{-- Or your preferred CSS --}}
    <style>
        body {
            background-color: #fff8dc; /* A slightly warmer yellow */
        }

        .container {
            background-color: #fffacd; /* Light yellow background */
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2); /* Stronger shadow */
            padding: 30px;  /* Increase padding */
            border-radius: 8px; /* Slightly rounded corners */
            transform: rotate(0deg); /* A slight tilt */
        }

        ul.mt-4 {
            list-style: none;
            padding: 0;
        }

        li.flex {
            background-color: #fffacd;
            box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.1);
        }

        .checkmark {
            font-size: 1.2em;
            color: green;
            display: inline; /* Make it an inline element */
            vertical-align: middle; /* Align with the text */
            margin-left: 5px; /* Add a little space after the text */
        }

        .line-through {
            text-decoration: line-through;
        }

        /* The animation */
        @keyframes strikethrough {
            0% { width: 0; opacity: 1; }
            25% { width: 100%; opacity: 1; }
            100% { opacity: 0; }
        }

        /* Add this with the other CSS */
        .line-through span {
            display: inline-block;
            animation: strikethrough 0.5s ease-out;
        }

        #purchased-items h2 {
            color: #666;
        }

        .bg-gray-500 { background-color: #666; }
        .hover\:bg-gray-700:hover { background-color: #444; }
        .inline-block input[type="number"] {
            width: 45px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mx-auto p-6">
    <form action="/" class="mb-4">
        <h1 class="text-3xl font-bold mb-4">Shopping List - {{ $list->share_code }}</h1>
        <button class="bg-green-500 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-md">Home</button>
    </form>
    {{-- Item Add Form --}}
    <form method="POST" action="/lists/{{ $list->share_code }}/items" class="mb-4">
        @csrf
        <input type="hidden" name="list_id" value="{{ $list->share_code }}">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="purchased" value="0">
        <input type="text" name="name" placeholder="Add Item" class="border border-gray-400 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-64 mr-2">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md">Add</button>
        <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-medium px-4 py-2 rounded-md ml-2" onclick="exportItems()">Export</button>
        <input type="file" id="importFile" accept=".json" style="display: none;">
        <button type="button" class="bg-yellow-500 hover:bg-yellow-700 text-white font-medium px-4 py-2 rounded-md ml-2" id="importButton">Import</button>
    </form>

    {{-- Display Shopping Items --}}
    <ul class="mt-4">
        @foreach ($items as $item)
            <li class="flex items-center justify-between p-3 border border-gray-300 rounded-md mb-2" data-item-id="{{ $item->id }}">
            <span class="{{ $item->purchased ? 'line-through text-gray-500' : '' }}">
                {{ $item->name }}
                @if (!$item->purchased)
                <form method="POST" action="/items/{{ $item->id }}/update-quantity" class="inline-block">
                    @method('PATCH')
                    @csrf
                    <input type="number" name="quantity" min="1" value="{{ $item->amount }}" placeholder="{{ $item->quantity }}">
                    <button type="submit">✅</button>
                </form>
                @endif
            </span>
                <div class="flex space-x-2">
                    @if ($item->purchased)
                        <form method="POST" action="/items/{{ $item->id }}/togglePurchased" class="inline-block">
                            @method('PATCH')
                            @csrf
                            <button type="submit">Unmark as Purchased</button>
                        </form>
                    @else
                        {{-- Mark as Purchased Button --}}
                        <form method="POST" action="/items/{{ $item->id }}/togglePurchased" class="inline-block">
                            @method('PATCH')
                            @csrf
                            <button type="submit">Mark as Purchased</button>
                        </form>
                    @endif

                    {{-- Delete functionality remains the same --}}
                    <form method="POST" action="/items/{{ $item->id }}" class="inline-block">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </div>

            </li>
        @endforeach
    </ul>
</div>

<script defer>
    function importItems() {
        const fileInput = document.getElementById('importFile');
        const file = fileInput.files[0];

        if (!file) {
            fileInput.click();
            document.getElementById('importButton').textContent = 'Confirm';
            return;
        }

        const fileReader = new FileReader();

        fileReader.onload = function(event) {
            const jsonData = JSON.parse(event.target.result);
            processImportData(jsonData);
        };

        fileReader.readAsText(file);
    }

    async function processImportData(data) {
        try {
            // Fetch current items for comparison
            const currentItemsResponse = await fetch('/items');
            if (!currentItemsResponse.ok) {
                throw new Error('Could not fetch current items');
            }
            const currentItemsBeforeFilter = await currentItemsResponse.json();
            const currentItems = currentItemsBeforeFilter.filter(item => item.list_id === "{{ $list->share_code }}");

            // Filter imported data to include only new items
            const newItemsToImport = data.filter(importedItem => {
                return !currentItems.some(currentItem => currentItem.name === importedItem.name);
            });

            // Create only the new items
            for (const importedItem of newItemsToImport) {
                await createNewItem(importedItem);
            }

            location.reload(); // Or a more informative message

        } catch (error) {
            console.error('Error during import:', error);
            alert('An error occurred during import. See console for details.');
        }
    }

    async function updateItemQuantity(item, newQuantity, newPurchasedState) {
        try {
            const listExistsResponse = await fetch(`/lists/${item.list_id}`);
            if (!listExistsResponse.ok) {
                console.error('List not found:', item.list_id);
                return;
            }

            const response = await fetch(`/items/${item.id}/update`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: newQuantity, purchased: newPurchasedState })
            });

            if (!response.ok) {
                throw new Error(`Could not update item quantity. Status: ${response.status}`);
            }

        } catch (error) {
            console.error('Error during update:', error);
        }
    }

    async function createNewItem(itemData) {
        console.log(itemData.quantity);
        itemData.quantity = itemData.quantity || 1;
        itemData.list_id = "{{ $list->share_code }}";

        const response = await fetch(`/items`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(itemData)
        });

        if (!response.ok) {
            throw new Error('Could not create item');
        }
    }


    document.getElementById('importButton').addEventListener('click', importItems);
</script>




<script>
    function exportItems() {
        const shareCode = "{{ $list->share_code }}";
        fetch(`/items`)
            .then(response => response.json())
            .then(data => {
                const filteredData = data.filter(item => item.list_id === shareCode);

                const jsonData = JSON.stringify(filteredData);
                const blob = new Blob([jsonData], { type: 'application/json' });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `shopping_list_${shareCode}.json`;
                link.click();
                URL.revokeObjectURL(link.href);
            })
            .catch(error => console.error("Error exporting:", error));
    }
</script>

</body>
</html>
