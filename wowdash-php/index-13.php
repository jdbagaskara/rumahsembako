<?php $script = '<script>
    // ================================ Vertical bar chart js Start ================================ 
    var options = {
        series: [{
            name: \'Ticket\',
            data: [6200, 5200, 4200, 3200]
        }],
        chart: {
            type: \'bar\',
            height: 270,
            toolbar: {
                show: false
            },
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
                distributed: true, // Enables individual bar styling
                barHeight: \'22px\'
            }
        },
        dataLabels: {
            enabled: false
        },
        grid: {
            show: true,
            borderColor: \'#ddd\',
            strokeDashArray: 0,
            position: \'back\',
            xaxis: {
              lines: {
                show: false
              }
            },   
            yaxis: {
              lines: {
                show: false
            }
          },  
        },
        xaxis: {
            categories: [\'High\', \'Medium\', \'Low\', \'Urgent\'],
            labels: {
              formatter: function (value) {
                  return (value / 1000).toFixed(0) + \'k\';
              }
            }
        },
        legend: {
            show: false
        },
        fill: {
            type: \'gradient\',
            gradient: {
                shade: \'light\',
                type: "horizontal",
                shadeIntensity: 0.5,
                gradientToColors: [\'#C98BFF\', \'#FFDC90\', \'#94FF9B\', \'#FFAC89\', \'#A3E2FE\'],
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        colors: [
            \'#8501F8\',
            \'#FF9F29\',
            \'#00D40E\',
            \'#F84B01\',
        ]
    };

    var chart = new ApexCharts(document.querySelector(\'#statisticBarChart\'), options);
    chart.render();
    // ================================ Vertical bar chart js End ================================ 


    // ===================== Average Enrollment Rate Start =============================== 
    function createChartTwo(chartId, color1, color2) {
        var options = {
            series: [{
                name: \'series1\',
                data: [48, 35, 55, 32, 48, 30, 55, 50, 57]
            }],
            legend: {
                show: false 
            },
            chart: {
                type: \'area\',
                width: 466,
                height: 86,
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: false // Removes shadow
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: \'smooth\',
                width: 3,
                colors: [color1, color2] // Use solid colors for the lines
            },
            fill: {
                type: \'solid\', 
                opacity: 0 // No gradient or shadow fill
            },
            grid: {
                show: false
            },
            markers: {
                colors: [color1, color2], // Use two colors for the markers
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
                }
            },
            yaxis: {
                labels: {
                    show: false
                }
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

    createChartTwo(\'enrollmentChart\', \'#487FFF\', \'#FF9F29\');
    // ===================== Average Enrollment Rate End ===============================


    // ============================ Multiple series Chart Start ==========================
    var options = {
        series: [20, 22, 28, 10],
        chart: {
          type: \'polarArea\',
          height: 264,
        },
        labels: [\'Product 1\', \'Product 2\', \'Product 3\', \'Product 4\'],
        colors: [\'#487FFF\', \'#FF9F29\', \'#9935FE\', \'#EF4A00\'], 
        stroke: {
            colors: [\'#487FFF\', \'#FF9F29\', \'#9935FE\', \'#EF4A00\'], 
        },
        fill: {
          opacity: 0.8
        },
        legend: {
            show: false, 
            position: \'bottom\',
            horizontalAlign: \'center\' // Align the legend horizontally
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
        }]
    };

    var chart = new ApexCharts(document.querySelector(\'#multipleSeriesChart\'), options);
    chart.render();
    // ============================ Multiple series Chart End ==========================

    // ===================== Average Enrollment Rate Start =============================== 
    function createChartOne(chartId, color1, color2) {
        var options = {
            series: [{
                name: \'Pending\',
                data: [480, 350, 550, 320, 480, 300, 550, 500, 570]
            }, {
                name: \'Solved\',
                data: [120, 200, 150, 260, 220, 600, 400, 480, 250]
            }],
            legend: {
                show: false 
            },
            chart: {
                type: \'area\',
                width: \'100%\',
                height: 200,
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
                colors: [color1, color2], // Use two colors for the lines
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
            colors: [color1, color2], // Set color for series
            fill: {
                type: \'gradient\',
                colors: [color1, color2], // Use two colors for the gradient
                gradient: {
                    shade: \'light\',
                    type: \'vertical\',
                    shadeIntensity: 0.5,
                    gradientToColors: [undefined, `${color2}00`],
                    inverseColors: false,
                    opacityFrom: [0, 0],
                    opacityTo: [0, 0],
                    stops: [0, 100],
                },
            },
            markers: {
                colors: [color1, color2], // Use two colors for the markers
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
            tooltip: {
                x: {
                    format: \'dd/MM/yy HH:mm\'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector(\'#\' + chartId), options);
        chart.render();
    }

    createChartOne(\'pendingSolvedTicket\', \'#45B369\', \'#FF9F29\');
    // ===================== Average Enrollment Rate End =============================== 
    
    
    



    // ================================ Semi Circle Gauge chart Start ================================ 
    var options = {
        series: [75],
        chart: {
            width: 400,
            height: 300,
            type: \'radialBar\',
            sparkline: {
                enabled: true,
            },
            toolbar: {
                show: false,
            },
        },
        plotOptions: {
            radialBar: {
            offsetY: -24,
            offsetX: -14,
            startAngle: -90,
            endAngle: 90,
            track: {
                background: \'#E3E6E9\',
                strokeWidth: \'70%\', 
            },
            hollow: {
                size: \'70%\', 
            },
            dataLabels: {
                show: false,
                
                value: {
                    fontSize: \'22px\',
                    fontWeight: 600,
                    color: \'#487FFF\',
                    offsetY: 16,
                },
            },
            },
        },
        fill: {
            type: \'gradient\',
            colors: [\'#9DBAFF\'],
            gradient: {
            shade: \'dark\',
            type: \'horizontal\',
            shadeIntensity: 0.5,
            gradientToColors: [\'#487FFF\'],
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100],
            },
        },
        stroke: {
            lineCap: \'round\',
        },
    };

    var chart = new ApexCharts(document.querySelector(\'#semiCircleGaugeTwo\'), options);
    chart.render();
    // ================================ Semi Circle Gauge chart End ================================ 
</script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

  <div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Help Desk</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Help Desk</li>
        </ul>
    </div>
    
    <div class="row gy-4">
        <div class="col-lg-8">
            <div class="shadow-7 p-20 radius-12 bg-base z-1 gradient-bg-chart position-relative h-100">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-3">
                    <h6 class="mb-2 fw-bold text-lg">Task Summary</h6>
                </div>
                <div class="row gy-4">
                    <div class="col-xxxl-3 col-sm-6">
                        <div class="radius-12 overflow-hidden p-20 position-relative z-1 bg-gradient-custom-1">
                            <img src="assets/images/homeThirteen/shape/moon-shape-border.png" alt="Shape" class="position-absolute start-0 bottom-0 mb-10 z-n1">
                            <span class="d-block text-base mb-24">New Resolved</span>
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <h5 class="text-base">2.5k</h5>
                                <span class="opacity-25">
                                    <img src="assets/images/homeThirteen/icon/task-summary-icon1.svg" alt="Icon" class="">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxxl-3 col-sm-6">
                        <div class="radius-12 overflow-hidden p-20 position-relative z-1 bg-gradient-custom-2">
                            <img src="assets/images/homeThirteen/shape/moon-shape-border.png" alt="Shape" class="position-absolute start-0 bottom-0 mb-10 z-n1">
                            <span class="d-block text-base mb-24">Tickets In Progress</span>
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <h5 class="text-base">2.5k</h5>
                                <span class="opacity-25">
                                    <img src="assets/images/homeThirteen/icon/task-summary-icon2.svg" alt="Icon" class="">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxxl-3 col-sm-6">
                        <div class="radius-12 overflow-hidden p-20 position-relative z-1 bg-gradient-custom-3">
                            <img src="assets/images/homeThirteen/shape/moon-shape-border.png" alt="Shape" class="position-absolute start-0 bottom-0 mb-10 z-n1">
                            <span class="d-block text-base mb-24">Tickets Due</span>
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <h5 class="text-base">2.5k</h5>
                                <span class="opacity-25">
                                    <img src="assets/images/homeThirteen/icon/task-summary-icon3.svg" alt="Icon" class="">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxxl-3 col-sm-6">
                        <div class="radius-12 overflow-hidden p-20 position-relative z-1 bg-gradient-custom-4">
                            <img src="assets/images/homeThirteen/shape/moon-shape-border.png" alt="Shape" class="position-absolute start-0 bottom-0 mb-10 z-n1">
                            <span class="d-block text-base mb-24">Tickets Resolved</span>
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <h5 class="text-base">2.5k</h5>
                                <span class="opacity-25">
                                    <img src="assets/images/homeThirteen/icon/task-summary-icon4.svg" alt="Icon" class="">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-20 d-flex align-items-center justify-content-between gap-4 flex-wrap">
                    <div class="">
                        <span class="text-secondary-light">On Time Completion Rate</span>
                        <div class="d-flex align-items-center gap-3 mt-8">
                            <h5 class="mb-0">98%</h5>
                            <div class="d-flex align-items-center gap-1 text-success-600 fw-semibold">
                                <span class="line-height-1 d-flex"><i class="ri-arrow-right-up-line"></i></span>
                                <span class="">2.73%</span>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div id="enrollmentChart" class="apexcharts-tooltip-style-1"></div>
                    </div>

                </div>
                
            </div>
        </div>
        <div class="col-lg-4">
            <div class="shadow-7 p-20 radius-12 bg-base h-100">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                    <h6 class="mb-2 fw-bold text-lg">Ticket Priority</h6>
                </div>
                <div class="position-relative">
                    <div id="statisticBarChart" class="text-style"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="shadow-7 p-0 radius-12 bg-base overflow-hidden h-100">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between py-12 px-20 border-bottom border-neutral-200">
                    <h6 class="mb-0 fw-bold text-lg">Ticket Status</h6>
                    <div class="">
                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                        <option>Yearly</option>
                        <option>Monthly</option>
                        <option>Weekly</option>
                        <option>Today</option>
                    </select>
                    </div>
                </div>
                <div class="card-body p-20">
                    <div id="multipleSeriesChart" class="apexcharts-tooltip-z-none square-marker check-marker series-gap-24 d-flex justify-content-center"></div>

                    <div class="d-flex align-items-center gap-3 text-sm justify-content-center">
                        <span class="text-secondary-light fw-medium">Pending: <span class="fw-semibold text-warning-600">32</span> </span>
                        <span class="text-secondary-light fw-medium">Hold: <span class="fw-semibold text-purple">10</span> </span>
                        <span class="text-secondary-light fw-medium">Complete: <span class="fw-semibold text-success-600">25</span> </span>
                        <span class="text-secondary-light fw-medium">Cancelled: <span class="fw-semibold text-danger-600">28</span> </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="shadow-7 p-0 radius-12 bg-base h-100 overflow-hidden">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between py-12 px-20 border-bottom border-neutral-200">
                    <h6 class="mb-0 fw-bold text-lg">Pending Vs Solved Tickets</h6>
                    <div class="">
                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                        <option>Yearly</option>
                        <option>Monthly</option>
                        <option>Weekly</option>
                        <option>Today</option>
                    </select>
                    </div>
                </div>
                <div class="card-body p-20">
                    <ul class="d-flex flex-wrap align-items-center justify-content-center my-3 gap-3">
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-8-px rounded-pill bg-warning-600"></span>
                            <div class="d-flex align-items-center gap-1">
                                <span class="text-secondary-light text-sm fw-semibold">Pending: </span>
                                <h6 class="text-primary-light fw-bold">505</h6>
                            </div>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-8-px rounded-pill bg-success-600"></span>
                            <div class="d-flex align-items-center gap-1">
                                <span class="text-secondary-light text-sm fw-semibold">Solved:</span>
                                <h6 class="text-primary-light fw-bold">  700</h6>
                            </div>
                        </li>
                    </ul>
                    <div id="pendingSolvedTicket" class="apexcharts-tooltip-style-1"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="shadow-7 radius-12 bg-base h-100 overflow-hidden">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">To Do List</h6>
                    <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                    View All
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table table-py-8 mb-0 rounded-0 border-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="rounded-0">
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-300 input-form-dark" type="checkbox" name="checkbox" id="selectAll">
                                            </div>
                                            ID
                                        </div>
                                    </th>
                                    <th scope="col" class="rounded-0">Task Name</th>
                                    <th scope="col" class="rounded-0">Assigned To</th>
                                    <th scope="col" class="rounded-0">Due Date</th>
                                    <th scope="col" class="rounded-0">Priority</th>
                                    <th scope="col" class="rounded-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-300 input-form-dark" type="checkbox" name="checkbox">
                                            </div>
                                            26531
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">Mobile app Development</td>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center">
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8">
                                                <img src="assets/images/homeThirteen/todo-list-img1.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8 ms--10px">
                                                <img src="assets/images/homeThirteen/todo-list-img2.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8 ms--10px">
                                                <img src="assets/images/homeThirteen/todo-list-img3.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8 ms--10px">
                                                <img src="assets/images/homeThirteen/todo-list-img4.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <label class="w-36-px h-36-px border border-white rounded-circle shadow-8 ms--10px d-inline-flex justify-content-center align-items-center bg-primary-600 text-white" for="uploadImage">
                                                <i class="ri-add-fill"></i>
                                                <input type="file" id="uploadImage" hidden>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">Feb 10, 2025</td>
                                    <td class="text-secondary-light">High</td>
                                    <td class="text-center"> 
                                        <span class="bg-success-focus text-success-main px-16 py-2 radius-4 fw-medium text-sm">Basic</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-300 input-form-dark" type="checkbox" name="checkbox">
                                            </div>
                                            26531
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">Product design</td>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center">
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8">
                                                <img src="assets/images/homeThirteen/todo-list-img1.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8 ms--10px">
                                                <img src="assets/images/homeThirteen/todo-list-img2.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8 ms--10px">
                                                <img src="assets/images/homeThirteen/todo-list-img3.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">Feb 10, 2025</td>
                                    <td class="text-secondary-light">Low</td>
                                    <td class="text-center"> 
                                        <span class="bg-warning-focus text-warning-main px-16 py-2 radius-4 fw-medium text-sm">Standard</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-300 input-form-dark" type="checkbox" name="checkbox">
                                            </div>
                                            26531
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">UI/UX Design</td>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center">
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8">
                                                <img src="assets/images/homeThirteen/todo-list-img1.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8 ms--10px">
                                                <img src="assets/images/homeThirteen/todo-list-img2.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">Feb 10, 2025</td>
                                    <td class="text-secondary-light">Medium</td>
                                    <td class="text-center"> 
                                        <span class="bg-info-focus text-info-main px-16 py-2 radius-4 fw-medium text-sm">Premium </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-300 input-form-dark" type="checkbox" name="checkbox">
                                            </div>
                                            26531
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">Website ui design</td>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center">
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8">
                                                <img src="assets/images/homeThirteen/todo-list-img1.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8 ms--10px">
                                                <img src="assets/images/homeThirteen/todo-list-img2.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8 ms--10px">
                                                <img src="assets/images/homeThirteen/todo-list-img3.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">Feb 10, 2025</td>
                                    <td class="text-secondary-light">High</td>
                                    <td class="text-center"> 
                                        <span class="bg-success-focus text-success-main px-16 py-2 radius-4 fw-medium text-sm">Basic</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center gap-10">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input radius-4 border border-neutral-300 input-form-dark" type="checkbox" name="checkbox">
                                            </div>
                                            26531
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">PHP Project </td>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center">
                                            <span class="w-36-px h-36-px border border-white rounded-circle shadow-8">
                                                <img src="assets/images/homeThirteen/todo-list-img1.png" alt="Image" class="w-100 h-100 object-fit-cover">
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">Feb 10, 2025</td>
                                    <td class="text-secondary-light">Low</td>
                                    <td class="text-center"> 
                                        <span class="bg-warning-focus text-warning-main px-16 py-2 radius-4 fw-medium text-sm">Standard</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="shadow-7 radius-12 bg-base h-100 overflow-hidden">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Top Podcaster</h6>
                    <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                    View All
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>
                <div class="card-body p-20 d-flex flex-column gap-20">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center">
                            <img src="assets/images/homeThirteen/podcaster-img1.png" alt="Image" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="text-md mb-0 fw-medium">Digital Assets</h6>
                                <span class="text-sm text-secondary-light fw-medium">UI Design</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <div class="d-flex align-items-center gap-1">
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                            </div>
                            <span class="text-primary-light text-sm d-block text-end fw-semibold">5.00</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center">
                            <img src="assets/images/homeThirteen/podcaster-img2.png" alt="Image" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="text-md mb-0 fw-medium">Side Project</h6>
                                <span class="text-sm text-secondary-light fw-medium">Business</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <div class="d-flex align-items-center gap-1">
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-neutral-300 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-neutral-300 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                            </div>
                            <span class="text-primary-light text-sm d-block text-end fw-semibold">3.50</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center">
                            <img src="assets/images/homeThirteen/podcaster-img3.png" alt="Image" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="text-md mb-0 fw-medium">Investment</h6>
                                <span class="text-sm text-secondary-light fw-medium">Lifestyle</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <div class="d-flex align-items-center gap-1">
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-neutral-300 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-neutral-300 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-neutral-300 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                            </div>
                            <span class="text-primary-light text-sm d-block text-end fw-semibold">2.50</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center">
                            <img src="assets/images/homeThirteen/podcaster-img4.png" alt="Image" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="text-md mb-0 fw-medium">Investment</h6>
                                <span class="text-sm text-secondary-light fw-medium">Lifestyle</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <div class="d-flex align-items-center gap-1">
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-neutral-300 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                            </div>
                            <span class="text-primary-light text-sm d-block text-end fw-semibold">4.38</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center">
                            <img src="assets/images/homeThirteen/podcaster-img5.png" alt="Image" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="text-md mb-0 fw-medium">Investment</h6>
                                <span class="text-sm text-secondary-light fw-medium">Lifestyle</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <div class="d-flex align-items-center gap-1">
                                <span class="text-md text-warning-600 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-neutral-300 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-neutral-300 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-neutral-300 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-md text-neutral-300 d-flex line-height-1"><i class="ri-star-fill"></i></span>
                            </div>
                            <span class="text-primary-light text-sm d-block text-end fw-semibold">1.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="shadow-7 radius-12 bg-base h-100 overflow-hidden">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Performance of Agents</h6>
                    <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                    View All
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table table-py-8 mb-0 rounded-0 border-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="rounded-0">Agent Name</th>
                                    <th scope="col" class="rounded-0">ID Number</th>
                                    <th scope="col" class="rounded-0">Total Tickets</th>
                                    <th scope="col" class="rounded-0">Open Tickets</th>
                                    <th scope="col" class="rounded-0">Resolved Ticket</th>
                                    <th scope="col" class="rounded-0">Satisfaction Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center gap-12">
                                            <span class="w-40-px h-40-px radius-4 overflow-hidden rounded-circle">
                                                <img src="assets/images/users/user1.png" alt="Avatar" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="text-secondary-light">Dianne Russell</span>
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">26531</td>
                                    <td class="text-secondary-light">300</td>
                                    <td class="text-secondary-light">250</td>
                                    <td class="text-secondary-light">50</td>
                                    <td> 
                                        <div class="max-w-112 mx-auto">
                                          <div class="w-100">
                                            <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                              <div class="progress-bar bg-red rounded-pill" style="width: 30%;"></div>
                                            </div>
                                          </div>
                                          <span class="mt-8 text-black text-sm fw-medium">30%</span>                                
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center gap-12">
                                            <span class="w-40-px h-40-px radius-4 overflow-hidden rounded-circle">
                                                <img src="assets/images/users/user2.png" alt="Avatar" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="text-secondary-light">Wade Warren</span>
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">26531</td>
                                    <td class="text-secondary-light">300</td>
                                    <td class="text-secondary-light">250</td>
                                    <td class="text-secondary-light">50</td>
                                    <td> 
                                        <div class="max-w-112 mx-auto">
                                          <div class="w-100">
                                            <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                              <div class="progress-bar bg-warning rounded-pill" style="width: 50%;"></div>
                                            </div>
                                          </div>
                                          <span class="mt-8 text-black text-sm fw-medium">50%</span>                                
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center gap-12">
                                            <span class="w-40-px h-40-px radius-4 overflow-hidden rounded-circle">
                                                <img src="assets/images/users/user3.png" alt="Avatar" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="text-secondary-light">Albert Flores</span>
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">26531</td>
                                    <td class="text-secondary-light">300</td>
                                    <td class="text-secondary-light">250</td>
                                    <td class="text-secondary-light">50</td>
                                    <td> 
                                        <div class="max-w-112 mx-auto">
                                          <div class="w-100">
                                            <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                              <div class="progress-bar bg-info-main rounded-pill" style="width: 60%;"></div>
                                            </div>
                                          </div>
                                          <span class="mt-8 text-black text-sm fw-medium">60%</span>                                
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center gap-12">
                                            <span class="w-40-px h-40-px radius-4 overflow-hidden rounded-circle">
                                                <img src="assets/images/users/user4.png" alt="Avatar" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="text-secondary-light">Bessie Cooper</span>
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">26531</td>
                                    <td class="text-secondary-light">300</td>
                                    <td class="text-secondary-light">250</td>
                                    <td class="text-secondary-light">50</td>
                                    <td> 
                                        <div class="max-w-112 mx-auto">
                                          <div class="w-100">
                                            <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                              <div class="progress-bar bg-success-main rounded-pill" style="width: 80%;"></div>
                                            </div>
                                          </div>
                                          <span class="mt-8 text-black text-sm fw-medium">80%</span>                                
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-secondary-light">
                                        <div class="d-flex align-items-center gap-12">
                                            <span class="w-40-px h-40-px radius-4 overflow-hidden rounded-circle">
                                                <img src="assets/images/users/user1.png" alt="Avatar" class="w-100 h-100 object-fit-cover">
                                            </span>
                                            <span class="text-secondary-light">Arlene McCoy</span>
                                        </div>
                                    </td>
                                    <td class="text-secondary-light">26531</td>
                                    <td class="text-secondary-light">300</td>
                                    <td class="text-secondary-light">250</td>
                                    <td class="text-secondary-light">50</td>
                                    <td> 
                                        <div class="max-w-112 mx-auto">
                                          <div class="w-100">
                                            <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                              <div class="progress-bar bg-red rounded-pill" style="width: 75%;"></div>
                                            </div>
                                          </div>
                                          <span class="mt-8 text-black text-sm fw-medium">75%</span>                                
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="shadow-7 p-0 radius-12 bg-base overflow-hidden">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between py-12 px-20 border-bottom border-neutral-200">
                    <h6 class="mb-0 fw-bold text-lg">Response Time</h6>
                    <div class="">
                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                        <option>Yearly</option>
                        <option>Monthly</option>
                        <option>Weekly</option>
                        <option>Today</option>
                    </select>
                    </div>
                </div>
                <div class="card-body p-20">
                    <div class="shadow-7 p-24 radius-12 bg-base h-100">
                        <div class="text-center">
                            <div class="position-relative">
                                <div id="semiCircleGaugeTwo" class="big-semi-circle-gauge d-flex justify-content-center"></div>
                                <span class="w-90-px h-90-px rounded-circle bg-neutral-50 d-flex justify-content-center align-items-center position-absolute start-50 translate-middle-x top-50">
                                    <img src="assets/images/homeThirteen/icon/time-icon.svg" alt="Icon">
                                </span>
                            </div>
                            <h3 class="mt-40 mb-0">454h</h3>
                            <span class="text-neutral-800 mt-4">1 hrs : 22 mins</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    

    
  </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
