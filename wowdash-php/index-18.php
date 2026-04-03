<?php $script = '<script>
    // ================================ Recent Orders Chart Start ================================ 
    function createChartTwo(chartId, chartColor) {

        var options = {
            series: [
                {
                    name: \'This Day\',
                    data: [18, 25, 20, 35, 25, 55, 45, 50, 40],
                },
            ],
            chart: {
                type: \'area\',
                width: \'100%\',
                height: 360,
                sparkline: {
                    enabled: false
                },
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
                width: 4,
                colors: [chartColor],
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
                    top: -30,
                    right: 0,
                    bottom: -10,
                    left: 0
                },
            },
            colors: [chartColor],
            fill: {
                type: \'gradient\',
                colors: [chartColor],
                gradient: {
                    shade: \'light\',
                    type: \'vertical\',
                    shadeIntensity: 0.5,
                    gradientToColors: [chartColor + \'00\'],
                    inverseColors: false,
                    opacityFrom: .6,
                    opacityTo: 0.3,
                    stops: [0, 100],
                },
            },
            markers: {
                colors: [chartColor],
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
                    enabled: false,
                },
                labels: {
                    formatter: function (value) {
                        return value;
                    },
                    style: {
                        fontSize: "14px"
                    }
                },
            },
            yaxis: {
                labels: {
                    show: false
                },
            },
            tooltip: {
                x: {
                    format: \'dd/MM/yy HH:mm\'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector(\'#\' + chartId), options);
        chart.render();
    }
    createChartTwo(\'recent-orders\', \'#487fff\');
    // ================================ Recent Orders Chart End ================================ 

    // ================================ Custom Overview Donut chart Start ================================ 
    var options = {
        series: [500, 500],
        colors: [\'#487FFF\', \'#FF9F29\'],
        labels: [\'Active\', \'New\'],
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
                top: -100,
                right: -100,
                bottom: -100,
                left: -100
            },
            padding: {
                top: -100,
                right: -100,
                bottom: -100,
                left: -100
            }
        },
        stroke: {
            width: 0,
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
        plotOptions: {
            pie: {
                startAngle: -90,
                endAngle: 90,
                offsetY: 10,
                customScale: 0.8,
                donut: {
                    size: \'70%\',
                    labels: {
                        show: true,
                        total: {
                            showAlways: true,
                            show: true,
                            label: \'Total Customer\',
                        }
                    },
                }
            }
        },
    };

    var chart = new ApexCharts(document.querySelector("#donutChart"), options);
    chart.render();
    // ================================ Custom Overview Donut chart End ================================ 

    // ================================ J Vector Map Start ================================ 
    $(\'#world-map\').vectorMap(
        {
            map: \'world_mill_en\',
            backgroundColor: \'transparent\',
            borderColor: \'#fff\',
            borderOpacity: 0.25,
            borderWidth: 0,
            color: \'#000000\',
            regionStyle: {
                initial: {
                    fill: \'#D1D5DB\'
                }
            },
            markerStyle: {
                initial: {
                    r: 5,
                    \'fill\': \'#fff\',
                    \'fill-opacity\': 1,
                    \'stroke\': \'#000\',
                    \'stroke-width\': 1,
                    \'stroke-opacity\': 0.4
                },
            },
            markers: [{
                latLng: [35.8617, 104.1954],
                name: \'China : 250\'
            },

            {
                latLng: [25.2744, 133.7751],
                name: \'AustrCalia : 250\'
            },

            {
                latLng: [36.77, -119.41],
                name: \'USA : 82%\'
            },

            {
                latLng: [55.37, -3.41],
                name: \'UK   : 250\'
            },

            {
                latLng: [25.20, 55.27],
                name: \'UAE : 250\'
            }],

            series: {
                regions: [{
                    values: {
                        "US": \'#487FFF \',
                        "SA": \'#487FFF\',
                        "AU": \'#487FFF\',
                        "CN": \'#487FFF\',
                        "GB": \'#487FFF\',
                    },
                    attribute: \'fill\'
                }]
            },
            hoverOpacity: null,
            normalizeFunction: \'linear\',
            zoomOnScroll: false,
            scaleColors: [\'#000000\', \'#000000\'],
            selectedColor: \'#000000\',
            selectedRegions: [],
            enableZoom: false,
            hoverColor: \'#fff\',
        });
    // ================================ J Vector Map End ================================ 

    // ===================== Average Enrollment Rate Start =============================== 
    function createChartThree(chartId, color1, color2) {
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
                type: \'area\',
                width: \'100%\',
                height: 340,
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
                curve: \'stepline\',
                width: 2,
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
                    opacity: 0.2
                },
                column: {
                    colors: undefined,
                    opacity: 0.2
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
                strokeWidth: 1,
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

    createChartThree(\'averageEarningChart\', \'#16a34a\', \'#FF9F29\');
    // ===================== Average Enrollment Rate End =============================== 
</script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Sales</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Sales</li>
        </ul>
    </div>

        <div class="card h-100 rounded-4 overflow-hidden">
            <div class="card-body p-20">
                <div class="row g-3">
                    <div class="col-xl-3 col-sm-6">
                        <div class="px-24 py-16 rounded-3 border border-neutral-200 sales-card-gradient-bg-1">
                            <div class="d-flex justify-content-between align-items-center gap-12">
                                <div class="flex-grow-1">
                                    <div class="">
                                        <h6 class="fw-semibold mb-0">240</h6>
                                        <span class="text-secondary-light mt-1">Total Product</span>
                                    </div>
                                </div>
                                <span
                                    class="bg-primary w-48-px h-48-px text-2xxl rounded-circle d-flex justify-content-center align-items-center text-white">
                                    <i class="ri-inbox-2-fill"></i>
                                </span>
                            </div>
                            <p class="text-sm mb-0 mt-20">
                                <span
                                    class="bg-base shadow-10 px-8 py-2 rounded-2 fw-medium text-success-main text-sm d-inline-flex align-items-center gap-1 me-6">
                                    <i class="ri-arrow-right-up-line"></i>
                                    95%
                                </span>
                                Last month 10
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="px-24 py-16 rounded-3 border border-neutral-200 sales-card-gradient-bg-2">
                            <div class="d-flex justify-content-between align-items-center gap-12">
                                <div class="flex-grow-1">
                                    <div class="">
                                        <h6 class="fw-semibold mb-0">350</h6>
                                        <span class="text-secondary-light mt-1">Total User</span>
                                    </div>
                                </div>
                                <span
                                    class="bg-warning-600 w-48-px h-48-px text-2xxl rounded-circle d-flex justify-content-center align-items-center text-white">
                                    <i class="ri-group-3-fill"></i>
                                </span>
                            </div>
                            <p class="text-sm mb-0 mt-20">
                                <span
                                    class="bg-base shadow-10 px-8 py-2 rounded-2 fw-medium text-success-main text-sm d-inline-flex align-items-center gap-1 me-6">
                                    <i class="ri-arrow-right-up-line"></i>
                                    95%
                                </span>
                                Last month 102
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="px-24 py-16 rounded-3 border border-neutral-200 sales-card-gradient-bg-1">
                            <div class="d-flex justify-content-between align-items-center gap-12">
                                <div class="flex-grow-1">
                                    <div class="">
                                        <h6 class="fw-semibold mb-0">$10,750</h6>
                                        <span class="text-secondary-light mt-1">Total Sales</span>
                                    </div>
                                </div>
                                <span
                                    class="bg-purple w-48-px h-48-px text-2xxl rounded-circle d-flex justify-content-center align-items-center text-white">
                                    <i class="ri-discount-percent-line"></i>
                                </span>
                            </div>
                            <p class="text-sm mb-0 mt-20">
                                <span
                                    class="bg-base shadow-10 px-8 py-2 rounded-2 fw-medium text-success-main text-sm d-inline-flex align-items-center gap-1 me-6">
                                    <i class="ri-arrow-right-up-line"></i>
                                    95%
                                </span>
                                Last month $1,600.00
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="px-24 py-16 rounded-3 border border-neutral-200 sales-card-gradient-bg-1">
                            <div class="d-flex justify-content-between align-items-center gap-12">
                                <div class="flex-grow-1">
                                    <div class="">
                                        <h6 class="fw-semibold mb-0">$8,000</h6>
                                        <span class="text-secondary-light mt-1">Total Revenue</span>
                                    </div>
                                </div>
                                <span
                                    class="bg-info w-48-px h-48-px text-2xxl rounded-circle d-flex justify-content-center align-items-center text-white">
                                    <i class="ri-money-dollar-circle-line"></i>
                                </span>
                            </div>
                            <p class="text-sm mb-0 mt-20">
                                <span
                                    class="bg-base shadow-10 px-8 py-2 rounded-2 fw-medium text-success-main text-sm d-inline-flex align-items-center gap-1 me-6">
                                    <i class="ri-arrow-right-up-line"></i>
                                    95%
                                </span>
                                Last month $1,600.00
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gy-4 mt-4">
            <div class="col-xxl-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                            <h6 class="mb-2 fw-bold text-lg">Transactions</h6>
                            <div class="">
                                <select
                                    class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                                    <option>This Month</option>
                                    <option>Last Month</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-32 d-flex flex-column gap-20">
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="assets/images/payment/payment1.png" alt="Image"
                                        class="w-40-px h-40-px radius-8 flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-normal">Paytm</h6>
                                        <span class="text-sm text-secondary-light fw-normal">Starbucks</span>
                                    </div>
                                </div>
                                <span class="text-danger text-md fw-medium">-$20</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="assets/images/payment/payment2.png" alt="Image"
                                        class="w-40-px h-40-px radius-8 flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-normal">PayPal</h6>
                                        <span class="text-sm text-secondary-light fw-normal">Client Payment</span>
                                    </div>
                                </div>
                                <span class="text-success-main text-md fw-medium">+$800</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="assets/images/payment/payment3.png" alt="Image"
                                        class="w-40-px h-40-px radius-8 flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-normal">Stripe</h6>
                                        <span class="text-sm text-secondary-light fw-normal">Ordered iPhone
                                            14</span>
                                    </div>
                                </div>
                                <span class="text-danger-main text-md fw-medium">-$300</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="assets/images/payment/payment4.png" alt="Image"
                                        class="w-40-px h-40-px radius-8 flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-normal">Razorpay</h6>
                                        <span class="text-sm text-secondary-light fw-normal">Refund</span>
                                    </div>
                                </div>
                                <span class="text-success-main text-md fw-medium">+$500</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="assets/images/payment/payment1.png" alt="Image"
                                        class="w-40-px h-40-px radius-8 flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-normal">Paytm</h6>
                                        <span class="text-sm text-secondary-light fw-normal">Starbucks</span>
                                    </div>
                                </div>
                                <span class="text-danger-main text-md fw-medium">-$1500</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="assets/images/payment/payment3.png" alt="Image"
                                        class="w-40-px h-40-px radius-8 flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-normal">Stripe</h6>
                                        <span class="text-sm text-secondary-light fw-normal">Ordered iPhone
                                            14</span>
                                    </div>
                                </div>
                                <span class="text-success-main text-md fw-medium">+$800</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                            <h6 class="mb-2 fw-bold text-lg">Sales Figure</h6>
                            <div class="">
                                <select
                                    class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                                    <option>This Month</option>
                                    <option>Last Month</option>
                                </select>
                            </div>
                        </div>
                        <ul class="d-flex flex-wrap align-items-center justify-content-center my-3 gap-3">
                            <li class="d-flex align-items-center gap-2">
                                <span class="w-12-px h-8-px rounded-pill bg-warning-600"></span>
                                <span class="text-secondary-light text-sm">Answered Calls
                                    <span class="text-primary-light text-xl fw-bold line-height-1 ms-4">$15.5k
                                    </span>
                                </span>
                            </li>
                            <li class="d-flex align-items-center gap-2">
                                <span class="w-12-px h-8-px rounded-pill bg-success-600"></span>
                                <span class="text-secondary-light text-sm">Sales
                                    <span class="text-primary-light text-xl fw-bold line-height-1 ms-4">$20.5k</span>
                                </span>
                            </li>
                        </ul>
                        <div id="averageEarningChart" class="apexcharts-tooltip-style-1"></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8">
                <div class="shadow-7 radius-12 bg-base h-100 overflow-hidden">
                    <div
                        class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                        <h6 class="text-lg fw-semibold mb-0">Recent Orders</h6>
                        <a href="javascript:void(0)"
                            class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive scroll-sm">
                            <table class="table bordered-table table-py-8 mb-0 rounded-0 border-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="rounded-0">Users</th>
                                        <th scope="col" class="rounded-0">Invoice</th>
                                        <th scope="col" class="rounded-0">Items</th>
                                        <th scope="col" class="rounded-0">Qty</th>
                                        <th scope="col" class="rounded-0">Amount</th>
                                        <th scope="col" class="rounded-0 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-secondary-light">
                                            <div class="d-flex align-items-center gap-12">
                                                <span class="w-40-px h-40-px radius-4 overflow-hidden rounded-circle">
                                                    <img src="assets/images/user-grid/user-grid-img5.png" alt="Avatar"
                                                        class="w-100 h-100 object-fit-cover">
                                                </span>
                                                <span class="text-primary-light fw-semibold">Dianne Russell</span>
                                            </div>
                                        </td>
                                        <td class="text-secondary-light">#6352148</td>
                                        <td class="text-secondary-light">Jan 10, 2025</td>
                                        <td class="text-secondary-light">Feb 10, 2025</td>
                                        <td class="text-secondary-light">1 Month</td>
                                        <td class="text-center">
                                            <span
                                                class="bg-success-focus text-success-main px-16 py-2 rounded-pill fw-medium text-sm">Basic</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-secondary-light">
                                            <div class="d-flex align-items-center gap-12">
                                                <span class="w-40-px h-40-px radius-4 overflow-hidden rounded-circle">
                                                    <img src="assets/images/user-grid/user-grid-img4.png" alt="Avatar"
                                                        class="w-100 h-100 object-fit-cover">
                                                </span>
                                                <span class="text-primary-light fw-semibold">Cody Fisher</span>
                                            </div>
                                        </td>
                                        <td class="text-secondary-light">#6352148</td>
                                        <td class="text-secondary-light">iPhone 14 max</td>
                                        <td class="text-secondary-light">1</td>
                                        <td class="text-secondary-light">$5,000.00</td>
                                        <td class="text-center">
                                            <span
                                                class="bg-warning-focus text-warning-main px-16 py-2 rounded-pill fw-medium text-sm">Paid</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-secondary-light">
                                            <div class="d-flex align-items-center gap-12">
                                                <span class="w-40-px h-40-px radius-4 overflow-hidden rounded-circle">
                                                    <img src="assets/images/user-grid/user-grid-img3.png" alt="Avatar"
                                                        class="w-100 h-100 object-fit-cover">
                                                </span>
                                                <span class="text-primary-light fw-semibold">Ronald Richards</span>
                                            </div>
                                        </td>
                                        <td class="text-secondary-light">#6352148</td>
                                        <td class="text-secondary-light">Laptop HPH </td>
                                        <td class="text-secondary-light">3</td>
                                        <td class="text-secondary-light">$1,000.00</td>
                                        <td class="text-center">
                                            <span
                                                class="bg-warning-focus text-warning-main px-16 py-2 rounded-pill fw-medium text-sm">Pending
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-secondary-light">
                                            <div class="d-flex align-items-center gap-12">
                                                <span class="w-40-px h-40-px radius-4 overflow-hidden rounded-circle">
                                                    <img src="assets/images/user-grid/user-grid-img2.png" alt="Avatar"
                                                        class="w-100 h-100 object-fit-cover">
                                                </span>
                                                <span class="text-primary-light fw-semibold">Albert Flores</span>
                                            </div>
                                        </td>
                                        <td class="text-secondary-light">#6352148</td>
                                        <td class="text-secondary-light">Smart Watch </td>
                                        <td class="text-secondary-light">7</td>
                                        <td class="text-secondary-light">$700.00</td>
                                        <td class="text-center">
                                            <span
                                                class="bg-primary-50 text-primary-600 px-16 py-2 rounded-pill fw-medium text-sm">Shipped</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-secondary-light">
                                            <div class="d-flex align-items-center gap-12">
                                                <span class="w-40-px h-40-px radius-4 overflow-hidden rounded-circle">
                                                    <img src="assets/images/user-grid/user-grid-img1.png" alt="Avatar"
                                                        class="w-100 h-100 object-fit-cover">
                                                </span>
                                                <span class="text-primary-light fw-semibold">Cameron Williamson</span>
                                            </div>
                                        </td>
                                        <td class="text-secondary-light">#6352148</td>
                                        <td class="text-secondary-light">Nike Air Shoe</td>
                                        <td class="text-secondary-light">3</td>
                                        <td class="text-secondary-light">$3,000.00</td>
                                        <td class="text-center">
                                            <span
                                                class="bg-danger-focus text-danger-main px-16 py-2 rounded-pill fw-medium text-sm">Cancel</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-secondary-light">
                                            <div class="d-flex align-items-center gap-12">
                                                <span class="w-40-px h-40-px radius-4 overflow-hidden rounded-circle">
                                                    <img src="assets/images/user-grid/user-grid-img7.png" alt="Avatar"
                                                        class="w-100 h-100 object-fit-cover">
                                                </span>
                                                <span class="text-primary-light fw-semibold">John Doe</span>
                                            </div>
                                        </td>
                                        <td class="text-secondary-light">#6352148</td>
                                        <td class="text-secondary-light">New Headphone</td>
                                        <td class="text-secondary-light">5</td>
                                        <td class="text-secondary-light">$4,000.00</td>
                                        <td class="text-center">
                                            <span
                                                class="bg-danger-focus text-danger-main px-16 py-2 rounded-pill fw-medium text-sm">Cancel</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-6">
                <div class="card h-100 radius-8 border">
                    <div class="card-body p-24">
                        <h6 class="mb-12 fw-bold text-lg mb-0">Daily Sales</h6>
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="fw-semibold mb-0">$27,200</h6>
                            <p class="text-sm mb-0">
                                <span
                                    class="bg-success-focus border border-success px-8 py-2 rounded-pill fw-semibold text-success-main text-sm d-inline-flex align-items-center gap-1">
                                    10%
                                    <iconify-icon icon="iconamoon:arrow-up-2-fill" class="icon"></iconify-icon>
                                </span>
                                Increases
                            </p>
                        </div>
                        <div id="recent-orders" class="mt-28"></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                            <h6 class="mb-2 fw-bold text-lg mb-0">Customers Statistics</h6>
                            <div class="">
                                <select
                                    class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                                    <option>Yearly</option>
                                    <option>Monthly</option>
                                    <option>Weekly</option>
                                    <option>Today</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-3 position-relative">
                            <div id="donutChart"
                                class="flex-grow-1 apexcharts-tooltip-z-none title-style circle-none min-h-236-px">
                            </div>
                            <h6 class="position-absolute bottom-0 start-50 translate-middle-x mb-40">40.5k</h6>
                        </div>

                        <ul class="d-flex flex-wrap align-items-center justify-content-center mt-56 gap-3">
                            <li class="d-flex align-items-center gap-2">
                                <span class="w-8-px h-8-px bg-primary-600"></span>
                                <span class="text-secondary-light text-sm fw-semibold">Male:
                                    <span class="text-primary-light fw-bold">20,000</span>
                                </span>
                            </li>
                            <li class="d-flex align-items-center gap-2">
                                <span class="w-8-px h-8-px bg-warning-600"></span>
                                <span class="text-secondary-light text-sm fw-semibold">Female:
                                    <span class="text-primary-light fw-bold"> 25,000</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-6">
                <div class="card radius-8 border-0">

                    <div class="card-body">
                        <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                            <h6 class="mb-2 fw-bold text-lg">Sales by Countrys</h6>
                            <div class="">
                                <select
                                    class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
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

                            <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                <div class="d-flex align-items-center w-100">
                                    <div class="flex-grow-1">
                                        <h6 class="text-sm mb-0">USA</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2 w-100">
                                    <div class="w-100 max-w-66 ms-auto">
                                        <div class="progress progress-sm rounded-pill" role="progressbar"
                                            aria-label="Success example" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <div class="progress-bar bg-primary-600 rounded-pill" style="width: 80%;">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-secondary-light font-xs fw-semibold">80%</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                <div class="d-flex align-items-center w-100">
                                    <div class="flex-grow-1">
                                        <h6 class="text-sm mb-0">Japan</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2 w-100">
                                    <div class="w-100 max-w-66 ms-auto">
                                        <div class="progress progress-sm rounded-pill" role="progressbar"
                                            aria-label="Success example" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <div class="progress-bar bg-orange rounded-pill" style="width: 60%;"></div>
                                        </div>
                                    </div>
                                    <span class="text-secondary-light font-xs fw-semibold">60%</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                <div class="d-flex align-items-center w-100">
                                    <div class="flex-grow-1">
                                        <h6 class="text-sm mb-0">France</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2 w-100">
                                    <div class="w-100 max-w-66 ms-auto">
                                        <div class="progress progress-sm rounded-pill" role="progressbar"
                                            aria-label="Success example" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <div class="progress-bar bg-yellow rounded-pill" style="width: 49%;"></div>
                                        </div>
                                    </div>
                                    <span class="text-secondary-light font-xs fw-semibold">49%</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center w-100">
                                    <div class="flex-grow-1">
                                        <h6 class="text-sm mb-0">Germany</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2 w-100">
                                    <div class="w-100 max-w-66 ms-auto">
                                        <div class="progress progress-sm rounded-pill" role="progressbar"
                                            aria-label="Success example" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <div class="progress-bar bg-success-main rounded-pill" style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-secondary-light font-xs fw-semibold">100%</span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                            <h6 class="mb-2 fw-bold text-lg mb-0">Top Customers</h6>
                            <a href="javascript:void(0)"
                                class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                View All
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                            </a>
                        </div>

                        <div class="mt-32 d-flex flex-column gap-32">

                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="assets/images/users/user6.png" alt="Image"
                                        class="w-40-px h-40-px radius-8 flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-normal">Dianne Russell</h6>
                                        <span class="text-sm text-secondary-light fw-normal">017******58</span>
                                    </div>
                                </div>
                                <span class="text-primary-light text-md fw-medium">Orders: 30</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="assets/images/users/user1.png" alt="Image"
                                        class="w-40-px h-40-px radius-8 flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-normal">Wade Warren</h6>
                                        <span class="text-sm text-secondary-light fw-normal">017******58</span>
                                    </div>
                                </div>
                                <span class="text-primary-light text-md fw-medium">Orders: 30</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="assets/images/users/user2.png" alt="Image"
                                        class="w-40-px h-40-px radius-8 flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-normal">Albert Flores</h6>
                                        <span class="text-sm text-secondary-light fw-normal">017******58</span>
                                    </div>
                                </div>
                                <span class="text-primary-light text-md fw-medium">Orders: 35</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="assets/images/users/user3.png" alt="Image"
                                        class="w-40-px h-40-px radius-8 flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-normal">Bessie Cooper</h6>
                                        <span class="text-sm text-secondary-light fw-normal">017******58</span>
                                    </div>
                                </div>
                                <span class="text-primary-light text-md fw-medium">Orders: 20</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="assets/images/users/user4.png" alt="Image"
                                        class="w-40-px h-40-px radius-8 flex-shrink-0">
                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-normal">Arlene McCoy</h6>
                                        <span class="text-sm text-secondary-light fw-normal">017******58</span>
                                    </div>
                                </div>
                                <span class="text-primary-light text-md fw-medium">Orders: 25</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8">
                <div class="card h-100">
                    <div class="card-body p-24">
                        <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                            <h6 class="mb-2 fw-bold text-lg mb-0">Top Selling Product</h6>
                            <a href="javascript:void(0)"
                                class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                View All
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                            </a>
                        </div>
                        <div class="table-responsive scroll-sm">
                            <table class="table bordered-table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Items</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Discount </th>
                                        <th scope="col">Sold</th>
                                        <th scope="col" class="text-center">Total Orders</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/product/product-img1.png" alt="Image"
                                                    class="flex-shrink-0 me-12 radius-8 me-12">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-normal">Blue t-shirt</h6>
                                                    <span class="text-sm text-secondary-light fw-normal">Fashion</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$500.00</td>
                                        <td>15%</td>
                                        <td>300</td>
                                        <td class="text-center">
                                            <span
                                                class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">70</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/product/product-img2.png" alt="Image"
                                                    class="flex-shrink-0 me-12 radius-8 me-12">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-normal">Nike Air Shoe</h6>
                                                    <span class="text-sm text-secondary-light fw-normal">Fashion</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$150.00</td>
                                        <td>N/A</td>
                                        <td>200</td>
                                        <td class="text-center">
                                            <span
                                                class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">70</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/product/product-img3.png" alt="Image"
                                                    class="flex-shrink-0 me-12 radius-8 me-12">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-normal">Woman Dresses</h6>
                                                    <span class="text-sm text-secondary-light fw-normal">Fashion</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$300.00</td>
                                        <td>$50.00</td>
                                        <td>1500</td>
                                        <td class="text-center">
                                            <span
                                                class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">70</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/product/product-img4.png" alt="Image"
                                                    class="flex-shrink-0 me-12 radius-8 me-12">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-normal">Smart Watch</h6>
                                                    <span class="text-sm text-secondary-light fw-normal">Fashion</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$400.00</td>
                                        <td>$50.00</td>
                                        <td>700</td>
                                        <td class="text-center">
                                            <span
                                                class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">70</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="assets/images/product/product-img5.png" alt="Image"
                                                    class="flex-shrink-0 me-12 radius-8 me-12">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-normal">Hoodie Rose</h6>
                                                    <span class="text-sm text-secondary-light fw-normal">Fashion</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$300.00</td>
                                        <td>25%</td>
                                        <td>500</td>
                                        <td class="text-center">
                                            <span
                                                class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">70</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4">
                <div class="card h-100">
                    <div class="card-body p-24">
                        <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                            <h6 class="mb-2 fw-bold text-lg mb-0">Stock Report</h6>
                            <a href="javascript:void(0)"
                                class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                View All
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                            </a>
                        </div>
                        <div class="table-responsive scroll-sm">
                            <table class="table bordered-table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Items</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">
                                            <div class="max-w-112 mx-auto">
                                                <span>Stock</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nike Air Shoes</td>
                                        <td>$500.00</td>
                                        <td>
                                            <div class="max-w-112 mx-auto">
                                                <div class="w-100">
                                                    <div class="progress progress-sm rounded-pill" role="progressbar"
                                                        aria-label="Success example" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-primary-600 rounded-pill"
                                                            style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                                <span class="mt-12 text-secondary-light text-sm fw-medium">Out of
                                                    Stock</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nike Air Shoes</td>
                                        <td>$300.00</td>
                                        <td>
                                            <div class="max-w-112 mx-auto">
                                                <div class="w-100">
                                                    <div class="progress progress-sm rounded-pill" role="progressbar"
                                                        aria-label="Success example" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-danger-main rounded-pill"
                                                            style="width: 40%;"></div>
                                                    </div>
                                                </div>
                                                <span class="mt-12 text-secondary-light text-sm fw-medium">18 Low
                                                    Stock</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nike Air Shoes</td>
                                        <td>$500.00</td>
                                        <td>
                                            <div class="max-w-112 mx-auto">
                                                <div class="w-100">
                                                    <div class="progress progress-sm rounded-pill" role="progressbar"
                                                        aria-label="Success example" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-success-main rounded-pill"
                                                            style="width: 80%;"></div>
                                                    </div>
                                                </div>
                                                <span class="mt-12 text-secondary-light text-sm fw-medium">80 High
                                                    Stock</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nike Air Shoes</td>
                                        <td>$300.00</td>
                                        <td>
                                            <div class="max-w-112 mx-auto">
                                                <div class="w-100">
                                                    <div class="progress progress-sm rounded-pill" role="progressbar"
                                                        aria-label="Success example" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-success-main rounded-pill"
                                                            style="width: 50%;"></div>
                                                    </div>
                                                </div>
                                                <span class="mt-12 text-secondary-light text-sm fw-medium">50 High
                                                    Stock</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nike Air Shoes</td>
                                        <td>$150.00</td>
                                        <td>
                                            <div class="max-w-112 mx-auto">
                                                <div class="w-100">
                                                    <div class="progress progress-sm rounded-pill" role="progressbar"
                                                        aria-label="Success example" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-success-main rounded-pill"
                                                            style="width: 70%;"></div>
                                                    </div>
                                                </div>
                                                <span class="mt-12 text-secondary-light text-sm fw-medium">70 High
                                                    Stock</span>
                                            </div>
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
</div>

<?php include './partials/layouts/layoutBottom.php' ?>