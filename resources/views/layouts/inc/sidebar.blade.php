<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Master Data</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @php $level = auth()->user()->level->name; @endphp

  

        @if($level == 'Administrator')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('user.index') }}">
                <i class="bi bi-person"></i>
                <span>User</span>
            </a>
        </li><!-- End Profile Page Nav -->
        @endif

        @if($level == 'Administrator' || $level == 'Operator')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('customer.index') }}">
                <i class="bi bi-person-lines-fill"></i>
                <span>Customer</span>
            </a>
        </li><!-- End Contact Page Nav -->
        @endif

        @if($level == 'Administrator' || $level == 'Operator')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('service.index') }}">
                <i class="bi bi-card-list"></i>
                <span>Service</span>
            </a>
        </li><!-- End Contact Page Nav -->
        @endif


        @if($level == 'Administrator')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('level.index') }}">
                <i class="bi bi-person-workspace"></i>
                <span>Level</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->
        @endif

        @if($level == 'Administrator' || $level == 'Operator')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('transaction.index') }}">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Transaction</span>
            </a>
        </li><!-- End Login Page Nav -->
        @endif
    </ul>

</aside>
