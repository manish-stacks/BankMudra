@extends('layouts.master')
@section('meta_title', isset($title) ? $title : 'Dashboard')
@section('contant')
<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="p-4 rounded-4 shadow-sm"
                style="background: linear-gradient(135deg, #4e54c8, #8f94fb);">
                <h1 class="h3 fw-bold text-white mb-2">
                    <i class="fas fa-tachometer-alt me-2"></i> Loan Management Dashboard
                </h1>
                <p class="text-white mb-0">
                    Welcome back! Here’s your complete overview of loans, collections, payments, and upcoming reminders.
                </p>
            </div>
        </div>
    </div>


    <!-- Loan Summary START -->
    <div class="row g-4 mb-4">

        <!-- Total Loans -->
        <div class="col-md-6 col-xxl-3">
            <div class="card card-body text-white shadow-lg p-4 h-100 rounded-4"
                style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-0 fw-bold">120</h2>
                        <span class="mb-0 h6">Active Loans</span>
                    </div>
                    <div class="icon-lg rounded-circle bg-white text-primary shadow-sm">
                        <i class="fas fa-university"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Collections -->
        <div class="col-md-6 col-xxl-3">
            <div class="card card-body text-white shadow-lg p-4 h-100 rounded-4"
                style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-0 fw-bold">₹1,25,000</h2>
                        <span class="mb-0 h6">Total Collected</span>
                    </div>
                    <div class="icon-lg rounded-circle bg-white text-success shadow-sm">
                        <i class="fas fa-rupee-sign"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Due Today -->
        <div class="col-md-6 col-xxl-3">
            <div class="card card-body text-white shadow-lg p-4 h-100 rounded-4"
                style="background: linear-gradient(135deg, #f7971e, #ffd200);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-0 fw-bold">15</h2>
                        <span class="mb-0 h6">Payments Due Today</span>
                    </div>
                    <div class="icon-lg rounded-circle bg-white text-warning shadow-sm">
                        <i class="fas fa-bell"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Dues -->
        <div class="col-md-6 col-xxl-3">
            <div class="card card-body text-white shadow-lg p-4 h-100 rounded-4"
                style="background: linear-gradient(135deg, #f953c6, #b91d73);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-0 fw-bold">28</h2>
                        <span class="mb-0 h6">Upcoming Dues</span>
                    </div>
                    <div class="icon-lg rounded-circle bg-white text-danger shadow-sm">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Loan Summary END -->

    <!-- Loan Types & EMI Summary -->
    <div class="row g-4 mb-4">
        <!-- Loan Types -->
        <div class="col-md-6 col-xxl-4">
            <div class="card shadow-lg h-100 rounded-4 border-0">

                <!-- Card Header -->
                <div class="card-header text-white rounded-top-4"
                    style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-list-alt me-2"></i> Loan Types Overview
                    </h5>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    <ul class="list-unstyled mb-0">

                        <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                            <div>
                                <i class="fas fa-clock text-primary me-2"></i>
                                <span class="fw-semibold">Daily Loans</span>
                            </div>
                            <span class="badge bg-primary rounded-pill shadow-sm">35</span>
                        </li>

                        <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                            <div>
                                <i class="fas fa-calendar-week text-warning me-2"></i>
                                <span class="fw-semibold">Weekly Loans</span>
                            </div>
                            <span class="badge bg-warning text-dark rounded-pill shadow-sm">40</span>
                        </li>

                        <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                            <div>
                                <i class="fas fa-calendar-alt text-success me-2"></i>
                                <span class="fw-semibold">Monthly Loans</span>
                            </div>
                            <span class="badge bg-success rounded-pill shadow-sm">25</span>
                        </li>

                        <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                            <div>
                                <i class="fas fa-sync-alt text-info me-2"></i>
                                <span class="fw-semibold">Recurring Loans</span>
                            </div>
                            <span class="badge bg-info text-dark rounded-pill shadow-sm">10</span>
                        </li>

                        <li class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-file-invoice-dollar text-danger me-2"></i>
                                <span class="fw-semibold">Fixed EMI Loans</span>
                            </div>
                            <span class="badge bg-danger rounded-pill shadow-sm">10</span>
                        </li>

                    </ul>
                </div>


            </div>
        </div>


        <!-- EMI Breakdown -->
        <div class="col-md-6 col-xxl-8">
            <div class="card shadow-lg h-100 rounded-4 border-0">

                <!-- Card Header -->
                <div class="card-header text-white rounded-top-4"
                    style="background: linear-gradient(135deg, #667eea, #764ba2);">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-chart-pie me-2"></i> EMI Breakdown
                    </h5>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    <ul class="list-unstyled mb-4">

                        <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                            <div>
                                <i class="fas fa-clock text-primary me-2"></i>
                                <span class="fw-semibold">Daily EMI</span>
                            </div>
                            <span class="badge bg-primary rounded-pill shadow-sm">₹5,000</span>
                        </li>

                        <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                            <div>
                                <i class="fas fa-calendar-week text-warning me-2"></i>
                                <span class="fw-semibold">Weekly EMI</span>
                            </div>
                            <span class="badge bg-warning text-dark rounded-pill shadow-sm">₹12,000</span>
                        </li>

                        <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                            <div>
                                <i class="fas fa-calendar-alt text-success me-2"></i>
                                <span class="fw-semibold">Monthly EMI</span>
                            </div>
                            <span class="badge bg-success rounded-pill shadow-sm">₹45,000</span>
                        </li>

                        <li class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-file-invoice-dollar text-danger me-2"></i>
                                <span class="fw-semibold">Fixed EMI</span>
                            </div>
                            <span class="badge bg-danger rounded-pill shadow-sm">₹30,000</span>
                        </li>

                    </ul>
                </div>

            </div>
        </div>


    </div>


  <div class="row g-4 mb-4">

    <!-- Payment Reminders -->
    <div class="col-md-6 col-xxl-4">
        <div class="card shadow-lg h-100 rounded-4 border-0">

            <!-- Card Header -->
            <div class="card-header text-white rounded-top-4"
                style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-bell me-2"></i> Payment Reminders
                </h5>
            </div>

            <!-- Card Body -->
            <div class="card-body p-4">
                <ul class="list-unstyled mb-0">

                    <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2 hover-item">
                        <div>
                            <i class="fas fa-clock text-primary me-2"></i>
                            <span class="fw-semibold">Daily Loans</span>
                        </div>
                        <span class="badge bg-primary rounded-pill shadow-sm">35</span>
                    </li>

                    <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2 hover-item">
                        <div>
                            <i class="fas fa-calendar-week text-warning me-2"></i>
                            <span class="fw-semibold">Weekly Loans</span>
                        </div>
                        <span class="badge bg-warning text-dark rounded-pill shadow-sm">40</span>
                    </li>

                    <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2 hover-item">
                        <div>
                            <i class="fas fa-calendar-alt text-success me-2"></i>
                            <span class="fw-semibold">Monthly Loans</span>
                        </div>
                        <span class="badge bg-success rounded-pill shadow-sm">25</span>
                    </li>

                    <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2 hover-item">
                        <div>
                            <i class="fas fa-sync-alt text-info me-2"></i>
                            <span class="fw-semibold">Recurring Loans</span>
                        </div>
                        <span class="badge bg-info text-dark rounded-pill shadow-sm">10</span>
                    </li>

                    <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2 hover-item">
                        <div>
                            <i class="fas fa-file-invoice-dollar text-danger me-2"></i>
                            <span class="fw-semibold">Fixed EMI Loans</span>
                        </div>
                        <span class="badge bg-danger rounded-pill shadow-sm">10</span>
                    </li>

                    <li class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2 hover-item">
                        <div>
                            <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                            <span class="fw-semibold">Overdue Payments</span>
                        </div>
                        <span class="badge bg-danger rounded-pill shadow-sm">5</span>
                    </li>

                    <li class="d-flex justify-content-between align-items-center hover-item">
                        <div>
                            <i class="fas fa-calendar-check text-success me-2"></i>
                            <span class="fw-semibold">Upcoming Payments</span>
                        </div>
                        <span class="badge bg-success rounded-pill shadow-sm">12</span>
                    </li>

                </ul>
            </div>

        </div>
    </div>

  <!-- Recent Transactions -->
<div class="col-md-6 col-xxl-8">
    <div class="card shadow-lg rounded-4 border-0">

        <!-- Card Header -->
        <div class="card-header text-white rounded-top-4"
            style="background: linear-gradient(135deg, #667eea, #764ba2);">
            <h5 class="mb-0 fw-bold">
                <i class="fas fa-history me-2"></i> Recent Transactions
            </h5>
        </div>

        <!-- Card Body -->
        <div class="card-body p-3">
            <ul class="list-group list-group-flush">

                <!-- Transaction Item: Paid -->
                <li class="list-group-item rounded-4 mb-2 p-3 shadow-sm transaction-item"
                    style="background: linear-gradient(135deg, #e0f7fa, #b2ebf2);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-success text-white me-2 d-flex justify-content-center align-items-center rounded-circle">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <strong>Rajesh</strong> <span class="text-success fw-semibold">Paid Successfully</span>
                                <div class="text-muted small">10:30 AM</div>
                            </div>
                        </div>
                        <span class="badge bg-success rounded-pill shadow-sm">₹5,000</span>
                    </div>
                </li>

                <!-- Transaction Item: Missed -->
                <li class="list-group-item rounded-4 mb-2 p-3 shadow-sm transaction-item"
                    style="background: linear-gradient(135deg, #ffebee, #ffcdd2);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-danger text-white me-2 d-flex justify-content-center align-items-center rounded-circle">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div>
                                <strong>Anita</strong> <span class="text-danger fw-semibold">Payment Missed</span>
                                <div class="text-muted small">2:45 PM</div>
                            </div>
                        </div>
                        <span class="badge bg-danger rounded-pill shadow-sm">₹4,500</span>
                    </div>
                </li>

                <!-- Transaction Item: Paid -->
                <li class="list-group-item rounded-4 mb-2 p-3 shadow-sm transaction-item"
                    style="background: linear-gradient(135deg, #e3f2fd, #bbdefb);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-primary text-white me-2 d-flex justify-content-center align-items-center rounded-circle">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <strong>Kiran</strong> <span class="text-primary fw-semibold">Paid Successfully</span>
                                <div class="text-muted small">11:15 AM</div>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill shadow-sm">₹8,000</span>
                    </div>
                </li>

                <!-- Transaction Item: Pending -->
                <li class="list-group-item rounded-4 mb-2 p-3 shadow-sm transaction-item"
                    style="background: linear-gradient(135deg, #fff3e0, #ffe0b2);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-warning text-white me-2 d-flex justify-content-center align-items-center rounded-circle">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <div>
                                <strong>Rahul</strong> <span class="text-warning fw-semibold">Payment Pending</span>
                                <div class="text-muted small">5:20 PM</div>
                            </div>
                        </div>
                        <span class="badge bg-warning text-dark rounded-pill shadow-sm">₹3,000</span>
                    </div>
                </li>

            </ul>
        </div>

    </div>
</div>




</div>




</div>
@endsection