<link rel="stylesheet" href="../../assets/css/style.css">
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/theme-switcher.js"></script>
<script src="../../assets/js/main.js" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
            <!-- Language dropdown -->
            <div class="nav-item dropdown ms-2">
                <button class="btn btn-link nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Language Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-world" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                        <path d="M3.6 9h16.8" />
                        <path d="M3.6 15h16.8" />
                        <path d="M11.5 3a17 17 0 0 0 0 18" />
                        <path d="M12.5 3a17 17 0 0 1 0 18" />
                    </svg>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="changeLanguage('en'); return false;">English</a></li>
                    <li><a class="dropdown-item" href="#" onclick="changeLanguage('es'); return false;">Español</a></li>
                </ul>
            </div>

            <!-- Theme switcher -->
            <button class="btn btn-link nav-link ms-2" id="theme-switcher" aria-label="Toggle Theme">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-sun icon-tabler icon-tabler-sun" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="12" r="4" />
                    <path d="M3 12h1m16 0h1" />
                    <path d="M12 3v1m0 16v1" />
                    <path d="M5.6 5.6l.7 .7m12.1 12.1l.7 .7" />
                    <path d="M18.4 5.6l-.7 .7m-12.1 12.1l-.7 .7" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-moon icon-tabler icon-tabler-moon d-none" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                </svg>
            </button>
        </div>
    </div>
</nav>

