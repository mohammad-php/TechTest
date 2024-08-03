<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechTest Landing Page</title>
    @vite(['resources/sass/app.scss'])
</head>
<body>
<div class="landing-page">
    <h1 class="landing-page__header">Welcome to TechTest</h1>
    <p class="landing-page__description">Choose a section to explore:</p>
    <ul class="landing-page__nav-list">
        <li class="landing-page__nav-list__item">
            <a class="landing-page__nav-list__item__link" target="_blank" href="{{ env('APP_URL').'/docs'  }}">API Docs</a>
        </li>
        <li class="landing-page__nav-list__item">
            <a class="landing-page__nav-list__item__link" target="_blank" href="{{ route('articles.page.index') }}">Articles List Page</a>
        </li>
        <li class="landing-page__nav-list__item">
            <a class="landing-page__nav-list__item__link" target="_blank" href="{{ route('fibonacci.basic.recursive', ['n' => 3]) }}">
                Fibonacci Basic Recursive Of N = 3
            </a>
        </li>
        <li class="landing-page__nav-list__item">
            <a class="landing-page__nav-list__item__link" target="_blank" href="{{ route('fibonacci.basic.recursive', ['n' => 20]) }}">
                Fibonacci Basic Recursive Of N = 20
            </a>
        </li>
        <li class="landing-page__nav-list__item">
            <a class="landing-page__nav-list__item__link" target="_blank" href="{{ route('fibonacci.optimized.memoization', ['n' => 3]) }}">
                Fibonacci Optimized Memoization Of N = 3
            </a>
        </li>
        <li class="landing-page__nav-list__item">
            <a class="landing-page__nav-list__item__link" target="_blank" href="{{ route('fibonacci.optimized.memoization', ['n' => 20]) }}">
                Fibonacci Optimized Memoization Of N = 20
            </a>
        </li>
    </ul>
</div>
</body>
</html>
