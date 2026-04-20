<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Master Utama</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @php $level = auth()->user()->level->name; @endphp

        <li class="nav-heading">Master Data</li>


        @if($level == 'Administrator')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('user*') ? '' : 'collapsed' }}" href="{{ route('user.index') }}">
                <i class="bi bi-person"></i>
                <span>User</span>
            </a>
        </li><!-- End Profile Page Nav -->
        @endif

        @if($level == 'Administrator' || $level == 'Operator')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('customer*') ? '' : 'collapsed' }}" href="{{ route('customer.index') }}">
                <i class="bi bi-person-lines-fill"></i>
                <span>Customer</span>
            </a>
        </li><!-- End Contact Page Nav -->
        @endif

        @if($level == 'Administrator' || $level == 'Operator')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('service*') ? '' : 'collapsed' }}" href="{{ route('service.index') }}">
                <i class="bi bi-card-list"></i>
                <span>Service</span>
            </a>
        </li><!-- End Contact Page Nav -->
        @endif


        @if($level == 'Administrator')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('level*') ? '' : 'collapsed' }}" href="{{ route('level.index') }}">
                <i class="bi bi-person-workspace"></i>
                <span>Level</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->
        @endif

        @if($level == 'Administrator' || $level == 'Operator')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('transaction*') ? '' : 'collapsed' }}" href="{{ route('transaction.index') }}">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Transaksi</span>
            </a>
        </li><!-- End Login Page Nav -->
        @endif

        @if($level == 'Administrator' || $level == 'Operator')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('pickup*') ? '' : 'collapsed' }}" href="{{ route('pickup.index') }}">
                <i class="bi bi-truck"></i>
                <span>Pickup Laundry</span>
            </a>
        </li>
        @endif
        @if($level == 'Administrator' || $level == 'Operator' || $level == 'Pimpinan')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('report*') ? '' : 'collapsed' }}" href="{{ route('report.index') }}">
                <i class="bi bi-folder2"></i>
                <span>Laporan</span>
            </a>
        </li>
        @endif
    </ul>

</aside>
