<div class="navbar bg-base-100 shadow-sm">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul tabindex="-1" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                <li><a>Item 1</a></li>
                <li>
                    <a>Parent</a>
                    <ul class="p-2">
                        <li><a>Submenu 1</a></li>
                        <li><a>Submenu 2</a></li>
                    </ul>
                </li>
                <li><a>Item 3</a></li>
            </ul>
        </div>
        <a href="/" class="btn btn-ghost text-xl">daisyUI</a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1 z-10">
            @foreach (App\Models\Category::where('category_id', null)->get() as $category)
                @include('partials.submenu')
            @endforeach


        @auth
            <li>
                <details>
                    <summary>Admin</summary>
                    <ul class="p-2">
                        <li><a href="{{ route('posts.index') }}">Posts</a></li>
                        <li><a>Submenu 2</a></li>
                    </ul>
                </details>
            </li>
        @endauth

        </ul>
    </div>
    <div class="navbar-end gap-2">
        @auth
            <ul class="menu menu-horizontal px-1">

                <li>
                    <details>
                        <summary>{{ auth()->user()->name }}</summary>
                        <ul class="p-2">
                            <li><a href="{{ route('profile.edit') }}">@lang('Profile')</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button>@lang('Logout')</button>
                                </form>
                            </li>
                        </ul>
                    </details>
                </li>
            </ul>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">@lang('Login')</a>
            <a href="{{ route('register') }}" class="btn btn-success">@lang('Register')</a>
        @endauth
    </div>
</div>
