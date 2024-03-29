<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2/dist/tailwind.min.css">
    <style>
        body {
            background-color: #fff8dc;
        }

        .container {
            background-color: #fffacd;
            padding: 30px;
            border-radius: 8px;
            transform: rotate(0deg);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100vw;
            flex-direction: column;
        }
        .buttons{
            display: flex;
            flex-direction: row;
        }
        #user-lists li {
            padding: 0.3vh;
        }
        .bg-blue-500{
            margin-right: 1vw;
        }


        .bg-gray-500 { background-color: #666; }
        .hover\:bg-gray-700:hover { background-color: #444; }

    </style>
</head>
<body>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Welcome, {{ Auth::check() ? Auth::user()->name : '' }}!</h1>
    <p>Your shopping list awaits.</p>
    <div class="buttons">
        @if (Auth::check())
{{--            <a href="{{ route('logout') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md">Start</a>--}}
            <form method="GET" action="{{ route('shopping-list') }}">
                @csrf
                <button id="start-button" class="bg-blue-500 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md">Start</button>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
            <a class=""></a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-md">Logout</button>
            </form>

        @else
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md">Login</a>
            <a href="{{ route('register') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-medium px-4 py-2 rounded-md ml-2">Signup</a>
        @endif
    </div>
    <div id="user-lists" class="mt-6">
        <h2 class="text-xl font-medium mb-2">Your Shopping Lists</h2>
        <ul class="list-disc">
            @foreach ($userLists as $list)
                <li class="flex items-center justify-between">
                    <form action="/lists/{{$list->share_code}}">
                    <button class="bg-transparent hover:bg-gray-700 text-gray-900 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" style="margin-right: 0.5vw">
                        <b>{{$list->share_code}}</b>
                    </button>
                    </form>
                    <button class="copy-button bg-blue-500 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md" data-url="/lists/{{ $list->share_code }}">Copy Link</button>
                    <form method="POST" action="/lists/{{ $list->id }}/delete" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-md ml-2">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>
    <script defer>
    document.getElementById('start-button').addEventListener('click', function(event) {
        event.preventDefault();

        fetch('/lists/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                // let listId = data.list_id;
                console.log(data);
                let shareCode = data.share_code;
                window.location.href = `/lists/${shareCode}`;
            })
            .catch(error => {
                console.error("Error creating list:", error);
            });
    });

    document.querySelectorAll('.copy-button').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.dataset.url;

            navigator.clipboard.writeText(window.location.origin + url)
                .then(() => {
                    console.log('URL copied!');
                    // Optionally change button appearance for feedback
                })
                .catch(err => {
                    console.error('Could not copy URL: ', err);
                });
        });
    });


    </script>
</body>
</html>
