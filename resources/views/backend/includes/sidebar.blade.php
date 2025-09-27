<style>
    .d-flex.align-items-center {
        justify-content: center;
    }

    #logo {
        height: 50px;
        width: 150px;
        display: block;
    }
</style>




<nav class="navbar sidebar navbar-expand-xl navbar-dark bg-dark">

    <!-- Navbar brand for xl START -->
    <div class="d-flex align-items-center">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <img class="navbar-brand-item rounded" id="logo" src="{{ static_asset('assets/images/bank.png') }}" height="130"
                width="400" alt="">
        </a>
    </div>

    <!-- Navbar brand for xl END -->

    <div class="offcanvas offcanvas-start flex-row custom-scrollbar h-100" data-bs-backdrop="true" tabindex="-1"
        id="offcanvasSidebar">
        <div class="offcanvas-body sidebar-content d-flex flex-column bg-dark">

            <!-- Sidebar menu START -->
            <ul class="navbar-nav flex-column" id="navbar-sidebar">

                <!-- Menu item 1 -->
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link active"><i
                            class="bi bi-house fa-fw me-2"></i>Dashboard</a></li>


                <!-- menu item 2 -->
                <!-- Loan Management -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#loanMgmt" role="button">
                        <i class="bi bi-basket fa-fw me-2"></i>Loan Management
                    </a>
                    <ul class="nav collapse flex-column" id="loanMgmt" data-bs-parent="#navbar-sidebar">
                        <li><a class="nav-link" href="{{route('admin.daily.loans')}}">Daily Loans</a></li>
                        <li><a class="nav-link" href="all-loans.html">Recurring Loans</a></li>
                        <li><a class="nav-link" href="loan-types.html">Monthly Loans</a></li>
                        <li><a class="nav-link" href="loan-registration.html">Fixed EMI Loans</a></li>
                    </ul>
                </li>
                <!-- Client Management -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#clientMgmt" role="button">
                        <i class="bi bi-people fa-fw me-2"></i>Client Management
                    </a>
                    <ul class="nav collapse flex-column" id="clientMgmt" data-bs-parent="#navbar-sidebar">
                        <li><a class="nav-link" href="{{route('admin.party-master.index')}}">All Clients</a></li>
                    </ul>
                </li>


                <!-- Payments & Collections -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#collapsePayments" role="button">
                        <i class="bi bi-wallet2 fa-fw me-2"></i>Payments & Collections
                    </a>
                    <ul class="nav collapse flex-column" id="collapsePayments" data-bs-parent="#navbar-sidebar">
                        <li><a class="nav-link" href="">Daily Collection</a></li>
                        <li><a class="nav-link" href="">Weekly Collection</a></li>
                        <li><a class="nav-link" href="">Monthly Collection</a></li>
                        <li><a class="nav-link" href="">Fixed EMI Collection</a></li>
                        <li><a class="nav-link" href="">Due Payments</a></li>
                        <li><a class="nav-link" href="">Overdue Loans</a></li>
                        <li><a class="nav-link" href="">Penalty Collection</a></li>
                    </ul>
                </li>

                <!-- Menu item 5 -->

                <!-- Menu item 8 -->

                <!-- Reports -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#collapseReports" role="button">
                        <i class="bi bi-bar-chart fa-fw me-2"></i>Reports
                    </a>
                    <ul class="nav collapse flex-column" id="collapseReports" data-bs-parent="#navbar-sidebar">
                        <li class="nav-item"><a class="nav-link" href="">EMI Breakdown</a></li>
                        <li class="nav-item"><a class="nav-link" href="">Receivable vs Collected</a></li>
                        <li class="nav-item"><a class="nav-link" href="">Daily Collection</a></li>
                        <li class="nav-item"><a class="nav-link" href="">Weekly Collection</a></li>
                        <li class="nav-item"><a class="nav-link" href="">Monthly Collection</a></li>
                        <li class="nav-item"><a class="nav-link" href="">Export Data (Excel/PDF)</a></li>
                    </ul>
                </li>


                @canany([
                'create-role', 'view-role', 'edit-role', 'delete-role','status-role',
                'create-user', 'view-user', 'edit-user', 'delete-user','status-user',
                ])

                <li class="nav-item ms-2 my-2">Permission Management</li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#collapsePermissions" role="button"
                        aria-expanded="false" aria-controls="collapsePermissions">
                        <i class="bi bi-shield-lock fa-fw me-2"></i>Role-Based Access
                    </a>
                    <!-- Submenu -->
                    <ul class="nav collapse flex-column" id="collapsePermissions" data-bs-parent="#navbar-sidebar">

                        @canany(['create-role', 'view-role', 'edit-role', 'delete-role','status-role',])
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.roles.index') }}">Manage Roles</a>
                        </li>
                        @endcanany

                        @canany(['create-user', 'view-user', 'edit-user', 'delete-user','status-user',])
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">Manage Users</a>
                        </li>
                        @endcanany

                    </ul>
                </li>
                @endcanany
                @canany([
                'view-general-settings',
                'view-payment-settings',
                'view-email-settings',
                ])
                <li class="nav-item ms-2 my-2">Setting</li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#collapsesetting" role="button"
                        aria-expanded="false" aria-controls="collapsesetting">
                        <i class="bi bi-gear me-2"></i>Setting
                    </a>
                    <!-- Submenu -->
                    <ul class="nav collapse flex-column" id="collapsesetting" data-bs-parent="#navbar-sidebar">
                        @can('view-general-settings')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.generalsettings.index') }}">General Settings</a>
                        </li>
                        @endcan

                        {{-- @can('view-payment-settings')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.payment.index') }}">Payment Settings</a>
                        </li>
                        @endcan --}}
                        @can('view-payment-settings')
                        <li class="nav-item">
                            <a class="nav-link" href="">Loan Types</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                <!-- Menu item 10 -->
                <li class="nav-item"> <a class="nav-link" href="{{ route('clear.cache') }}"><i
                            class="bi bi-recycle fa-fw me-2"></i>Cache Clear</a></li>
            </ul>
            <!-- Sidebar menu end -->
        </div>
    </div>
</nav>