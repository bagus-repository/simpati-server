<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link{{ request()->is('/dashboard') ? ' active':'' }}" href="{{ route('home.index') }}">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>
            <li class="nav-title">Master Data</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link{{ request()->is('roles*') ? ' active':'' }}" href="{{ route('roles.index') }}">
                    <i class="nav-icon icon-puzzle"></i> List Roles</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link{{ request()->is('users*') ? ' active':'' }}" href="{{ route('users.index') }}">
                    <i class="nav-icon icon-puzzle"></i> List User</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link{{ request()->is('news*') ? ' active':'' }}" href="{{ route('news.index') }}">
                    <i class="nav-icon icon-puzzle"></i> List Berita</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link{{ request()->is('contents*') ? ' active':'' }}" href="{{ route('contents.index') }}">
                    <i class="nav-icon icon-puzzle"></i> Atur Konten</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link{{ request()->is('services*') ? ' active':'' }}" href="{{ route('services.index') }}">
                    <i class="nav-icon icon-puzzle"></i> Atur Pelayanan</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link{{ request()->is('classifies*') ? ' active':'' }}" href="{{ route('classifies.index') }}">
                    <i class="nav-icon icon-puzzle"></i> Atur Klasifikasi</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link{{ request()->is('slide*') ? ' active':'' }}" href="{{ route('slide.index') }}">
                    <i class="nav-icon icon-puzzle"></i> Atur Slider Apps</a>
            </li>
            <li class="nav-title">Transaksi</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link{{ request()->is('inboxes*') ? ' active':'' }}" href="{{ route('inboxes.index') }}">
                    <i class="nav-icon icon-puzzle"></i> Surat Masuk</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link{{ request()->is('outboxes*') ? ' active':'' }}" href="{{ route('outboxes.index') }}">
                    <i class="nav-icon icon-puzzle"></i> Surat Keluar</a>
                </li>
            <li class="nav-title">E-filling</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link{{ request()->is('e-filling*') ? ' active':'' }}" href="{{ route('efilling.index') }}">
                    <i class="nav-icon icon-puzzle"></i> Permohonan</a>
            </li>
            </ul>
    </nav>
</div>
