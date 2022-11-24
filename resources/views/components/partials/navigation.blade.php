
<nav class="navbar w-full bg-white">
    <div class="container-lg px-0">
        <div class="flex w-full items-center">
        <a class="nav-brand mr-auto ml-0 text-3xl text-green-600" href="#">Material Tailwind Navbar</a>
        <button
            navbar-trigger=""
            class="navbar-trigger ml-auto mr-0 mb-0 lg:hidden xl:hidden"
            type="button"
            aria-controls="navigation"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-trigger-icon">
            <span bar1="" class="navbar-trigger-bar mt-1"
                ><span class="hidden origin-[10%_10%] rotate-45"></span
            ></span>
            <span bar2="" class="bar2 navbar-trigger-bar mt-2"></span>
            <span bar3="" class="bar3 navbar-trigger-bar mt-2"
                ><span
                class="mt-mt-[0.4375rem] hidden origin-[10%_90%] -rotate-45"
                ></span
            ></span>
            </span>
        </button>
        </div>
        <div class="collapse navbar-collapse" navbar-menu="">
        <ul class="navbar-nav">
            <li>
            <a class="nav-link" aria-current="page" href="{{ url('/') }}">
                <i class="material-icons mr-2 text-base opacity-60">article</i>
                <span>Home</span>
            </a>
            </li>
            <li>
            <a class="nav-link" href="#">
                <i class="material-icons mr-2 text-base opacity-60">apps</i>
                <span>About</span>
            </a>
            </li>
            <li class="flex">
                <a class="nav-link" href="#">
                    <i class="material-icons mr-2 text-base opacity-60">view_carousel</i>
                    <span>Blog</span>
                </a>
            </li>
            @auth
            <li>
                <x-dropdown-admin />
            </li>
            @else
            <li>
                <a class="nav-link" href="#">
                    <i class="fab fa-github mr-2 text-base opacity-60"></i>
                    <span>Sign In</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="#">
                    <i class="fab fa-github mr-2 text-base opacity-60"></i>
                    <span>Sign Up</span>
                </a>
            </li>
            @endauth
        </ul>
        </div>
    </div>
</nav>
