<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Admin Login – MRCGP Portal' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        body { font-family: 'Inter', 'Segoe UI', system-ui, sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%); }
        .glass-card { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.12); }
        input:focus { outline: none; }
    </style>
</head>

<body class="min-h-screen gradient-bg flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        {{ $slot }}
    </div>

    <script>
        const toggleBtn = document.getElementById('toggle-pw');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                const pw = document.getElementById('password');
                const icon = document.getElementById('eye-icon');

                if (pw.type === 'password') {
                    pw.type = 'text';
                    icon.className = 'ri-eye-off-line text-lg';
                } else {
                    pw.type = 'password';
                    icon.className = 'ri-eye-line text-lg';
                }
            });
        }
    </script>
</body>
</html>