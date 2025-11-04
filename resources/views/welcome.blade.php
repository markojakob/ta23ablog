<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body>
    <div class="container mx-auto">
        <div class="grid grid-cols-4 gap-2">
            @foreach ($posts as $post)
                <div class="card bg-base-300 shadow-sm">
                    {{-- <figure>
                        <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                            alt="Shoes" />
                    </figure> --}}
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <p>{{ $post->snippet }}</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Buy Now</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
