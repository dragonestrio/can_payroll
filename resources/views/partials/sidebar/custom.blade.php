<aside class="left-sidebar d-lg-block" data-sidebarbg="skin6">
    <div class="scroll-sidebar overflow-scroll">
        {{-- Sidebar navigation --}}
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link @if ($position == 'dashboard')
                    active
                @endif"
                    href="{{ url('/') }}" aria-expanded="false"><i class="mdi me-2 mdi-gauge"></i><span
                    class="hide-menu text-capitalize">dashboard</span></a>
                </li>
                <li class="accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button border-0 bg-transparent text-capitalize @if ($position != 'user' || $position != 'profile')
                                collapsed
                            @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne">
                                <i class="mdi me-2 mdi-account-multiple"></i>
                                <span>users</span>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse border-0 bg-transparent @if ($position == 'user' || $position == 'profile')
                            show
                        @endif">
                            <ul class="accordion-body">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if ($position == 'user' && $state == 'read'
                                    || $position == 'user' && $state == 'update' || $position == 'profile' && $state == 'read' || $position == 'profile' && $state == 'update')
                                        active
                                    @endif" href="{{ url('user') }}" aria-expanded="false">
                                        <i class="mdi me-2 mdi-information-outline"></i>
                                        <span class="hide-menu text-capitalize">daftar users</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if ($position == 'user' && $state == 'create')
                                        active
                                    @endif" href="{{ url('user/create') }}" aria-expanded="false">
                                        <i class="mdi me-2 mdi-plus-circle-outline"></i>
                                        <span class="hide-menu text-capitalize">tambah users</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button border-0 bg-transparent text-capitalize @if ($position != 'employee')
                                collapsed
                            @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="mdi me-2 mdi-account-card-details"></i>
                                <span>karyawan</span>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse border-0 bg-transparent @if ($position == 'employee')
                            show
                        @endif">
                            <ul class="accordion-body">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if ($position == 'employee' && $state == 'read'
                                    || $position == 'employee' && $state == 'update')
                                        active
                                    @endif" href="{{ url('employee') }}" aria-expanded="false">
                                        <i class="mdi me-2 mdi-information-outline"></i>
                                        <span class="hide-menu text-capitalize">daftar karyawan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if ($position == 'employee' && $state == 'create')
                                    active
                                @endif" href="{{ url('employee/create') }}" aria-expanded="false">
                                        <i class="mdi me-2 mdi-plus-circle-outline"></i>
                                        <span class="hide-menu text-capitalize">tambah karyawan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button border-0 bg-transparent text-capitalize @if ($position != 'financial')
                                collapsed
                            @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="mdi me-2 mdi-cash-multiple"></i>
                                <span>keuangan</span>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse border-0 bg-transparent @if ($position == 'financial')
                            show
                        @endif">
                            <ul class="accordion-body">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if ($position == 'financial' && $state == 'read'
                                    || $position == 'financial' && $state == 'update')
                                        active
                                    @endif" href="{{ url('financial') }}" aria-expanded="false">
                                        <i class="mdi me-2 mdi-information-outline"></i>
                                        <span class="hide-menu text-capitalize">daftar keuangan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if ($position == 'financial' && $state == 'create')
                                        active
                                    @endif" href="{{ url('financial/create') }}" aria-expanded="false">
                                        <i class="mdi me-2 mdi-plus-circle-outline"></i>
                                        <span class="hide-menu text-capitalize">tambah keuangan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button border-0 bg-transparent text-capitalize @if ($position != 'payroll' || $position != 'payroll_category')
                                collapsed
                            @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <i class="mdi me-2 mdi-book-multiple-variant"></i>
                                <span>penggajian</span>
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse border-0 bg-transparent @if ($position == 'payroll' || $position == 'payroll_category')
                            show
                        @endif">
                            <ul class="accordion-body">
                                <li class="accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button border-0 bg-transparent text-capitalize @if ($position != 'payroll_category')
                                                collapsed
                                            @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourA" aria-expanded="false" aria-controls="collapseFourA">
                                                <i class="mdi me-2 mdi-cash-multiple"></i>
                                                <span>kategori penggajian</span>
                                            </button>
                                        </h2>
                                        <div id="collapseFourA" class="accordion-collapse collapse border-0 bg-transparent @if ($position == 'payroll_category')
                                            show
                                        @endif">
                                            <ul class="accordion-body">
                                                <li class="sidebar-item">
                                                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if ($position == 'payroll_category' && $state == 'read'
                                                    || $position == 'payroll_category' && $state == 'update')
                                                        active
                                                    @endif" href="{{ url('payroll_category') }}" aria-expanded="false">
                                                        <i class="mdi me-2 mdi-information-outline"></i>
                                                        <span class="hide-menu text-capitalize">daftar kategori</span>
                                                    </a>
                                                </li>
                                                <li class="sidebar-item">
                                                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if ($position == 'payroll_category' && $state == 'create')
                                                        active
                                                    @endif" href="{{ url('payroll_category/create') }}" aria-expanded="false">
                                                        <i class="mdi me-2 mdi-plus-circle-outline"></i>
                                                        <span class="hide-menu text-capitalize">tambah kategori</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button border-0 bg-transparent text-capitalize @if ($position != 'payroll')
                                                collapsed
                                            @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourB" aria-expanded="false" aria-controls="collapseFourB">
                                                <i class="mdi me-2 mdi-book-open-page-variant"></i>
                                                <span>gajian</span>
                                            </button>
                                        </h2>
                                        <div id="collapseFourB" class="accordion-collapse collapse border-0 bg-transparent @if ($position == 'payroll')
                                            show
                                        @endif">
                                            <ul class="accordion-body">
                                                <li class="sidebar-item">
                                                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if ($position == 'payroll' && $state == 'read'
                                                    || $position == 'payroll' && $state == 'update')
                                                        active
                                                    @endif" href="{{ url('payroll') }}" aria-expanded="false">
                                                        <i class="mdi me-2 mdi-information-outline"></i>
                                                        <span class="hide-menu text-capitalize">daftar penggajian</span>
                                                    </a>
                                                </li>
                                                <li class="sidebar-item">
                                                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if ($position == 'payroll' && $state == 'create')
                                                        active
                                                    @endif" href="{{ url('payroll/create') }}" aria-expanded="false">
                                                        <i class="mdi me-2 mdi-plus-circle-outline"></i>
                                                        <span class="hide-menu text-capitalize">tambah penggajian</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button border-0 bg-transparent text-capitalize @if ($position != 'report')
                                collapsed
                            @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <i class="mdi me-2 mdi-file-chart"></i>
                                <span>laporan keuangan</span>
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse border-0 bg-transparent @if ($position == 'report')
                            show
                        @endif">
                            <ul class="accordion-body">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if ($position == 'employee' && $state == 'read'
                                    || $position == 'employee' && $state == 'update')
                                        active
                                    @endif" href="{{ url('report') }}" aria-expanded="false">
                                        <i class="mdi me-2 mdi-download"></i>
                                        <span class="hide-menu text-capitalize">cetak laporan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

            </ul>
        </nav>
        {{--  --}}
    </div>
    <div class="sidebar-footer">
        <div class="d-flex justify-content-between">
            <div class="link-wrap">
                <a href="{{ url('profile') }}" class="link" data-toggle="tooltip" title="" data-original-title="Settings">
                    <i class="ti-settings"></i>
                </a>
            </div>
            <div class="link-wrap">
                <a href="{{ url('logout') }}" class="link" data-toggle="tooltip" title="" data-original-title="Logout">
                    <i class="mdi mdi-power"></i>
                </a>
            </div>
        </div>
    </div>
</aside>
