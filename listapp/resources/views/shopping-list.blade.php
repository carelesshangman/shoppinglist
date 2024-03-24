<!DOCTYPE html>
<html>
<head>
    <title>Shopping List</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2/dist/tailwind.min.css">{{-- Or your preferred CSS --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mx-auto">
    <h1>Shopping List</h1>

    {{-- Item Add Form - Placeholder for now, you'll need to fill this in --}}
    <form method="POST" action="/items">
        @csrf
        <input type="text" name="name" placeholder="Add Item">
        <button type="submit">Add</button>
    </form>
    <form method="POST" action="/items/14">
        @method('DELETE')
        @csrf
        <button type="submit">Test Delete (Form)</button>
    </form>

    {{-- Display Shopping Items --}}
    <ul class="mt-4">
        @foreach ($items as $item)
            <li class="flex items-center justify-between" data-item-id="{{ $item->id }}">
                <span>{{ $item->name }} - {{ $item->purchased ? 'Purchased' : 'Pending' }}</span>

                <div>
                    {{-- Update (Mark as Purchased) Functionality --}}
                    <button type="button" onclick="markAsPurchased({{ $item->id }})">Mark as Purchased</button>
                    {{-- Delete Functionality  --}}
                    <form method="POST" action="/items/{{ $item->id }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
{{--                    <button type="button" onclick="deleteItem({{ $item->id }})">Delete</button>--}}
                </div>
            </li>
        @endforeach
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function markAsPurchased(itemId) {
        fetch(`/items/${itemId}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
            .then(response => {
                if (response.ok) {
                    // Handle successful update (e.g., visually update the item in the list)
                    const itemElement = document.querySelector(`[data-item-id="${itemId}"]`);
                    itemElement.querySelector('span').textContent = `${itemElement.querySelector('span').textContent.split(' - ')[0]} - Purchased`;
                } else {
                    // Handle error
                    console.error("Error marking item as purchased");
                }
            })
            .catch(error => console.error("Error:", error));
    }

    function deleteItem(itemId) {
        fetch(`/items/${itemId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json' // Indicate JSON body
            },
            body: JSON.stringify({ // Convert to JSON
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            })
        })
            .then(response => {
                if (response.ok) {
                    // Item deleted successfully. Remove from DOM:
                    const itemElement = document.querySelector(`[data-item-id="${itemId}"]`);
                    itemElement.remove();
                } else {
                    console.error('Error deleting item');
                }
            })
            .catch(error => console.error("Error:", error));
    }

</script>
</body>
</html>
