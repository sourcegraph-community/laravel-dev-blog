<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>My DEV Blog</title>
    <meta name="description" content="My DEV Blog">
    <meta name="author" content="Sourcegraph">

    <meta property="og:title" content="A headless blog in Laravel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://github.com/sourcegraph-community/laravel-dev-blog">
    <meta property="og:description" content="A demo Laravel blog">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-to-r from-blue-600 via-pink-500 to-purple-900">

    <div class="container text-white mx-auto mt-6">
        <div class="grid grid-cols-3 gap-4">
            <div>
                <h1 class="text-3xl">My DEV Blog: latest posts</h1>
            </div>
            <div class="col-span-2 text-right">
                menu
            </div>
        </div>
    </div>

    <div class="container mx-auto px-10 py-10 bg-gray-100 my-10 text-gray-600 rounded-md shadow-md">
        <div class="grid grid-cols-3 gap-8">
            <div class="col-span-2">
                @foreach ($articles as $article)
                    <div class="mb-10">
                        <img src=@if ($article->frontMatterHas('cover_image'))
                                "{{ $article->frontMatterGet('cover_image') }}"
                             @else "https://picsum.photos/1000/420"
                             @endif alt="Post header image" class="rounded-lg my-4"
                         />
                        <h1 class="text-4xl mb-4">{{ $article->frontMatterGet('title') }}</h1>
                        <p class="text-md">{{ $article->frontMatterGet('description') }}</p>
                        <p>Posted in: <span class="text-gray-700 font-bold">{{ $article->frontMatterGet('tags') }}</span></p>
                    </div>
                @endforeach
            </div>

            <div>
                <img src="https://picsum.photos/100" class="rounded-full mx-auto p-4" alt="avatar"/>
                <p class="text-gray-700 text-xl mb-10">Hi, I'm a demo Laravel application built with Tailwind CSS, pulling content from DEV.to.
                    You can find my code <a class="text-purple-800 font-bold" href="https://github.com/sourcegraph-community/laravel-dev-blog" title="Laravel DEV blog demo on GitHub">here</a> and you can learn more about me <a class="text-purple-800 font-bold" href="https://dev.to/sourcegraph/creating-a-new-laravel-application-with-sail-and-docker-no-php-required-4c2n" title="Getting started with Laravel tutorial series">here</a>.</p>

                <h2 class="text-gray-400 text-2xl">Links</h2>

                <ul class="py-2">
                    <li class="py-2"><a class="px-1 py-2 bg-purple-300" href="https://github.com/sourcegraph-community/laravel-dev-blog">Demo Laravel DEV Blog on GitHub</a></li>
                    <li class="py-2"><a class="px-1 py-2 bg-pink-400" href="https://dev.to/sourcegraph/creating-a-new-laravel-application-with-sail-and-docker-no-php-required-4c2n">Getting started with Laravel on DEV</a></li>
                    <li class="py-2"><a class="px-1 py-2 bg-purple-300" href="https://laravel.com/docs/8.x">Laravel Documentation</a></li>
                    <li class="py-2"><a class="px-1 py-2 bg-pink-400"  href="https://tailwindcss.com/docs/installation">TailwindCSS Documentation</a></li>
                    <li class="py-2"><a class="px-1 py-2 bg-purple-300" href="https://php.net">Official PHP Documentation</a></li>
                    <li class="py-2"><a class="px-1 py-2 bg-pink-400" href="https://sourcegraph.com">Sourcegraph Code Search</a></li>
                </ul>
            </div>
        </div>
    </div>

</body>
</html>
