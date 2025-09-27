<nav class="navbar top-bar navbar-light border-bottom py-0 py-xl-3">
    <div class="container-fluid p-0">
        <div class="d-flex align-items-center w-100">

            <!-- Logo START -->
            <div class="d-flex align-items-center d-xl-none">
                <a class="navbar-brand" href="index.html">
                    <img class="light-mode-item navbar-brand-item h-30px"
                        src="{{ static_asset('assets/images/logoexam24.png') }}" alt="">
                    <img class="dark-mode-item navbar-brand-item h-30px"
                        src="{{ static_asset('assets/images/logoexam24.png') }}" alt="">
                </a>
            </div>
            <!-- Logo END -->

            <!-- Toggler for sidebar START -->
            <div class="navbar-expand-xl sidebar-offcanvas-menu">
                <button class="navbar-toggler me-auto" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-expanded="false"
                    aria-label="Toggle navigation" data-bs-auto-close="outside">
                    <i class="bi bi-text-right fa-fw h2 lh-0 mb-0 rtl-flip" data-bs-target="#offcanvasMenu">
                    </i>
                </button>
            </div>
            <!-- Toggler for sidebar END -->

            <!-- Top bar left -->
            <div class="navbar-expand-lg ms-auto ms-xl-0">

                <!-- Toggler for menubar START -->
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTopContent" aria-controls="navbarTopContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-animation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
                <!-- Toggler for menubar END -->

                <!-- Topbar menu START -->
                <div class="collapse navbar-collapse w-100" id="navbarTopContent">
                    <!-- Top search START -->
                    <!-- EMI Calculator Icon -->
                    <li class="nav-item ms-2 ms-sm-3 d-none d-sm-block">
                        <a class="btn btn-light btn-round mb-0" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#emiCalculatorModal">
                            <i class="bi bi-calculator fa-fw"></i>
                        </a>
                    </li>

                    <!-- Top search END -->
                </div>
                <!-- Topbar menu END -->
            </div>
            <!-- Top bar left END -->

            <!-- Top bar right START -->
            <div class="ms-xl-auto">
                <ul class="navbar-nav flex-row align-items-center">

                    <!-- Clear Cache Icon -->
                    <li class="nav-item ms-2 ms-sm-3 d-none d-sm-block">
                        <a class="btn btn-light btn-round mb-0" href="{{ route('clear.cache') }}" onclick="clearCache();">
                            <i class="bi bi-recycle fa-fw me-2"></i>
                        </a>
                    </li>

                    <li class="nav-item ms-2 ms-sm-3 d-none d-sm-block">
                        <a class="btn btn-light btn-round mb-0" href="javascript:void(0);" onclick="openFullscreen();">
                            <i class="bi bi-arrows-fullscreen fa-fw"></i></a>
                    </li>



                    <!-- Profile dropdown START -->
                    <li class="nav-item ms-2 ms-md-3 dropdown">
                        <!-- Avatar -->
                        <a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button"
                            data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="avatar-img rounded-circle"
                                src="{{ static_asset('assets/images/avatar/01.jpg') }}" alt="avatar">
                        </a>

                        <!-- Profile dropdown START -->
                        <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"
                            aria-labelledby="profileDropdown">
                            <!-- Profile info -->
                            <li class="px-3">
                                <div class="d-flex align-items-center">
                                    <!-- Avatar -->
                                    <div class="avatar me-3 mb-3">
                                        <img class="avatar-img rounded-circle shadow"
                                            src="{{ static_asset('assets/images/avatar/01.jpg') }}" alt="avatar">
                                    </div>
                                    <div>
                                        @if (auth()->check())
                                        <a class="h6 mt-2 mt-sm-0" href="#">{{ auth()->user()->name }}</a>
                                        <p class="small m-0">{{ auth()->user()->email }}</p>
                                        @endif

                                    </div>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <!-- Links -->
                            <li><a class="dropdown-item" href="{{ route('admin.generalsettings.index') }}"><i
                                        class="bi bi-person fa-fw me-2"></i>Edit
                                    Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.generalsettings.index') }}"><i
                                        class="bi bi-gear fa-fw me-2"></i>Account
                                    Settings</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.generalsettings.index') }}"><i
                                        class="bi bi-info-circle fa-fw me-2"></i>Active Logs</a></li>


                            <li>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                    class="hidden">
                                    {{ csrf_field() }}
                                </form>

                                <a class="dropdown-item bg-danger-soft-hover" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-power fa-fw me-2"></i>Sign Out
                                </a>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Dark mode options START -->
                            <li>
                                <div
                                    class="bg-light dark-mode-switch theme-icon-active d-flex align-items-center p-1 rounded mt-2">
                                    <!-- <span>Mode:</span> -->
                                    <button type="button" class="btn btn-sm mb-0" data-bs-theme-value="light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-sun fa-fw mode-switch"
                                            viewbox="0 0 16 16">
                                            <path
                                                d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
                                            </path>
                                            <use href="#"></use>
                                        </svg> Light
                                    </button>
                                    <button type="button" class="btn btn-sm mb-0" data-bs-theme-value="dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-moon-stars fa-fw mode-switch"
                                            viewbox="0 0 16 16">
                                            <path
                                                d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z">
                                            </path>
                                            <path
                                                d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z">
                                            </path>
                                            <use href="#"></use>
                                        </svg> Dark
                                    </button>
                                    <button type="button" class="btn btn-sm mb-0 active" data-bs-theme-value="auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-circle-half fa-fw mode-switch"
                                            viewbox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z">
                                            </path>
                                            <use href="#"></use>
                                        </svg> Auto
                                    </button>
                                </div>
                            </li>
                            <!-- Dark mode options END-->
                        </ul>
                        <!-- Profile dropdown END -->
                    </li>
                    <!-- Profile dropdown END -->
                </ul>
            </div>
            <!-- Top bar right END -->
        </div>
    </div>
</nav>




<!-- EMI Calculator Modal -->
<div class="modal fade" id="emiCalculatorModal" tabindex="-1" aria-labelledby="emiCalculatorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg border-0">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="emiCalculatorModalLabel">
          <i class="bi bi-calculator me-2"></i> EMI Calculator
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Calculator Form -->
        <form id="emiForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Loan Amount</label>
              <input type="number" class="form-control form-control-lg" id="loanAmount" placeholder="Enter amount" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Interest Rate (%)</label>
              <input type="number" class="form-control form-control-lg" id="interestRate" placeholder="e.g. 12" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Duration (Months)</label>
              <input type="number" class="form-control form-control-lg" id="duration" placeholder="e.g. 12" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Loan Type</label>
              <select class="form-select form-select-lg" id="loanType">
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly" selected>Monthly</option>
                <option value="fixed">Fixed EMI</option>
              </select>
            </div>
          </div>
          <div class="mt-4 text-center">
            <button type="button" class="btn btn-primary btn-lg px-5" onclick="calculateEMI()">Calculate</button>
          </div>
        </form>
        <!-- Result -->
        <div class="mt-4 d-none" id="emiResult">
          <h5 class="fw-bold text-dark">Calculation Result</h5>
          <p class="fs-5 mb-1">EMI: <span id="emiValue" class="fw-semibold text-success"></span></p>
          <p class="fs-6">Total Payable: <span id="totalPayable" class="fw-semibold text-primary"></span></p>
          <p class="fs-6">Total Interest: <span id="totalInterest" class="fw-semibold text-danger"></span></p>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- JS Calculation -->
<script>
  function calculateEMI() {
    const loanAmount = parseFloat(document.getElementById("loanAmount").value);
    const interestRate = parseFloat(document.getElementById("interestRate").value) / 100 / 12;
    const duration = parseInt(document.getElementById("duration").value);

    if (!loanAmount || !interestRate || !duration) return;

    const emi = (loanAmount * interestRate * Math.pow(1 + interestRate, duration)) / (Math.pow(1 + interestRate, duration) - 1);
    const totalPayable = emi * duration;
    const totalInterest = totalPayable - loanAmount;

    document.getElementById("emiResult").classList.remove("d-none");
    document.getElementById("emiValue").textContent = emi.toFixed(2);
    document.getElementById("totalPayable").textContent = totalPayable.toFixed(2);
    document.getElementById("totalInterest").textContent = totalInterest.toFixed(2);
  }
</script>


<style>
  #emiResult span {
    color: #2b2b2b;
    font-weight: 500;
  }
  .modal-content {
    border-radius: 1rem !important;
  }
  .modal-header {
    border-bottom: none;
  }
  .modal-footer {
    border-top: none;
  }
</style>
