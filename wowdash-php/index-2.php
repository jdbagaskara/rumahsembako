<?php 
$campaigns = [
    [
        'icon' => 'majesticons:mail',
        'iconColor' => 'text-orange',
        'name' => 'Email',
        'progress' => 80,
        'progressColor' => 'bg-orange'
    ],
    [
        'icon' => 'eva:globe-2-fill',
        'iconColor' => 'text-success-main',
        'name' => 'Website',
        'progress' => 60,
        'progressColor' => 'bg-success-main'
    ],
    [
        'icon' => 'fa6-brands:square-facebook',
        'iconColor' => 'text-info-main',
        'name' => 'Facebook',
        'progress' => 49,
        'progressColor' => 'bg-info-main'
    ],
    [
        'icon' => 'fluent:location-off-20-filled',
        'iconColor' => 'text-indigo',
        'name' => 'Email',
        'progress' => 70,
        'progressColor' => 'bg-indigo'
    ]
];

$countries = [
    [
        'flag' => 'flag1.png',
        'name' => 'USA',
        'users' => '1,240 Users',
        'progress' => 80,
        'progressColor' => 'bg-primary-600'
    ],
    [
        'flag' => 'flag2.png',
        'name' => 'Japan',
        'users' => '1,240 Users',
        'progress' => 60,
        'progressColor' => 'bg-orange'
    ],
    [
        'flag' => 'flag3.png',
        'name' => 'France',
        'users' => '1,240 Users',
        'progress' => 49,
        'progressColor' => 'bg-yellow'
    ],
    [
        'flag' => 'flag4.png',
        'name' => 'Germany',
        'users' => '1,240 Users',
        'progress' => 100,
        'progressColor' => 'bg-success-main'
    ]
];

$topPerformers = [
    [
        'image' => 'user1.png',
        'name' => 'Dianne Russell',
        'agentId' => '36254',
        'score' => '60/80'
    ],
    [
        'image' => 'user2.png',
        'name' => 'Wade Warren',
        'agentId' => '36254',
        'score' => '50/70'
    ],
    [
        'image' => 'user3.png',
        'name' => 'Albert Flores',
        'agentId' => '36254',
        'score' => '55/75'
    ],
    [
        'image' => 'user4.png',
        'name' => 'Bessie Cooper',
        'agentId' => '36254',
        'score' => '60/80'
    ],
    [
        'image' => 'user5.png',
        'name' => 'Arlene McCoy',
        'agentId' => '36254',
        'score' => '55/75'
    ],
    [
        'image' => 'user1.png',
        'name' => 'Arlene McCoy',
        'agentId' => '36254',
        'score' => '50/70'
    ]
];

$tasks = [
    [
        'taskName' => 'Hotel Management System',
        'taskId' => '#5632',
        'assignedTo' => 'Kathryn Murphy',
        'dueDate' => '27 Mar 2024',
        'status' => 'Active',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'taskName' => 'Hotel Management System',
        'taskId' => '#5632',
        'assignedTo' => 'Darlene Robertson',
        'dueDate' => '27 Mar 2024',
        'status' => 'Active',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'taskName' => 'Hotel Management System',
        'taskId' => '#5632',
        'assignedTo' => 'Courtney Henry',
        'dueDate' => '27 Mar 2024',
        'status' => 'Active',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'taskName' => 'Hotel Management System',
        'taskId' => '#5632',
        'assignedTo' => 'Jenny Wilson',
        'dueDate' => '27 Mar 2024',
        'status' => 'Active',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'taskName' => 'Hotel Management System',
        'taskId' => '#5632',
        'assignedTo' => 'Leslie Alexander',
        'dueDate' => '27 Mar 2024',
        'status' => 'Active',
        'statusClass' => 'bg-success-focus text-success-main'
    ]
];

$transactions = [
    [
        'id' => '5986124445445',
        'date' => '27 Mar 2024',
        'status' => 'Pending',
        'statusClass' => 'bg-warning-focus text-warning-main',
        'amount' => '$20,000.00'
    ],
    [
        'id' => '5986124445445',
        'date' => '27 Mar 2024',
        'status' => 'Rejected',
        'statusClass' => 'bg-danger-focus text-danger-main',
        'amount' => '$20,000.00'
    ],
    [
        'id' => '5986124445445',
        'date' => '27 Mar 2024',
        'status' => 'Completed',
        'statusClass' => 'bg-success-focus text-success-main',
        'amount' => '$20,000.00'
    ],
    [
        'id' => '5986124445445',
        'date' => '27 Mar 2024',
        'status' => 'Completed',
        'statusClass' => 'bg-success-focus text-success-main',
        'amount' => '$20,000.00'
    ],
    [
        'id' => '5986124445445',
        'date' => '27 Mar 2024',
        'status' => 'Completed',
        'statusClass' => 'bg-success-focus text-success-main',
        'amount' => '$20,000.00'
    ]
];

$script = '<script src="assets/js/homeTwoChart.js"></script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Dashboard</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">CRM</li>
        </ul>
    </div>
    <div class="row gy-4">
        <div class="col-xxl-8">
            <div class="row gy-4">

                <div class="col-xxl-4 col-sm-6">
                    <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-1">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-primary-600 flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6 mb-0">
                                        <iconify-icon icon="mingcute:user-follow-fill" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">New Users</span>
                                        <h6 class="fw-semibold">15,000</h6>
                                    </div>
                                </div>

                                <div id="new-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                            <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+200</span> this week</p>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-sm-6">
                    <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-2">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-success-main flex-shrink-0 text-white d-flex justify-content-center align-items-center rounded-circle h6">
                                        <iconify-icon icon="mingcute:user-follow-fill" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Active Users</span>
                                        <h6 class="fw-semibold">8,000</h6>
                                    </div>
                                </div>

                                <div id="active-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                            <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+200</span> this week</p>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-sm-6">
                    <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-3">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-yellow text-white flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <iconify-icon icon="iconamoon:discount-fill" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Total Sales</span>
                                        <h6 class="fw-semibold">$5,00,000</h6>
                                    </div>
                                </div>

                                <div id="total-sales-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                            <p class="text-sm mb-0">Increase by <span class="bg-danger-focus px-1 rounded-2 fw-medium text-danger-main text-sm">-$10k</span> this week</p>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-sm-6">
                    <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-4">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-purple text-white flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <iconify-icon icon="mdi:message-text" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Conversion</span>
                                        <h6 class="fw-semibold">25%</h6>
                                    </div>
                                </div>

                                <div id="conversion-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                            <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+5%</span> this week</p>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-sm-6">
                    <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-5">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-pink text-white flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <iconify-icon icon="mdi:leads" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Leads</span>
                                        <h6 class="fw-semibold">250</h6>
                                    </div>
                                </div>

                                <div id="leads-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                            <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+20</span> this week</p>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-sm-6">
                    <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-6">
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-cyan text-white flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <iconify-icon icon="streamline:bag-dollar-solid" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Total Profit</span>
                                        <h6 class="fw-semibold">$3,00,700</h6>
                                    </div>
                                </div>

                                <div id="total-profit-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                            <p class="text-sm mb-0">Increase by <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+$15k</span> this week</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Revenue Growth start -->
        <div class="col-xxl-4">
            <div class="card h-100 radius-8 border">
                <div class="card-body p-24">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <div>
                            <h6 class="mb-2 fw-bold text-lg">Revenue Growth</h6>
                            <span class="text-sm fw-medium text-secondary-light">Weekly Report</span>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-2 fw-bold text-lg">$50,000.00</h6>
                            <span class="bg-success-focus ps-12 pe-12 pt-2 pb-2 rounded-2 fw-medium text-success-main text-sm">$10k</span>
                        </div>
                    </div>
                    <div id="revenue-chart" class="mt-28"></div>
                </div>
            </div>
        </div>
        <!-- Revenue Growth End -->

        <!-- Earning Static start -->
        <div class="col-xxl-8">
            <div class="card h-100 radius-8 border-0">
                <div class="card-body p-24">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <div>
                            <h6 class="mb-2 fw-bold text-lg">Earning Statistic</h6>
                            <span class="text-sm fw-medium text-secondary-light">Yearly earning overview</span>
                        </div>
                        <div class="">
                            <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                <option>Yearly</option>
                                <option>Monthly</option>
                                <option>Weekly</option>
                                <option>Today</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-20 d-flex justify-content-center flex-wrap gap-3">

                        <div class="d-inline-flex align-items-center gap-2 p-2 radius-8 border pe-36 br-hover-primary group-item">
                            <span class="bg-neutral-100 w-44-px h-44-px text-xxl radius-8 d-flex justify-content-center align-items-center text-secondary-light group-hover:bg-primary-600 group-hover:text-white">
                                <iconify-icon icon="fluent:cart-16-filled" class="icon"></iconify-icon>
                            </span>
                            <div>
                                <span class="text-secondary-light text-sm fw-medium">Sales</span>
                                <h6 class="text-md fw-semibold mb-0">$200k</h6>
                            </div>
                        </div>

                        <div class="d-inline-flex align-items-center gap-2 p-2 radius-8 border pe-36 br-hover-primary group-item">
                            <span class="bg-neutral-100 w-44-px h-44-px text-xxl radius-8 d-flex justify-content-center align-items-center text-secondary-light group-hover:bg-primary-600 group-hover:text-white">
                                <iconify-icon icon="uis:chart" class="icon"></iconify-icon>
                            </span>
                            <div>
                                <span class="text-secondary-light text-sm fw-medium">Income</span>
                                <h6 class="text-md fw-semibold mb-0">$200k</h6>
                            </div>
                        </div>

                        <div class="d-inline-flex align-items-center gap-2 p-2 radius-8 border pe-36 br-hover-primary group-item">
                            <span class="bg-neutral-100 w-44-px h-44-px text-xxl radius-8 d-flex justify-content-center align-items-center text-secondary-light group-hover:bg-primary-600 group-hover:text-white">
                                <iconify-icon icon="ph:arrow-fat-up-fill" class="icon"></iconify-icon>
                            </span>
                            <div>
                                <span class="text-secondary-light text-sm fw-medium">Profit</span>
                                <h6 class="text-md fw-semibold mb-0">$200k</h6>
                            </div>
                        </div>
                    </div>

                    <div id="barChart" class="barChart"></div>
                </div>
            </div>
        </div>
        <!-- Earning Static End -->

        <!-- Campaign Static start -->
        <div class="col-xxl-4">
            <div class="row gy-4">
                <div class="col-xxl-12 col-sm-6">
                    <div class="card h-100 radius-8 border-0">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                <h6 class="mb-2 fw-bold text-lg">Campaigns</h6>
                                <div class="">
                                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                        <option>Yearly</option>
                                        <option>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Today</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3">
                                <?php foreach ($campaigns as $index => $campaign): ?>
                                <div class="d-flex align-items-center justify-content-between gap-3 <?php echo ($index < count($campaigns) - 1) ? 'mb-12' : ''; ?>">
                                    <div class="d-flex align-items-center">
                                        <span class="text-xxl line-height-1 d-flex align-content-center flex-shrink-0 <?php echo $campaign['iconColor']; ?>">
                                            <iconify-icon icon="<?php echo $campaign['icon']; ?>" class="icon"></iconify-icon>
                                        </span>
                                        <span class="text-primary-light fw-medium text-sm ps-12"><?php echo $campaign['name']; ?></span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 w-100">
                                        <div class="w-100 max-w-66 ms-auto">
                                            <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar <?php echo $campaign['progressColor']; ?> rounded-pill" style="width: <?php echo $campaign['progress']; ?>%;"></div>
                                            </div>
                                        </div>
                                        <span class="text-secondary-light font-xs fw-semibold"><?php echo $campaign['progress']; ?>%</span>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 col-sm-6">
                    <div class="card h-100 radius-8 border-0 overflow-hidden">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                <h6 class="mb-2 fw-bold text-lg">Customer Overview</h6>
                                <div class="">
                                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                        <option>Yearly</option>
                                        <option>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Today</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap align-items-center mt-3">
                                <ul class="flex-shrink-0">
                                    <li class="d-flex align-items-center gap-2 mb-28">
                                        <span class="w-12-px h-12-px rounded-circle bg-success-main"></span>
                                        <span class="text-secondary-light text-sm fw-medium">Total: 500</span>
                                    </li>
                                    <li class="d-flex align-items-center gap-2 mb-28">
                                        <span class="w-12-px h-12-px rounded-circle bg-warning-main"></span>
                                        <span class="text-secondary-light text-sm fw-medium">New: 500</span>
                                    </li>
                                    <li class="d-flex align-items-center gap-2">
                                        <span class="w-12-px h-12-px rounded-circle bg-primary-600"></span>
                                        <span class="text-secondary-light text-sm fw-medium">Active: 1500</span>
                                    </li>
                                </ul>
                                <div id="donutChart" class="flex-grow-1 apexcharts-tooltip-z-none title-style circle-none"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Campaign Static End -->

        <!-- Client Payment Status Start -->
        <div class="col-xxl-4 col-sm-6">
            <div class="card h-100 radius-8 border-0">
                <div class="card-body p-24">
                    <h6 class="mb-2 fw-bold text-lg">Client Payment Status</h6>
                    <span class="text-sm fw-medium text-secondary-light">Weekly Report</span>

                    <ul class="d-flex flex-wrap align-items-center justify-content-center mt-32">
                        <li class="d-flex align-items-center gap-2 me-28">
                            <span class="w-12-px h-12-px rounded-circle bg-success-main"></span>
                            <span class="text-secondary-light text-sm fw-medium">Paid: 500</span>
                        </li>
                        <li class="d-flex align-items-center gap-2 me-28">
                            <span class="w-12-px h-12-px rounded-circle bg-info-main"></span>
                            <span class="text-secondary-light text-sm fw-medium">Pending: 500</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-12-px rounded-circle bg-warning-main"></span>
                            <span class="text-secondary-light text-sm fw-medium">Overdue: 1500</span>
                        </li>
                    </ul>
                    <div class="mt-40">
                        <div id="paymentStatusChart" class="margin-16-minus"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Client Payment Status End -->

        <!-- Country Status Start -->
        <div class="col-xxl-4 col-sm-6">
            <div class="card radius-8 border-0">

                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg">Countries Status</h6>
                        <div class="">
                            <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                <option>Yearly</option>
                                <option>Monthly</option>
                                <option>Weekly</option>
                                <option>Today</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="world-map"></div>

                <div class="card-body p-24 max-h-266-px scroll-sm overflow-y-auto">
                    <div class="">
                        <?php foreach ($countries as $index => $country): ?>
                        <div class="d-flex align-items-center justify-content-between gap-3 <?php echo ($index < count($countries) - 1) ? 'mb-3 pb-2' : ''; ?>">
                            <div class="d-flex align-items-center w-100">
                                <img src="assets/images/flags/<?php echo $country['flag']; ?>" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                <div class="flex-grow-1">
                                    <h6 class="text-sm mb-0"><?php echo $country['name']; ?></h6>
                                    <span class="text-xs text-secondary-light fw-medium"><?php echo $country['users']; ?></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 w-100">
                                <div class="w-100 max-w-66 ms-auto">
                                    <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar <?php echo $country['progressColor']; ?> rounded-pill" style="width: <?php echo $country['progress']; ?>%;"></div>
                                    </div>
                                </div>
                                <span class="text-secondary-light font-xs fw-semibold"><?php echo $country['progress']; ?>%</span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
        <!-- Country Status End -->

        <!-- Top performance Start -->
        <div class="col-xxl-4">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Top Performer</h6>
                        <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>

                    <div class="mt-32">
                        <?php foreach ($topPerformers as $index => $performer): ?>
                        <div class="d-flex align-items-center justify-content-between gap-3 <?php echo ($index < count($topPerformers) - 1) ? 'mb-32' : ''; ?>">
                            <div class="d-flex align-items-center">
                                <img src="assets/images/users/<?php echo $performer['image']; ?>" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0"><?php echo $performer['name']; ?></h6>
                                    <span class="text-sm text-secondary-light fw-medium">Agent ID: <?php echo $performer['agentId']; ?></span>
                                </div>
                            </div>
                            <span class="text-primary-light text-md fw-medium"><?php echo $performer['score']; ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
        <!-- Top performance End -->

        <!-- Latest Performance Start -->
        <div class="col-xxl-6">
            <div class="card h-100">
                <div class="card-header border-bottom bg-base ps-0 py-0 pe-24 d-flex align-items-center justify-content-between">
                    <ul class="nav bordered-tab nav-pills mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-to-do-list-tab" data-bs-toggle="pill" data-bs-target="#pills-to-do-list" type="button" role="tab" aria-controls="pills-to-do-list" aria-selected="true">All Item</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-recent-leads-tab" data-bs-toggle="pill" data-bs-target="#pills-recent-leads" type="button" role="tab" aria-controls="pills-recent-leads" aria-selected="false" tabindex="-1">Best Match</button>
                        </li>
                    </ul>
                    <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                        View All
                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>
                <div class="card-body p-24">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-to-do-list" role="tabpanel" aria-labelledby="pills-to-do-list-tab" tabindex="0">
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Task Name </th>
                                            <th scope="col">Assigned To </th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tasks as $task): ?>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="text-md d-block line-height-1 fw-medium text-primary-light text-w-200-px"><?php echo $task['taskName']; ?></span>
                                                    <span class="text-sm d-block fw-normal text-secondary-light"><?php echo $task['taskId']; ?></span>
                                                </div>
                                            </td>
                                            <td><?php echo $task['assignedTo']; ?></td>
                                            <td><?php echo $task['dueDate']; ?></td>
                                            <td> <span class="<?php echo $task['statusClass']; ?> px-24 py-4 rounded-pill fw-medium text-sm"><?php echo $task['status']; ?></span> </td>
                                            <td class="text-center text-neutral-700 text-xl">
                                                <div class="dropdown">
                                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <iconify-icon icon="ph:dots-three-outline-vertical-fill" class="icon"></iconify-icon>
                                                    </button>
                                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                                        <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                                        <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Another action</a></li>
                                                        <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else here</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-recent-leads" role="tabpanel" aria-labelledby="pills-recent-leads-tab" tabindex="0">
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Task Name </th>
                                            <th scope="col">Assigned To </th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tasks as $task): ?>
                                        <tr>
                                            <td>
                                                <div>
                                                    <span class="text-md d-block line-height-1 fw-medium text-primary-light text-w-200-px"><?php echo $task['taskName']; ?></span>
                                                    <span class="text-sm d-block fw-normal text-secondary-light"><?php echo $task['taskId']; ?></span>
                                                </div>
                                            </td>
                                            <td><?php echo $task['assignedTo']; ?></td>
                                            <td><?php echo $task['dueDate']; ?></td>
                                            <td> <span class="<?php echo $task['statusClass']; ?> px-24 py-4 rounded-pill fw-medium text-sm"><?php echo $task['status']; ?></span> </td>
                                            <td class="text-center text-neutral-700 text-xl">
                                                <div class="dropdown">
                                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <iconify-icon icon="ph:dots-three-outline-vertical-fill" class="icon"></iconify-icon>
                                                    </button>
                                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                                        <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Action</a></li>
                                                        <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Another action</a></li>
                                                        <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900" href="javascript:void(0)">Something else here</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-6">
            <div class="card h-100">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Last Transaction</h6>
                    <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                        View All
                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>
                <div class="card-body p-24">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transactions as $transaction): ?>
                                <tr>
                                    <td><?php echo $transaction['id']; ?></td>
                                    <td><?php echo $transaction['date']; ?></td>
                                    <td> <span class="<?php echo $transaction['statusClass']; ?> px-24 py-4 rounded-pill fw-medium text-sm"><?php echo $transaction['status']; ?></span> </td>
                                    <td><?php echo $transaction['amount']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Latest Performance End -->
    </div>

</div>

<?php include './partials/layouts/layoutBottom.php' ?>
