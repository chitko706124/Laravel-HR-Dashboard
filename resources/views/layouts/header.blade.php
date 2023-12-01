<div class=" header-menu shadow fixed-top z-2 bg-white">
    <div class=" row justify-content-center">
        <div class=" col-md-8">
            <div class=" d-flex justify-content-between align-items-center">
                @if (request()->is('/'))
                    <i class="fa-solid fa-bars open-btn" style="font-size: 20px;cursor: pointer"></i>
                @else
                    <i class="fa fa-angle-left back-btn" style="font-size: 20px;cursor: pointer"></i>
                @endif
                <h5 class=" mb-0">@yield('title')</h5>
                <a href=""></a>
            </div>
        </div>
    </div>
</div>

{{-- <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
</li> --}}
