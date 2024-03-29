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
            color: #666; /* Slightly subdued text color */
        }

        .bg-gray-500 { background-color: #666; } /* Basic gray color */
        .hover\:bg-gray-700:hover { background-color: #444; }

    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Shopping List - {{ $list->share_code }}</h1>

    {{-- Item Add Form --}}
    <form method="POST" action="/lists/{{ $list->share_code }}/items" class="mb-4">
        @csrf
        <input type="hidden" name="list_id" value="{{ $list->share_code }}">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="purchased" value="0">
        <input type="text" name="name" placeholder="Add Item" class="border border-gray-400 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-64 mr-2">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md">Add</button>
        <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-medium px-4 py-2 rounded-md ml-2" onclick="exportItems()">Export</button>
    </form>

    {{-- Display Shopping Items --}}
    <ul class="mt-4">
        @foreach ($items as $item)
            <li class="flex items-center justify-between p-3 border border-gray-300 rounded-md mb-2" data-item-id="{{ $item->id }}">
            <span class="{{ $item->purchased ? 'line-through text-gray-500' : '' }}">
                {{ $item->name }}
            </span>
                <div class="flex space-x-2">
                    @if ($item->purchased)
                        {{-- Unmark as Purchased Button --}}
                        <form method="POST" action="/items/{{ $item->id }}" class="inline-block">
                            @method('PATCH')
                            @csrf
                            <button type="submit">Unmark as Purchased</button>
                        </form>
                    @else
                        {{-- Mark as Purchased Button --}}
                        <form method="POST" action="/items/{{ $item->id }}" class="inline-block">
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

<script>
    function exportItems() {
        fetch('/items')
            .then(response => response.json())
            .then(data => {
                const jsonData = JSON.stringify(data);
                const blob = new Blob([jsonData], { type: 'application/json' });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'shopping_list.json';
                link.click(); // Trigger download
                URL.revokeObjectURL(link.href); // Clean up
            })
            .catch(error => console.error("Error exporting:", error));
    }
</script>

</body>
</html>
