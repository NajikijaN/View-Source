<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewSource</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/styles/vs2015.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="app-shell">
        <section class="source-card">
            <h1>
                View <a href="/" style="color: #f2a6b8"> Source Code</a> 
                & Analyze Any Website
            </h1>
            <p>
                Instantly view source code, detect 100+ technologies, and get comprehensive SEO analysis. Smart insights reveal meta tags, structured data, security indicators, frameworks, and more.
            </p>
            <form action="{{ route('viewsource.post') }}" method="POST" class="source-form">
                @csrf
                <div class="input-row">
                    <div class="input-prefix">https://</div>
                    <input type="text" id="url" name="url" placeholder="example.com" value="{{ old('url', request('url')) }}" required>
                    <button type="submit">Bekijk broncode →</button>
                </div>
            </form>

            @isset($source)
                <section class="source-result" aria-live="polite">
                    <div class="source-header">
                        <h2>{{ $url }}</h2>
                    </div>
                    <pre><code class="language-html">{{ $source }}</code></pre>
                </section>
            @endisset
        </section>
    </main>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/highlight.min.js"></script>
<script>hljs.highlightAll();</script>
</html>