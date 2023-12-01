<div class="main-container d-flex">
    <div style="z-index: 100;" class="sidebar" id="side_nav">
        <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
            <h1 class=" text-white">Ninja HR</h1>
            <button class="btn d-block d-xl-none close-btn px-1 py-0 text-white"><i
                    style="font-size: 20px;cursor: pointer" class="fa-solid fa-xmark"></i></button>

            {{-- <i class="fa-solid fa-xmark d-xl-none close-btn"></i> --}}
        </div>


        <ul class="list-unstyled px-2">
            <li class="@yield('home')"><a href="{{ route('home') }}"
                    class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-home"></i> Home</a></li>


            @can('view_employee')
                <li class="@yield('employee')"><a href="{{ route('employees.index') }}"
                        class="text-decoration-none px-3 py-2 d-block">
                        <i class="fa-solid fa-users"></i> Employees</a></li>
            @endcan


            @can('view_department')
                <li class="@yield('department')"><a href="{{ route('department.index') }}"
                        class="text-decoration-none px-3 py-2 d-block">
                        <i class="fa-solid fa-network-wired"></i> Department</a></li>
            @endcan


            @can('view_role')
                <li class="@yield('role')"><a href="{{ route('role.index') }}"
                        class="text-decoration-none px-3 py-2 d-block">
                        <i class="fa-solid fa-user-shield"></i> Role</a></li>
            @endcan


            @can('view_permission')
                <li class="@yield('permission')"><a href="{{ route('permission.index') }}"
                        class="text-decoration-none px-3 py-2 d-block">
                        <i class="fa-solid fa-shield"></i> Permission</a></li>
            @endcan


            @can('view_company_setting')
                <li class="@yield('companySetting')"><a href="{{ route('company-setting.show', 1) }}"
                        class="text-decoration-none px-3 py-2 d-block">
                        <i class="fa-regular fa-building"></i> Company Setting</a></li>
            @endcan











            <li class=""><a href="#"
                    class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                    <span><i class="fal fa-comment"></i> Messages</span>
                    <span class="bg-dark rounded-pill text-white py-0 px-2">02</span>
                </a>
            </li>
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
                        class="fal fa-envelope-open-text"></i> Services</a></li>
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
                        class="fal fa-users"></i>
                    Customers</a></li>
        </ul>
        <hr class="h-color mx-2">

        <ul class="list-unstyled px-2">
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
                        class="fal fa-bars"></i>
                    Settings</a></li>
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
                        class="fal fa-bell"></i>
                    Notifications</a></li>

        </ul>

    </div>
</div>
