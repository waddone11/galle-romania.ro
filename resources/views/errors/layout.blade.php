<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>@yield('code') — Galle Silva</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    {{-- Inline critical CSS: error pages must render even if compiled assets fail. --}}
    <style>
        :root { --forest:#024846; --forest-dark:#013634; --mint:#28eeaf; --mist:#f2f2ef; }
        * { box-sizing: border-box; }
        body {
            margin: 0; min-height: 100vh; display: grid; place-items: center;
            background: var(--forest); color: var(--mist);
            font-family: ui-sans-serif, system-ui, "Segoe UI", Roboto, sans-serif;
            padding: 2rem; text-align: center;
        }
        .wrap { max-width: 32rem; }
        .code { font-size: clamp(4rem, 18vw, 8rem); font-weight: 800; line-height: 1; color: var(--mint); letter-spacing: -0.03em; }
        h1 { font-size: 1.6rem; margin: 0.5rem 0 0.75rem; font-weight: 700; }
        p { color: rgba(242,242,239,0.7); line-height: 1.6; margin: 0 0 2rem; }
        .actions { display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; }
        a.btn {
            display: inline-flex; align-items: center; border-radius: 9999px;
            padding: 0.7rem 1.6rem; font-weight: 600; text-decoration: none; font-size: 0.95rem;
        }
        a.primary { background: var(--mint); color: var(--forest-dark); }
        a.ghost { border: 1px solid rgba(242,242,239,0.3); color: var(--mist); }
        a.btn:focus-visible { outline: 2px solid var(--mint); outline-offset: 2px; }
        .brand { margin-top: 3rem; font-size: 0.8rem; color: rgba(242,242,239,0.45); }
        .brand b { color: var(--mist); }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="code">@yield('code')</div>
        <h1>@yield('title')</h1>
        <p>@yield('message')</p>
        <div class="actions">
            <a class="btn primary" href="/">Inapoi acasa</a>
            <a class="btn ghost" href="/contact">Contact</a>
        </div>
        <div class="brand">Galle <b>Silva</b> — partener local Galle GmbH Germania</div>
    </div>
</body>
</html>
