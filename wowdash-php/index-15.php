<?php $script = '<script>
    
    // ===================== Average Enrollment Rate Start =============================== 
    function createChartTwo(chartId, color1, color2) {
        var options = {
            series: [{
                name: \'Income\',
                data: [48, 35, 55, 32, 48, 30, 55, 50, 57]
            }, {
                name: \'Expense\',
                data: [12, 20, 15, 26, 22, 60, 40, 48, 25]
            }],
            legend: {
                show: false 
            },
            chart: {
                type: \'line\',
                width: \'100%\',
                height: 270,
                toolbar: {
                    show: false
                },
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: \'smooth\',
                width: 3,
                colors: [color1, color2],
                lineCap: \'round\'
            },
            grid: {
                show: true,
                borderColor: \'#D1D5DB\',
                strokeDashArray: 1,
                position: \'back\',
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                },
                row: {
                    colors: undefined,
                    opacity: 0.5
                },
                column: {
                    colors: undefined,
                    opacity: 0.5
                },
                padding: {
                    top: -20,
                    right: 0,
                    bottom: -10,
                    left: 0
                },
            },
            colors: [color1, color2],
            markers: {
                colors: [color1, color2],
                strokeWidth: 3,
                size: 0,
                hover: {
                    size: 10
                }
            },
            xaxis: {
                labels: {
                    show: false
                },
                categories: [\'Jan\', \'Feb\', \'Mar\', \'Apr\', \'May\', \'Jun\', \'Jul\', \'Aug\', \'Sep\', \'Oct\', \'Nov\', \'Dec\'],
                tooltip: {
                    enabled: false
                },
                labels: {
                    formatter: function (value) {
                        return value;
                    },
                    style: {
                        fontSize: "14px"
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                    return "$" + value + "k";
                    },
                    style: {
                    fontSize: "14px"
                    }
                },
            },
            tooltip: {
                x: {
                    format: \'dd/MM/yy HH:mm\'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector(\'#\' + chartId), options);
        chart.render();
    }

    createChartTwo(\'averageEarningChart\', \'#487FFF\', \'#FF9F29\');
    // ===================== Average Enrollment Rate End =============================== 
    
    // ================================ Client Payment Status chart End ================================ 
    var options = {
        series: [{
            name: \'Net Profit\',
            data: [44, 100, 40, 56, 30, 58, 50]
        }, {
            name: \'Revenue\',
            data: [90, 140, 80, 125, 70, 140, 110]
        }, {
            name: \'Free Cash\',
            data: [60, 120, 60, 90, 50, 95, 90]
        }],
        colors: [\'#45B369\', \'#FF9F29\', \'#9935FE\'],
        labels: [\'Active\', \'New\', \'Total\'] ,
        
        legend: {
            show: false 
        },
        chart: {
            type: \'bar\',
            height: 350,
            toolbar: {
            show: false
            },
        },
        grid: {
            show: true,
            borderColor: \'#D1D5DB\',
            strokeDashArray: 4,
            position: \'back\',
        },
        plotOptions: {
            bar: {
            borderRadius: 4,
            columnWidth: 8,
            },
        },
        dataLabels: {
            enabled: false
        },
        states: {
            hover: {
            filter: {
                type: \'none\'
                }
            }
        },
        stroke: {
            show: true,
            width: 0,
            colors: [\'transparent\']
        },
        xaxis: {
            categories: [\'Mon\', \'Tues\', \'Wed\', \'Thurs\', \'Fri\', \'Sat\', \'Sun\'],
        },
        yaxis: {
            categories: [\'0\', \'10,000\', \'20,000\', \'30,000\', \'50,000\', \'1,00,000\', \'1,00,000\'],
        },
        fill: {
            opacity: 1,
            width: 18,
        },
    };

    var chart = new ApexCharts(document.querySelector(\'#projectAnalysisChart\'), options);
    chart.render();
    // ================================ Client Payment Status chart End ================================ 
    
    // ================================ Users Overview Donut chart Start ================================ 
    var options = { 
        series: [40, 87, 87, 30],
        colors: [\'#dc3545\', \'#ff9f29\', \'#8252e9\', \'#144bd6\'],
        labels: [\'Health\', \'Business\', \'Lifestyle\', \'Entertainment\'] ,
        legend: {
            show: false 
        },
        chart: {
            type: \'donut\',    
            height: 270,
            sparkline: {
                enabled: true
            },
            margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        },
        stroke: {
            width: 2,
        },
        dataLabels: {
            enabled: false
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: \'bottom\'
                }
            }
        }],
    };

    var chart = new ApexCharts(document.querySelector(\'#taskOverviewChart\'), options);
    chart.render();
  // ================================ Users Overview Donut chart End ================================ 
</script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Project Management</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Project Management</li>
        </ul>
    </div>
    
    <div class="row gy-4">

        <div class="col-xxl-8">
            <div class="card h-100 radius-8 border-0">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Average Earnings</h6>
                    <div class="">
                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                            <option>Yearly</option>
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Today</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-24">
                    <ul class="d-flex flex-wrap align-items-center justify-content-center my-3 gap-3">
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-8-px rounded-pill bg-primary-600"></span>
                            <span class="text-secondary-light text-sm fw-semibold">Income:
                                <span class="text-primary-light text-xl fw-bold line-height-1">$26,201</span>
                            </span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-8-px rounded-pill bg-warning-600"></span>
                            <span class="text-secondary-light text-sm fw-semibold">Expense:
                                <span class="text-primary-light text-xl fw-bold line-height-1"> $3,120</span>
                            </span>
                        </li>
                    </ul>
                    <div id="averageEarningChart" class="apexcharts-tooltip-style-1"></div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4">
            <div class="card h-100 radius-8 border-0">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Working Schedule</h6>
                    <div class="">
                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                            <option>Jan 2025</option>
                            <option>Feb 2025</option>
                            <option>March 2025</option>
                            <option>April 2025</option>
                            <option>May 2025</option>
                            <option>June 2025</option>
                            <option>July 2025</option>
                            <option>Aug 2025</option>
                            <option>Sep 2025</option>
                            <option>Oct 2025</option>
                            <option>Nov 2025</option>
                            <option>Dec 2025</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-24">
                    
                    <div class="d-flex align-items-center gap-16 justify-content-between flex-wrap">
                        <div class="week-item text-center">
                            <span class="text-sm text-neutral-400 fw-medium">Fr</span>
                            <h6 class="text-md mb-0">21</h6>
                        </div>
                        <div class="week-item text-center">
                            <span class="text-sm text-neutral-400 fw-medium">Sa</span>
                            <h6 class="text-md mb-0">22</h6>
                        </div>
                        <div class="week-item text-center">
                            <span class="text-sm text-neutral-400 fw-medium">Su</span>
                            <h6 class="text-md mb-0">23</h6>
                        </div>
                        <div class="week-item text-center">
                            <span class="text-sm text-neutral-400 fw-medium">Mo</span>
                            <h6 class="text-md mb-0">24</h6>
                        </div>
                        <div class="week-item text-center bg-purple rounded-pill py-12 px-16">
                            <span class="text-sm text-white fw-medium">Tu</span>
                            <h6 class="text-md mb-0 text-white">25</h6>
                        </div>
                        <div class="week-item text-center">
                            <span class="text-sm text-neutral-400 fw-medium">We</span>
                            <h6 class="text-md mb-0">26</h6>
                        </div>
                        <div class="week-item text-center">
                            <span class="text-sm text-neutral-400 fw-medium">Th</span>
                            <h6 class="text-md mb-0">27</h6>
                        </div>
                        <div class="text-center">
                            <span class="text-sm text-neutral-400 fw-medium">Fr</span>
                            <h6 class="text-md mb-0">28</h6>
                        </div>
                        <div class="text-center">
                            <span class="text-sm text-neutral-400 fw-medium">Sa</span>
                            <h6 class="text-md mb-0">29</h6>
                        </div>
                        <div class="text-center">
                            <span class="text-sm text-neutral-400 fw-medium">Su</span>
                            <h6 class="text-md mb-0">30</h6>
                        </div>
                    </div>
                    
                    <div class="mt-24 d-flex flex-column gap-20">
                        <div class="d-flex align-items-center justify-content-between gap-1 ps-10 border-inline-start border-start-width-3-px border-purple">
                            <div class="">
                                <div class="d-flex align-items-center gap-1">
                                    <h6 class="text-lg mb-0">10:20 - 11:00</h6>
                                    <span class="text-xs text-secondary-light fw-medium">AM</span>
                                </div>
                                <p class="text-sm text-secondary-light fw-medium mb-1">UI UX Dashboard Project Meeting</p>
                                <p class="text-xs text-neutral-400 fw-medium mb-0">Lead by <span class="text-success-600">Jane Cooper</span> </p>
                            </div>
                            <div class="">  
                                <a href="javascript:void(0)" class="btn btn-neutral-200 text-sm text-primary-light py-6 px-16">View </a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-1 ps-10 border-inline-start border-start-width-3-px border-warning-600">
                            <div class="">
                                <div class="d-flex align-items-center gap-1">
                                    <h6 class="text-lg mb-0">10:20 - 11:00</h6>
                                    <span class="text-xs text-secondary-light fw-medium">AM</span>
                                </div>
                                <p class="text-sm text-secondary-light fw-medium mb-1">UI UX Dashboard Project Meeting</p>
                                <p class="text-xs text-neutral-400 fw-medium mb-0">Lead by <span class="text-success-600">Jane Cooper</span> </p>
                            </div>
                            <div class="">  
                                <a href="javascript:void(0)" class="btn btn-neutral-200 text-sm text-primary-light py-6 px-16">View </a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-1 ps-10 border-inline-start border-start-width-3-px border-info-600">
                            <div class="">
                                <div class="d-flex align-items-center gap-1">
                                    <h6 class="text-lg mb-0">10:20 - 11:00</h6>
                                    <span class="text-xs text-secondary-light fw-medium">AM</span>
                                </div>
                                <p class="text-sm text-secondary-light fw-medium mb-1">UI UX Dashboard Project Meeting</p>
                                <p class="text-xs text-neutral-400 fw-medium mb-0">Lead by <span class="text-success-600">Jane Cooper</span> </p>
                            </div>
                            <div class="">  
                                <a href="javascript:void(0)" class="btn btn-neutral-200 text-sm text-primary-light py-6 px-16">View </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Widgets start -->
        <div class="col-xxl-3 col-sm-6">
            <div class="bg-base p-16 radius-8 position-relative overflow-hidden">
                <span class="blur-gradient blur-gradient-1 position-absolute end-0 top-50"></span>

                <div class="d-flex align-items-center justify-content-between gap-1">
                    <div class="">
                        <span class="text-secondary-light text-sm fw-medium">Total Projects</span>
                        <h6 class="text-2xl mb-0">320</h6>
                    </div>
                    <span class="w-40-px h-40-px radius-8 bg-danger-600 text-white d-flex justify-content-center align-items-center text-xxl">
                        <i class="ri-file-text-fill"></i>
                    </span>
                </div>
                <a href="javascript:void(0)" class="btn btn-success-100 text-success-600 text-sm py-1 px-16 mt-10">View More</a>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="bg-base p-16 radius-8 position-relative overflow-hidden">
                <span class="blur-gradient blur-gradient-2 position-absolute end-0 top-50"></span>

                <div class="d-flex align-items-center justify-content-between gap-1">
                    <div class="">
                        <span class="text-secondary-light text-sm fw-medium">Total Clients</span>
                        <h6 class="text-2xl mb-0">547</h6>
                    </div>
                    <span class="w-40-px h-40-px radius-8 bg-success-600 text-white d-flex justify-content-center align-items-center text-xxl">
                        <i class="ri-user-2-fill"></i>
                    </span>
                </div>
                <a href="javascript:void(0)" class="btn btn-success-100 text-success-600 text-sm py-1 px-16 mt-10">View More</a>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="bg-base p-16 radius-8 position-relative overflow-hidden">
                <span class="blur-gradient blur-gradient-3 position-absolute end-0 top-50"></span>

                <div class="d-flex align-items-center justify-content-between gap-1">
                    <div class="">
                        <span class="text-secondary-light text-sm fw-medium">Team Members</span>
                        <h6 class="text-2xl mb-0">356</h6>
                    </div>
                    <span class="w-40-px h-40-px radius-8 bg-warning-600 text-white d-flex justify-content-center align-items-center text-xxl">
                        <i class="ri-group-fill"></i>
                    </span>
                </div>
                <a href="javascript:void(0)" class="btn btn-success-100 text-success-600 text-sm py-1 px-16 mt-10">View More</a>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="bg-base p-16 radius-8 position-relative overflow-hidden">
                <span class="blur-gradient blur-gradient-4 position-absolute end-0 top-50"></span>

                <div class="d-flex align-items-center justify-content-between gap-1">
                    <div class="">
                        <span class="text-secondary-light text-sm fw-medium">Finished Projects</span>
                        <h6 class="text-2xl mb-0">435</h6>
                    </div>
                    <span class="w-40-px h-40-px radius-8 bg-info-600 text-white d-flex justify-content-center align-items-center text-xxl">
                        <i class="ri-file-list-3-fill"></i>
                    </span>
                </div>
                <a href="javascript:void(0)" class="btn btn-success-100 text-success-600 text-sm py-1 px-16 mt-10">View More</a>
            </div>
        </div>
        <!-- Widgets End -->
        
        <div class="col-xxl-4 col-sm-6">
            <div class="card h-100">
                <div class="card-body p-24">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                        <h6 class="mb-2 fw-bold text-lg">My Tasks</h6>
                        <div class="">
                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                            <option>All Tasks</option>
                            <option>Pending</option>
                            <option>Completed</option>
                            <option>In Progress</option>
                            <option>Canceled</option>
                        </select>
                        </div>
                    </div>
                    
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table mb-0 border-neutral-50">
                            <thead>
                                <tr>
                                  <th scope="col" class="border-neutral-50">Project Name</th>
                                  <th scope="col" class="border-neutral-50">Deadline</th>
                                  <th scope="col" class="border-neutral-50">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-neutral-50">Web Development</td>
                                    <td class="border-neutral-50">10 Jan 2025</td>
                                    <td class="border-neutral-50 text-center"> 
                                        <span class="bg-warning-focus text-warning-main px-16 py-2 radius-4 fw-medium text-sm">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-neutral-50">UX/UI Design</td>
                                    <td class="border-neutral-50">10 Jan 2025</td>
                                    <td class="border-neutral-50 text-center"> 
                                        <span class="bg-success-focus text-success-main px-16 py-2 radius-4 fw-medium text-sm">Completed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-neutral-50">React Development</td>
                                    <td class="border-neutral-50">10 Jan 2025</td>
                                    <td class="border-neutral-50 text-center"> 
                                        <span class="bg-purple-light text-purple px-16 py-2 radius-4 fw-medium text-sm">InProgress</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-neutral-50">Django Development</td>
                                    <td class="border-neutral-50">10 Jan 2025</td>
                                    <td class="border-neutral-50 text-center"> 
                                        <span class="bg-warning-focus text-warning-main px-16 py-2 radius-4 fw-medium text-sm">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-neutral-50">Web Development</td>
                                    <td class="border-neutral-50">10 Jan 2025</td>
                                    <td class="border-neutral-50 text-center"> 
                                        <span class="bg-danger-focus text-danger-main px-16 py-2 radius-4 fw-medium text-sm">Cancelled</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-neutral-50">Web Design</td>
                                    <td class="border-neutral-50">10 Jan 2025</td>
                                    <td class="border-neutral-50 text-center"> 
                                        <span class="bg-purple-light text-purple px-16 py-2 radius-4 fw-medium text-sm">InProgress</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xxl-4 col-sm-6">
            <div class="card h-100 radius-8 border-0">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Project Analysis</h6>
                    <div class="">
                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                            <option>Yearly</option>
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Today</option>
                        </select>
                    </div>
                </div>
            <div class="card-body p-24">
                <ul class="d-flex flex-wrap align-items-center justify-content-center">
                    <li class="d-flex align-items-center gap-2 me-28">
                    <span class="w-12-px h-12-px rounded-circle bg-success-main"></span>
                    <span class="text-secondary-light text-sm fw-medium">Revenue</span>
                    </li>
                    <li class="d-flex align-items-center gap-2 me-28">
                    <span class="w-12-px h-12-px rounded-circle bg-warning-main"></span>
                    <span class="text-secondary-light text-sm fw-medium">Expenses</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                    <span class="w-12-px h-12-px rounded-circle bg-purple"></span>
                    <span class="text-secondary-light text-sm fw-medium">Budgets</span>
                    </li>
                </ul>
                <div class="mt-40">
                    <div id="projectAnalysisChart" class="margin-16-minus"></div>
                </div>
            </div>
            </div>
        </div>
        
        <div class="col-xxl-4 col-sm-6">
            <div class="card h-100">
                <div class="card-body p-24">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                        <h6 class="mb-2 fw-bold text-lg">Team Members</h6>
                        <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>
                    
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table mb-0 border-neutral-100">
                            <thead> 
                                <tr>
                                  <th scope="col" class="border-neutral-100">Customer</th>
                                  <th scope="col" class="border-neutral-100">Task</th>
                                  <th scope="col" class="border-neutral-100">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <td class="border-neutral-100">
                                    <div class="d-flex align-items-center gap-12">
                                        <img src="assets/images/user-grid/user-grid-img5.png" alt="User" class="object-fit-cover rounded-circle w-40-px h-40-px radius-8 flex-shrink-0 overflow-hidden">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-medium">Kristin Watson</h6>
                                            <span class="text-sm text-secondary-light fw-medium">ulfaha@mail.ru</span>
                                        </div>
                                    </div>
                                  </td>
                                  <td class="border-neutral-100">15</td>
                                  <td class="border-neutral-100"> 
                                    <div class="max-w-112 mx-auto">
                                      <div class="w-100">
                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                          <div class="progress-bar bg-purple rounded-start-pill" style="width: 80%;"></div>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="border-neutral-100">
                                    <div class="d-flex align-items-center gap-12">
                                        <img src="assets/images/user-grid/user-grid-img4.png" alt="User" class="object-fit-cover rounded-circle w-40-px h-40-px radius-8 flex-shrink-0 overflow-hidden">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-medium">Theresa Webb</h6>
                                            <span class="text-sm text-secondary-light fw-medium">joie@gmail.com</span>
                                        </div>
                                    </div>
                                  </td>
                                  <td class="border-neutral-100">20</td>
                                  <td class="border-neutral-100"> 
                                    <div class="max-w-112 mx-auto">
                                      <div class="w-100">
                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                          <div class="progress-bar bg-warning-main rounded-start-pill" style="width: 50%;"></div>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="border-neutral-100">
                                    <div class="d-flex align-items-center gap-12">
                                        <img src="assets/images/user-grid/user-grid-img3.png" alt="User" class="object-fit-cover rounded-circle w-40-px h-40-px radius-8 flex-shrink-0 overflow-hidden">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-medium">Brooklyn Simmons</h6>
                                            <span class="text-sm text-secondary-light fw-medium">warn@mail.ru</span>
                                        </div>
                                    </div>
                                  </td>
                                  <td class="border-neutral-100">24</td>
                                  <td class="border-neutral-100"> 
                                    <div class="max-w-112 mx-auto">
                                      <div class="w-100">
                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                          <div class="progress-bar bg-info-main rounded-start-pill" style="width: 60%;"></div>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="border-neutral-100">
                                    <div class="d-flex align-items-center gap-12">
                                        <img src="assets/images/user-grid/user-grid-img2.png" alt="User" class="object-fit-cover rounded-circle w-40-px h-40-px radius-8 flex-shrink-0 overflow-hidden">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-medium">Robert Fox</h6>
                                            <span class="text-sm text-secondary-light fw-medium">fellora@mail.ru</span>
                                        </div>
                                    </div>
                                  </td>
                                  <td class="border-neutral-100">26</td>
                                  <td class="border-neutral-100"> 
                                    <div class="max-w-112 mx-auto">
                                      <div class="w-100">
                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                          <div class="progress-bar bg-success-main rounded-start-pill" style="width: 92%;"></div>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="border-neutral-100">
                                    <div class="d-flex align-items-center gap-12">
                                        <img src="assets/images/user-grid/user-grid-img1.png" alt="User" class="object-fit-cover rounded-circle w-40-px h-40-px radius-8 flex-shrink-0 overflow-hidden">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-medium">Jane Cooper</h6>
                                            <span class="text-sm text-secondary-light fw-medium">zitka@mail.ru</span>
                                        </div>
                                    </div>
                                  </td>
                                  <td class="border-neutral-100">25</td>
                                  <td class="border-neutral-100"> 
                                    <div class="max-w-112 mx-auto">
                                      <div class="w-100">
                                        <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                          <div class="progress-bar bg-red rounded-start-pill" style="width: 25%;"></div>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
       
        <div class="col-xxl-4 col-sm-6">
            <div class="shadow-7 radius-12 bg-base h-100 overflow-hidden">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Tasks Overview </h6>
                    <div class="">
                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                            <option>Yearly</option>
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Today</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-32 mt-20">
                    <div class="position-relative text-center">
                        <div id="taskOverviewChart" class="margin-16-minus y-value-left apexcharts-tooltip-z-none"></div>

                        <div class="text-center position-absolute top-50 start-50 translate-middle">
                            <span class="text-secondary-light">Total Tasks</span>
                            <h6 class="mb-0 mt-1">46</h6>
                        </div>
                    </div>
                </div>

                <ul class="d-flex flex-wrap align-items-center justify-content-center pb-24 mt-24 gap-28">
                    <li class="d-flex align-items-center gap-2">
                        <span class="w-12-px h-12-px rounded-circle bg-warning-main"></span>
                        <span class="text-secondary-light text-sm fw-medium">Pending</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <span class="w-12-px h-12-px rounded-circle bg-info-main"></span>
                        <span class="text-secondary-light text-sm fw-medium">In Progress</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <span class="w-12-px h-12-px rounded-circle bg-purple"></span>
                        <span class="text-secondary-light text-sm fw-medium">Completed</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <span class="w-12-px h-12-px rounded-circle bg-danger"></span>
                        <span class="text-secondary-light text-sm fw-medium">Cancelled</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-xxl-8">
            <div class="shadow-7 radius-12 bg-base h-100 overflow-hidden">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Projects Status</h6>
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
                                    <th scope="col" class="rounded-0">Project Name</th>
                                    <th scope="col" class="rounded-0">Clients</th>
                                    <th scope="col" class="rounded-0">Budget</th>
                                    <th scope="col" class="rounded-0">Duration</th>
                                    <th scope="col" class="rounded-0">Progress</th>
                                    <th scope="col" class="rounded-0 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-secondary-light"> UX/UI Design </td>
                                    <td class="text-secondary-light">Robert Fox</td>
                                    <td class="text-secondary-light">$24,000</td>
                                    <td class="text-secondary-light">24 Days</td>
                                    <td class="text-secondary-light">
                                        <span class="bg-success-focus text-success-main px-6 py-2 radius-4 fw-semibold text-sm d-inline-flex align-items-center gap-1">
                                            <i class="ri-arrow-right-up-line"></i>
                                            95%
                                        </span>
                                    </td>
                                    <td class="text-center"> 
                                        <span class="bg-warning-focus text-warning-main px-16 py-2 radius-4 fw-semibold text-sm">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary-light"> HTML Developer</td>
                                    <td class="text-secondary-light">Leslie Alexander</td>
                                    <td class="text-secondary-light">$32,700</td>
                                    <td class="text-secondary-light">16 Days</td>
                                    <td class="text-secondary-light">
                                        <span class="bg-danger-focus text-danger-main px-6 py-2 radius-4 fw-semibold text-sm d-inline-flex align-items-center gap-1">
                                            <i class="ri-arrow-left-down-line"></i>
                                            95%
                                        </span>
                                    </td>
                                    <td class="text-center"> 
                                        <span class="bg-success-focus text-success-main px-16 py-2 radius-4 fw-semibold text-sm">Completed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary-light">React Development</td>
                                    <td class="text-secondary-light">Devon Lane</td>
                                    <td class="text-secondary-light">$7,250</td>
                                    <td class="text-secondary-light">7 Days</td>
                                    <td class="text-secondary-light">
                                        <span class="bg-success-focus text-success-main px-6 py-2 radius-4 fw-semibold text-sm d-inline-flex align-items-center gap-1">
                                            <i class="ri-arrow-right-up-line"></i>
                                            95%
                                        </span>
                                    </td>
                                    <td class="text-center"> 
                                        <span class="bg-purple-light text-purple px-16 py-2 radius-4 fw-semibold text-sm">InProgress</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary-light">Python Research</td>
                                    <td class="text-secondary-light">Savannah Nguyen</td>
                                    <td class="text-secondary-light">$24,500</td>
                                    <td class="text-secondary-light">3 Days</td>
                                    <td class="text-secondary-light">
                                        <span class="bg-success-focus text-success-main px-6 py-2 radius-4 fw-semibold text-sm d-inline-flex align-items-center gap-1">
                                            <i class="ri-arrow-right-up-line"></i>
                                            95%
                                        </span>
                                    </td>
                                    <td class="text-center"> 
                                        <span class="bg-warning-focus text-warning-main px-16 py-2 radius-4 fw-semibold text-sm">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary-light">Laravel Project</td>
                                    <td class="text-secondary-light">Esther Howard</td>
                                    <td class="text-secondary-light">$30,000</td>
                                    <td class="text-secondary-light">5 Days</td>
                                    <td class="text-secondary-light">
                                        <span class="bg-success-focus text-success-main px-6 py-2 radius-4 fw-semibold text-sm d-inline-flex align-items-center gap-1">
                                            <i class="ri-arrow-right-up-line"></i>
                                            95%
                                        </span>
                                    </td>
                                    <td class="text-center"> 
                                        <span class="bg-danger-focus text-danger-main px-16 py-2 radius-4 fw-semibold text-sm">Cancelled</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
