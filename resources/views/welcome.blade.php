<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark light">
    <title>{{ config('app.name', 'LaraGram') }}</title>
    <link rel="icon" type="image/svg+xml"
          href="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22156%22%20height%3D%22156%22%20viewBox%3D%220%200%20156%20156%22%3E%3Cpath%20d%3D%22M0%200%20C-0.99%203.3%20-1.98%206.6%20-3%2010%20C-5.44%209.26%20-5.44%209.26%20-7.94%208.5%20C-20.83%205.3%20-34.45%205.58%20-46.19%2012.19%20C-54.16%2017.58%20-58.58%2024.77%20-61.59%2033.75%20C-63.27%2042.89%20-63.02%2053.56%20-59%2062%20C-56.05%2068.61%20-53.73%2071.72%20-50%2075%20C-40.38%2082.3%20-33.22%2083.18%20-24.56%2083.19%20C-19.16%2083.24%20-19.16%2083.24%20-10%2081%20C-9.67%2071.43%20-9.34%2061.86%20-9%2052%20C-15.27%2052%20-21.54%2052%20-28%2052%20C-28%2048.7%20-28%2045.4%20-28%2042%20C-17.77%2042%20-7.54%2042%203%2042%20C3.67%2067.59%203.67%2067.59%20-0.91%2093.84%20C-4.27%2096.66%20-7.68%2099.69%20-11.04%20103.13%20C-14.38%20106.46%20-17.79%20109.85%20-25%20117%20C-31.96%20112.31%20-36.2%20108.02%20-45.98%2098.2%20C-56.7%2087.39%20-65.35%2077.58%20-74%2061%20C-77.37%2043.38%20-76.17%2028.91%20-67.67%2016.2%20C-59.85%205.9%20-48.84%20-0.82%20-36%20-3%20C-22.66%20-5.14%20-10.91%20-3.48%200%200%20Z%22%20fill%3D%22%23FE0102%22%20transform%3D%22translate(108%2C15)%22%2F%3E%3Cpath%20d%3D%22M0%200%20C9.7%208.64%2018.59%2017.38%2032.31%2030.75%20C41.29%2040.42%2050.62%2049.72%2060%2059%20C66.59%2054.62%2071.62%2049.42%2082.5%2038.28%20C86.5%2034.17%2088.35%2032.38%2092%2032%20C93.65%2033.98%2095.3%2035.96%2097%2038%20C88.32%2047.81%2077.28%2058.8%2060%2076%20C50.9%2068.04%2040.91%2058.02%2024.24%2041.31%20C16.98%2034.03%206.23%2023.26%20-8%209%20C-4.05%204.37%20-2.39%202.44%200%200%20Z%22%20fill%3D%22%230288FE%22%20transform%3D%22translate(21%2C72)%22%2F%3E%3C%2Fsvg%3E">
    <style>
        :root {
            --ink: #0a0d13; --surface: #10141d; --surface-2: #141926;
            --line: #1e2635; --line-soft: #1a212e;
            --text: #eef1f7; --muted: #8b93a6; --faint: #5b6474;
            --blue: #2aabee; --blue-2: #229ed9; --blue-deep: #1c7fb0;
            --red: #f0473e; --green: #35d07f;
            --glow: rgba(42,171,238,.55);
        }
        @media (prefers-color-scheme: light) {
            :root {
                --ink: #f3f5f9; --surface: #ffffff; --surface-2: #f7f9fc;
                --line: #e4e8f0; --line-soft: #eef1f6;
                --text: #101521; --muted: #5c6675; --faint: #97a0b0;
                --glow: rgba(34,158,217,.28);
            }
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; }
        body {
            background: var(--ink); color: var(--text);
            font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            -webkit-font-smoothing: antialiased; line-height: 1.5;
            min-height: 100dvh; display: flex; flex-direction: column;
            position: relative; overflow-x: hidden;
        }
        body::before {
            content: ""; position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image:
                radial-gradient(circle at 1px 1px, color-mix(in srgb, var(--muted) 22%, transparent) 1px, transparent 0);
            background-size: 26px 26px;
            -webkit-mask-image: radial-gradient(120% 80% at 50% -10%, #000 0%, transparent 72%);
            mask-image: radial-gradient(120% 80% at 50% -10%, #000 0%, transparent 72%);
            opacity: .5;
        }
        body::after {
            content: ""; position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background:
                radial-gradient(680px 380px at 50% -6%, var(--glow), transparent 70%),
                radial-gradient(520px 320px at 88% 108%, color-mix(in srgb, var(--red) 30%, transparent), transparent 72%);
            opacity: .8;
        }
        .wrap { position: relative; z-index: 1; width: 100%; max-width: 1080px; margin: 0 auto; padding: 32px 24px 40px; flex: 1; display: flex; flex-direction: column; }

        .topbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; }
        .brand { display: flex; align-items: center; gap: 11px; }
        .brand .mark { width: 30px; height: 30px; display: grid; place-items: center; }
        .brand .mark svg { width: 100%; height: 100%; filter: drop-shadow(0 2px 8px rgba(2,136,254,.35)); }
        .brand .name { font-weight: 680; font-size: 16px; letter-spacing: -.01em; }
        .brand .name b { color: var(--blue); font-weight: 680; }
        .chips { display: flex; gap: 8px; }
        .chip {
            display: inline-flex; align-items: center; gap: 7px;
            font-family: ui-monospace, "SF Mono", "JetBrains Mono", Menlo, Consolas, monospace;
            font-size: 11.5px; letter-spacing: .02em;
            color: var(--muted); background: var(--surface); border: 1px solid var(--line);
            padding: 6px 11px; border-radius: 8px;
        }
        .chip b { color: var(--text); font-weight: 600; }
        .chip .live { width: 6px; height: 6px; border-radius: 50%; background: var(--green); box-shadow: 0 0 0 3px color-mix(in srgb, var(--green) 22%, transparent); }

        .hero { flex: 1; display: flex; flex-direction: column; justify-content: center; padding: 56px 0 40px; }
        .eyebrow {
            display: inline-flex; align-items: center; gap: 9px; align-self: flex-start;
            font-family: ui-monospace, "SF Mono", Menlo, monospace; font-size: 12px;
            letter-spacing: .14em; text-transform: uppercase; color: var(--blue);
            padding: 7px 13px; border: 1px solid color-mix(in srgb, var(--blue) 32%, var(--line));
            border-radius: 999px; background: color-mix(in srgb, var(--blue) 8%, transparent);
        }
        h1 {
            margin-top: 22px; font-size: clamp(38px, 7vw, 76px); line-height: .98;
            font-weight: 720; letter-spacing: -.03em; text-wrap: balance; max-width: 15ch;
        }
        h1 .grad {
            background: linear-gradient(115deg, var(--blue) 10%, var(--blue-deep) 55%, var(--red) 130%);
            -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;
        }
        .lede { margin-top: 22px; font-size: clamp(16px, 2vw, 19px); color: var(--muted); max-width: 56ch; }

        .actions { margin-top: 34px; display: flex; flex-wrap: wrap; gap: 12px; }
        .btn {
            display: inline-flex; align-items: center; gap: 9px; text-decoration: none;
            font-size: 14.5px; font-weight: 600; padding: 12px 20px; border-radius: 11px;
            transition: transform .12s ease, box-shadow .2s ease, background .2s ease, border-color .2s ease;
        }
        .btn svg { width: 16px; height: 16px; }
        .btn-primary { color: #fff; background: linear-gradient(135deg, var(--blue), var(--blue-2)); box-shadow: 0 8px 24px -8px var(--glow); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 14px 30px -10px var(--glow); }
        .btn-ghost { color: var(--text); background: var(--surface); border: 1px solid var(--line); }
        .btn-ghost:hover { transform: translateY(-2px); border-color: color-mix(in srgb, var(--blue) 45%, var(--line)); }

        .grid { margin-top: 8px; display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; }
        @media (max-width: 860px) { .grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 480px) { .grid { grid-template-columns: 1fr; } .chips { display: none; } }
        .card {
            position: relative; background: var(--surface); border: 1px solid var(--line);
            border-radius: 14px; padding: 20px 18px; overflow: hidden;
            transition: transform .15s ease, border-color .2s ease;
        }
        .card:hover { transform: translateY(-3px); border-color: color-mix(in srgb, var(--blue) 40%, var(--line)); }
        .card::before {
            content: ""; position: absolute; top: 10px; right: 10px; width: 14px; height: 14px;
            border-top: 1.5px solid color-mix(in srgb, var(--blue) 55%, transparent);
            border-right: 1.5px solid color-mix(in srgb, var(--blue) 55%, transparent);
            border-top-right-radius: 4px; opacity: .6;
        }
        .card .ic { width: 34px; height: 34px; border-radius: 9px; display: grid; place-items: center; background: color-mix(in srgb, var(--blue) 12%, transparent); color: var(--blue); margin-bottom: 14px; }
        .card .ic svg { width: 18px; height: 18px; }
        .card h3 { font-size: 15px; font-weight: 640; letter-spacing: -.01em; }
        .card p { margin-top: 6px; font-size: 13px; color: var(--muted); line-height: 1.45; }
        .card.red .ic { background: color-mix(in srgb, var(--red) 12%, transparent); color: var(--red); }
        .card.red::before { border-color: color-mix(in srgb, var(--red) 55%, transparent); }

        footer { position: relative; z-index: 1; border-top: 1px solid var(--line-soft); }
        .foot { max-width: 1080px; margin: 0 auto; padding: 18px 24px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;
            font-family: ui-monospace, "SF Mono", Menlo, monospace; font-size: 12px; color: var(--faint); }
        .foot a { color: var(--muted); text-decoration: none; }
        .foot a:hover { color: var(--blue); }
        .foot .dot { opacity: .4; }

        @media (prefers-reduced-motion: reduce) { .btn, .card { transition: none; } }
    </style>
</head>
<body>
<div class="wrap">
    <div class="topbar">
        <div class="brand">
                <span class="mark">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 156 156">
                        <path fill="#FE0102" transform="translate(108,15)" d="M0 0 C-0.99 3.3 -1.98 6.6 -3 10 C-5.44 9.26 -5.44 9.26 -7.94 8.5 C-20.83 5.3 -34.45 5.58 -46.19 12.19 C-54.16 17.58 -58.58 24.77 -61.59 33.75 C-63.27 42.89 -63.02 53.56 -59 62 C-56.05 68.61 -53.73 71.72 -50 75 C-40.38 82.3 -33.22 83.18 -24.56 83.19 C-19.16 83.24 -19.16 83.24 -10 81 C-9.67 71.43 -9.34 61.86 -9 52 C-15.27 52 -21.54 52 -28 52 C-28 48.7 -28 45.4 -28 42 C-17.77 42 -7.54 42 3 42 C3.67 67.59 3.67 67.59 -0.91 93.84 C-4.27 96.66 -7.68 99.69 -11.04 103.13 C-14.38 106.46 -17.79 109.85 -25 117 C-31.96 112.31 -36.2 108.02 -45.98 98.2 C-56.7 87.39 -65.35 77.58 -74 61 C-77.37 43.38 -76.17 28.91 -67.67 16.2 C-59.85 5.9 -48.84 -0.82 -36 -3 C-22.66 -5.14 -10.91 -3.48 0 0 Z"/>
                        <path fill="#0288FE" transform="translate(21,72)" d="M0 0 C9.7 8.64 18.59 17.38 32.31 30.75 C41.29 40.42 50.62 49.72 60 59 C66.59 54.62 71.62 49.42 82.5 38.28 C86.5 34.17 88.35 32.38 92 32 C93.65 33.98 95.3 35.96 97 38 C88.32 47.81 77.28 58.8 60 76 C50.9 68.04 40.91 58.02 24.24 41.31 C16.98 34.03 6.23 23.26 -8 9 C-4.05 4.37 -2.39 2.44 0 0 Z"/>
                    </svg>
                </span>
            <span class="name">Lara<b>Gram</b></span>
        </div>
        <div class="chips">
            <span class="chip"><span class="live"></span> RUNNING</span>
            <span class="chip">v<b>{{ app()->version() }}</b></span>
            <span class="chip">PHP <b>{{ PHP_VERSION }}</b></span>
        </div>
    </div>

    <div class="hero">
        <h1><span class="grad">Hello LaraGram!</span></h1>
        <p class="lede">
            LaraGram is an expressive, elegant framework for the entire Telegram ecosystem;
            write bots, Mini&nbsp;Apps (TMA) and MTProto clients with the same fluent, batteries-included toolkit.
        </p>

        <div class="actions">
            <a class="btn btn-primary" href="https://laraxgram.githib.io" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v12H5.2L4 17.2V4z"/><path d="M8 9h8M8 12h5"/></svg>
                Read the docs
            </a>
            <a class="btn btn-ghost" href="https://github.com/laraxgram" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-3.16 19.49c.5.09.68-.22.68-.48v-1.7c-2.78.6-3.37-1.34-3.37-1.34-.45-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.9 1.53 2.36 1.09 2.94.83.09-.65.35-1.09.63-1.34-2.22-.25-4.55-1.11-4.55-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02a9.6 9.6 0 0 1 5 0c1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.68-4.57 4.93.36.31.68.92.68 1.86v2.75c0 .27.18.58.69.48A10 10 0 0 0 12 2z"/></svg>
                GitHub
            </a>
        </div>
    </div>

    <div class="grid">
        <div class="card">
            <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="7" width="16" height="12" rx="3"/><path d="M12 7V4M9 13h.01M15 13h.01M8 3h8"/></svg></div>
            <h3>Bots</h3>
            <p>Fluent listeners, keyboards, conversations and full Bot API coverage.</p>
        </div>
        <div class="card">
            <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="3" width="12" height="18" rx="3"/><path d="M11 18h2"/></svg></div>
            <h3>Mini Apps</h3>
            <p>TMA &amp; SPA support — auth, sessions and native Telegram bridges.</p>
        </div>
        <div class="card">
            <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v18"/><path d="M4 7l8-4 8 4"/><path d="M4 7v10l8 4 8-4V7"/></svg></div>
            <h3>MTProto Clients</h3>
            <p>Drive full user-account clients with the same expressive API.</p>
        </div>
        <div class="card red">
            <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 4 14h7l-1 8 9-12h-7l1-8z"/></svg></div>
            <h3>Batteries included</h3>
            <p>Routing, ORM, queues, cache, anti-flood, proxy pool and Surge async.</p>
        </div>
    </div>
</div>

<footer>
    <div class="foot">
        <span>© {{ date('Y') }} LaraGram <span class="dot">·</span> The LaraGram framework</span>
        <span>
                <a href="https://github.com/laraxgram" target="_blank" rel="noopener">github.com/laraxgram</a>
                <span class="dot">·</span> LARAGRAM {{ app()->version() }}
            </span>
    </div>
</footer>
</body>
</html>
