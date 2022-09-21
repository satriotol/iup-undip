<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('dashboard.index') }}">
                <img src="{{ asset('assets/images/brand/logo.png') }}" class="header-brand-img desktop-logo"
                    alt="logo">
                <img src="{{ asset('assets/images/brand/logo-1.png') }}" class="header-brand-img toggle-logo"
                    alt="logo">
                <img src="{{ asset('assets/images/brand/logo-2.png') }}" class="header-brand-img light-logo"
                    alt="logo">
                <img src="{{ asset('assets/images/brand/logo-3.png') }}" class="header-brand-img light-logo1"
                    alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ active_class(['dashboard.index']) }}" data-bs-toggle="slide"
                        href="{{ route('dashboard.index') }}"><i class="side-menu__icon fe fe-home"></i><span
                            class="side-menu__label">Dashboard</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ active_class(['mahasiswa.*']) }}" data-bs-toggle="slide"
                        href="{{ route('mahasiswa.index') }}"><i class="side-menu__icon fe fe-users"></i><span
                            class="side-menu__label">Mahasiswa</span></a>
                </li>
                <li class="sub-category">
                    <h3>Master Data</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ active_class(['major.*']) }}" data-bs-toggle="slide"
                        href="{{ route('major.index') }}"><i class="side-menu__icon fe fe-award"></i><span
                            class="side-menu__label">Fakultas</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ active_class(['batch.*']) }}" data-bs-toggle="slide"
                        href="{{ route('batch.index') }}"><i class="side-menu__icon fe fe-calendar"></i><span
                            class="side-menu__label">Batch</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ active_class(['country.*']) }}" data-bs-toggle="slide"
                        href="{{ route('country.index') }}"><i class="side-menu__icon fe fe-flag"></i><span
                            class="side-menu__label">Negara</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ active_class(['semester.*']) }}" data-bs-toggle="slide"
                        href="{{ route('semester.index') }}"><i class="side-menu__icon fe fe-calendar"></i><span
                            class="side-menu__label">Semester</span></a>
                </li>
                <li class="sub-category">
                    <h3>User Management</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ active_class(['admin.*']) }}" data-bs-toggle="slide"
                        href="{{ route('admin.index') }}"><i class="side-menu__icon fe fe-user"></i><span
                            class="side-menu__label">Admin</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ active_class(['role.*']) }}" data-bs-toggle="slide"
                        href="{{ route('role.index') }}"><i class="side-menu__icon fe fe-user-check"></i><span
                            class="side-menu__label">Role</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ active_class(['permission.*']) }}" data-bs-toggle="slide"
                        href="{{ route('permission.index') }}"><i class="side-menu__icon fe fe-user-check"></i><span
                            class="side-menu__label">Permission</span></a>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
</div>
