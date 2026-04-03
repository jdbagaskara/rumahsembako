<?php $script = '<script>

    // ================================ Revenue Growth Area Chart Start ================================ 
    function createChartTwo(chartId, chartColor) {

        var options = {
            series: [
                {
                    name: \'This Day\',
                    data: [4, 18, 13, 40, 30, 50, 30, 60, 40, 75, 45, 90],
                },
            ],
            chart: {
                type: \'area\',
                width: \'100%\',
                height: 64,
                sparkline: {
                    enabled: true
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
                width: 2,
                colors: [chartColor],
                lineCap: \'round\'
            },
            grid: {
                show: true,
                borderColor: \'red\',
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
                row: {
                    colors: undefined,
                    opacity: 0.5
                },
                column: {
                    colors: undefined,
                    opacity: 0.5
                },
                padding: {
                    top: -4,
                    right: 0,
                    bottom: -6,
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
                labels: { show: false },
                axisBorder: { show: false },
                axisTicks: { show: false },
                categories: [
                    \'Jan\', \'Feb\', \'Mar\', \'Apr\', \'May\', \'Jun\',
                    \'Jul\', \'Aug\', \'Sep\', \'Oct\', \'Nov\', \'Dec\'
                ]
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
    createChartTwo(\'total-users-chart\', \'#487FFF\');
    createChartTwo(\'total-order-chart\', \'#FF9F29\');
    // ================================ Revenue Growth Area Chart End ================================ 

    // ================================ Bars Up Down (Earning Statistics) chart Start ================================ 
    var options = {
        series: [
            {
                name: "Income",
                data: [44, 42, 57, 86, 58, 55, 70, 44, 42, 57, 86, 58, 55, 70],
            },
            {
                name: "Expenses",
                data: [-34, -22, -37, -56, -21, -35, -60, -34, -22, -37, -56, -21, -35, -60],
            },
        ],
        chart: {
            stacked: true,
            type: "bar",
            height: 64,
            fontFamily: "Poppins, sans-serif",
            toolbar: {
                show: false,
            },
            sparkline: {
                enabled: true
            },
        },
        colors: ["#9935fe26", "#9935FE"],
        plotOptions: {
            bar: {
                columnWidth: "8",
                borderRadius: [2],
                borderRadiusWhenStacked: "all",
            },
        },
        stroke: {
            width: [5, 5]
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: false,
            position: "top",
        },
        yaxis: {
            show: false,
            title: {
                text: undefined,
            },
            labels: {
                formatter: function (y) {
                    return y.toFixed(0) + "";
                },
            },
        },
        xaxis: {
            categories: [
                "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun",
                "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"
            ],
            show: false,
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                style: {
                    colors: "#d4d7d9",
                    fontSize: "10px",
                    fontWeight: 500,
                },
            },
        },
        tooltip: {
            enabled: true,
            shared: true,
            intersect: false,
            theme: "dark",
            x: {
                show: false,
            },
        },
    };
    var chart = new ApexCharts(document.querySelector("#upDownBarchart"), options);
    chart.render();
    // ================================ Bars Up Down (Earning Statistics) chart End ================================ 

    // ================================ Revenue Report Chart Start ================================ 
    var options = {
        series: [{
            name: \'Net Profit\',
            data: [20000, 16000, 14000, 25000, 45000, 18000, 28000, 11000, 26000, 48000, 18000, 22000]
        }],
        colors: [\'#22c55e\'],
        labels: [\'Active\', \'New\', \'Total\'],
        legend: {
            show: false
        },
        chart: {
            type: \'bar\',
            height: 74,
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            },
        },
        grid: {
            show: true,
            borderColor: \'#ff000000\',
            strokeDashArray: 4,
            position: \'back\',
        },
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: 16,
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: [\'transparent\']
        },
        xaxis: {
            categories: [\'Jan\', \'Feb\', \'Mar\', \'Apr\', \'May\', \'Jun\', \'Jul\', \'Aug\', \'Sep\', \'Oct\', \'Nov\', \'Dec\'],
            show: false,
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
            },
        },
        yaxis: {
            categories: [\'0\', \'5000\', \'10,000\', \'20,000\', \'30,000\', \'50,000\', \'60,000\', \'60,000\', \'70,000\', \'80,000\', \'90,000\', \'100,000\'],
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
            },
        },
        fill: {
            opacity: 1,
            width: 18,
        },
    };

    var chart = new ApexCharts(document.querySelector("#orderValue"), options);
    chart.render();
    // ================================ Revenue Report Chart End ================================ 

    // ================================ Earning Statistics bar chart Start ================================ 
    var options = {
        series: [{
            name: "Sales",
            data: [{
                x: \'Jan\',
                y: 85000,
            }, {
                x: \'Feb\',
                y: 70000,
            }, {
                x: \'Mar\',
                y: 40000,
            }, {
                x: \'Apr\',
                y: 50000,
            }, {
                x: \'May\',
                y: 60000,
            }, {
                x: \'Jun\',
                y: 50000,
            }, {
                x: \'Jul\',
                y: 40000,
            }, {
                x: \'Aug\',
                y: 50000,
            }, {
                x: \'Sep\',
                y: 40000,
            }, {
                x: \'Oct\',
                y: 60000,
            }, {
                x: \'Nov\',
                y: 30000,
            }, {
                x: \'Dec\',
                y: 50000,
            }]
        }],
        chart: {
            type: \'bar\',
            height: 240,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: false,
                columnWidth: \'23%\',
                endingShape: \'rounded\',
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: \'gradient\',
            colors: [\'#487FFF\'],
            gradient: {
                shade: \'light\',
                type: \'vertical\',
                shadeIntensity: 0.5,
                gradientToColors: [\'#487FFF\'],
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100],
            },
        },
        grid: {
            show: true,
            borderColor: \'#D1D5DB\',
            strokeDashArray: 4,
            position: \'back\',
        },
        xaxis: {
            type: \'category\',
            categories: [\'Jan\', \'Feb\', \'Mar\', \'Apr\', \'May\', \'Jun\', \'Jul\', \'Aug\', \'Sep\', \'Oct\', \'Nov\', \'Dec\']
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return (value / 1000).toFixed(0) + \'k\';
                }
            }
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return value / 1000 + \'k\';
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#barChart"), options);
    chart.render();
    // ================================ Earning Statistics bar chart End ================================ 

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

    // ================================ Users Overview Donut chart Start ================================ 
    var options = {
        series: [300, 200, 500, 172],
        colors: [\'#487FFF\', \'#9935FE\', \'#FF9F29\', "#45B369"],
        labels: [\'Total Visitors\', \'Registrations\', \'Total Page Views\', \'Registrations\'],
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
    };

    var chart = new ApexCharts(document.querySelector("#userOverviewDonutChart"), options);
    chart.render();
    // ================================ Users Overview Donut chart End ================================ 

    // ================================ User Traffic chart Start ================================ 
    var options = {
        series: [{
            data: [
                [1327359600000, 30.95],
                [1327446000000, 31.34],
                [1327532400000, 31.18],
                [1327618800000, 31.05],
                [1327878000000, 31.00],
                [1327964400000, 30.95],
                [1328050800000, 31.24],
                [1328137200000, 31.29],
                [1328223600000, 31.85],
                [1328482800000, 31.86],
                [1328569200000, 32.28],
                [1328655600000, 32.10],
                [1328742000000, 32.65],
                [1328828400000, 32.21],
                [1329087600000, 32.35],
                [1329174000000, 32.44],
                [1329260400000, 32.46],
                [1329346800000, 32.86],
                [1329433200000, 32.75],
                [1329778800000, 32.54],
                [1329865200000, 32.33],
                [1329951600000, 32.97],
                [1330038000000, 33.41],
                [1330297200000, 33.27],
                [1330383600000, 33.27],
                [1330470000000, 32.89],
                [1330556400000, 33.10],
                [1330642800000, 33.73],
                [1330902000000, 33.22],
                [1330988400000, 31.99],
                [1331074800000, 32.41],
                [1331161200000, 33.05],
                [1331247600000, 33.64],
                [1331506800000, 33.56],
                [1331593200000, 34.22],
                [1331679600000, 33.77],
                [1331766000000, 34.17],
                [1331852400000, 33.82],
                [1332111600000, 34.51],
                [1332198000000, 33.16],
                [1332284400000, 33.56],
                [1332370800000, 33.71],
                [1332457200000, 33.81],
                [1332712800000, 34.40],
                [1332799200000, 34.63],
                [1332885600000, 34.46],
                [1332972000000, 34.48],
                [1333058400000, 34.31],
                [1333317600000, 34.70],
                [1333404000000, 34.31],
                [1333490400000, 33.46],
                [1333576800000, 33.59],
                [1333922400000, 33.22],
                [1334008800000, 32.61],
                [1334095200000, 33.01],
                [1334181600000, 33.55],
                [1334268000000, 33.18],
                [1334527200000, 32.84],
                [1334613600000, 33.84],
                [1334700000000, 33.39],
                [1334786400000, 32.91],
                [1334872800000, 33.06],
                [1335132000000, 32.62],
                [1335218400000, 32.40],
                [1335304800000, 33.13],
                [1335391200000, 33.26],
                [1335477600000, 33.58],
                [1335736800000, 33.55],
                [1335823200000, 33.77],
                [1335909600000, 33.76],
                [1335996000000, 33.32],
                [1336082400000, 32.61],
                [1336341600000, 32.52],
                [1336428000000, 32.67],
                [1336514400000, 32.52],
                [1336600800000, 31.92],
                [1336687200000, 32.20],
                [1336946400000, 32.23],
                [1337032800000, 32.33],
                [1337119200000, 32.36],
                [1337205600000, 32.01],
                [1337292000000, 31.31],
                [1337551200000, 32.01],
                [1337637600000, 32.01],
                [1337724000000, 32.18],
                [1337810400000, 31.54],
                [1337896800000, 31.60],
                [1338242400000, 32.05],
                [1338328800000, 31.29],
                [1338415200000, 31.05],
                [1338501600000, 29.82],
                [1338760800000, 30.31],
                [1338847200000, 30.70],
                [1338933600000, 31.69],
                [1339020000000, 31.32],
                [1339106400000, 31.65],
                [1339365600000, 31.13],
                [1339452000000, 31.77],
                [1339538400000, 31.79],
                [1339624800000, 31.67],
                [1339711200000, 32.39],
                [1339970400000, 32.63],
                [1340056800000, 32.89],
                [1340143200000, 31.99],
                [1340229600000, 31.23],
                [1340316000000, 31.57],
                [1340575200000, 30.84],
                [1340661600000, 31.07],
                [1340748000000, 31.41],
                [1340834400000, 31.17],
                [1340920800000, 32.37],
                [1341180000000, 32.19],
                [1341266400000, 32.51],
                [1341439200000, 32.53],
                [1341525600000, 31.37],
                [1341784800000, 30.43],
                [1341871200000, 30.44],
                [1341957600000, 30.20],
                [1342044000000, 30.14],
                [1342130400000, 30.65],
                [1342389600000, 30.40],
                [1342476000000, 30.65],
                [1342562400000, 31.43],
                [1342648800000, 31.89],
                [1342735200000, 31.38],
                [1342994400000, 30.64],
                [1343080800000, 30.02],
                [1343167200000, 30.33],
                [1343253600000, 30.95],
                [1343340000000, 31.89],
                [1343599200000, 31.01],
                [1343685600000, 30.88],
                [1343772000000, 30.69],
                [1343858400000, 30.58],
                [1343944800000, 32.02],
                [1344204000000, 32.14],
                [1344290400000, 32.37],
                [1344376800000, 32.51],
                [1344463200000, 32.65],
                [1344549600000, 32.64],
                [1344808800000, 32.27],
                [1344895200000, 32.10],
                [1344981600000, 32.91],
                [1345068000000, 33.65],
                [1345154400000, 33.80],
                [1345413600000, 33.92],
                [1345500000000, 33.75],
                [1345586400000, 33.84],
                [1345672800000, 33.50],
                [1345759200000, 32.26],
                [1346018400000, 32.32],
                [1346104800000, 32.06],
                [1346191200000, 31.96],
                [1346277600000, 31.46],
                [1346364000000, 31.27],
                [1346709600000, 31.43],
                [1346796000000, 32.26],
                [1346882400000, 32.79],
                [1346968800000, 32.46],
                [1347228000000, 32.13],
                [1347314400000, 32.43],
                [1347400800000, 32.42],
                [1347487200000, 32.81],
                [1347573600000, 33.34],
                [1347832800000, 33.41],
                [1347919200000, 32.57],
                [1348005600000, 33.12],
                [1348092000000, 34.53],
                [1348178400000, 33.83],
                [1348437600000, 33.41],
                [1348524000000, 32.90],
                [1348610400000, 32.53],
                [1348696800000, 32.80],
                [1348783200000, 32.44],
                [1349042400000, 32.62],
                [1349128800000, 32.57],
                [1349215200000, 32.60],
                [1349301600000, 32.68],
                [1349388000000, 32.47],
                [1349647200000, 32.23],
                [1349733600000, 31.68],
                [1349820000000, 31.51],
                [1349906400000, 31.78],
                [1349992800000, 31.94],
                [1350252000000, 32.33],
                [1350338400000, 33.24],
                [1350424800000, 33.44],
                [1350511200000, 33.48],
                [1350597600000, 33.24],
                [1350856800000, 33.49],
                [1350943200000, 33.31],
                [1351029600000, 33.36],
                [1351116000000, 33.40],
                [1351202400000, 34.01],
                [1351638000000, 34.02],
                [1351724400000, 34.36],
                [1351810800000, 34.39],
                [1352070000000, 34.24],
                [1352156400000, 34.39],
                [1352242800000, 33.47],
                [1352329200000, 32.98],
                [1352415600000, 32.90],
                [1352674800000, 32.70],
                [1352761200000, 32.54],
                [1352847600000, 32.23],
                [1352934000000, 32.64],
                [1353020400000, 32.65],
                [1353279600000, 32.92],
                [1353366000000, 32.64],
                [1353452400000, 32.84],
                [1353625200000, 33.40],
                [1353884400000, 33.30],
                [1353970800000, 33.18],
                [1354057200000, 33.88],
                [1354143600000, 34.09],
                [1354230000000, 34.61],
                [1354489200000, 34.70],
                [1354575600000, 35.30],
                [1354662000000, 35.40],
                [1354748400000, 35.14],
                [1354834800000, 35.48],
                [1355094000000, 35.75],
                [1355180400000, 35.54],
                [1355266800000, 35.96],
                [1355353200000, 35.53],
                [1355439600000, 37.56],
                [1355698800000, 37.42],
                [1355785200000, 37.49],
                [1355871600000, 38.09],
                [1355958000000, 37.87],
                [1356044400000, 37.71],
                [1356303600000, 37.53],
                [1356476400000, 37.55],
                [1356562800000, 37.30],
                [1356649200000, 36.90],
                [1356908400000, 37.68],
                [1357081200000, 38.34],
                [1357167600000, 37.75],
                [1357254000000, 38.13],
                [1357513200000, 37.94],
                [1357599600000, 38.14],
                [1357686000000, 38.66],
                [1357772400000, 38.62],
                [1357858800000, 38.09],
                [1358118000000, 38.16],
                [1358204400000, 38.15],
                [1358290800000, 37.88],
                [1358377200000, 37.73],
                [1358463600000, 37.98],
                [1358809200000, 37.95],
                [1358895600000, 38.25],
                [1358982000000, 38.10],
                [1359068400000, 38.32],
                [1359327600000, 38.24],
                [1359414000000, 38.52],
                [1359500400000, 37.94],
                [1359586800000, 37.83],
                [1359673200000, 38.34],
                [1359932400000, 38.10],
                [1360018800000, 38.51],
                [1360105200000, 38.40],
                [1360191600000, 38.07],
                [1360278000000, 39.12],
                [1360537200000, 38.64],
                [1360623600000, 38.89],
                [1360710000000, 38.81],
                [1360796400000, 38.61],
                [1360882800000, 38.63],
                [1361228400000, 38.99],
                [1361314800000, 38.77],
                [1361401200000, 38.34],
                [1361487600000, 38.55],
                [1361746800000, 38.11],
                [1361833200000, 38.59],
                [1361919600000, 39.60],
            ]
        }],
        chart: {
            id: \'area-datetime\',
            type: \'area\',
            height: 250,
            zoom: {
                autoScaleYaxis: true
            },
            toolbar: {
                show: false,
            },
        },
        annotations: {
            yaxis: [{
                y: 30,
                borderColor: \'#999\',
                label: {
                    show: true,
                    text: \'Support\',
                    style: {
                        color: "#fff",
                        background: \'#00E396\'
                    }
                }
            }],
            xaxis: [{
                x: new Date(\'14 Nov 2012\').getTime(),
                borderColor: \'#999\',
                yAxisIndex: 0,
                label: {
                    show: true,
                    text: \'Rally\',
                    style: {
                        color: "#fff",
                        background: \'#775DD0\'
                    }
                }
            }]
        },
        dataLabels: {
            enabled: false
        },
        markers: {
            size: 0,
            style: \'hollow\',
        },
        xaxis: {
            type: \'datetime\',
            min: new Date(\'01 Mar 2012\').getTime(),
            tickAmount: 6,
        },
        tooltip: {
            x: {
                format: \'dd MMM yyyy\'
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "light",
                type: "vertical",
                shadeIntensity: 1,
                gradientToColors: ["#9935FE"],
                inverseColors: false,
                opacityFrom: 0.9,
                opacityTo: 0.0,
                stops: [0, 100],
            }
        },
        stroke: {
            curve: \'straight\',
            width: 0,
            colors: ["transparent"]
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-timeline"), options);
    chart.render();
    // ================================ User Traffic chart End ================================ 
</script>'; ?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">SaaS</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">SaaS</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-xxl-6">
            <div class="card h-100 rounded-4 overflow-hidden">
                <div class="card-body p-20">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="px-16 py-12 rounded-3 border border-neutral-200 sass-card-gradient-bg-1">
                                <div class="d-flex align-items-center gap-12">
                                    <span
                                        class="bg-primary w-48-px h-48-px text-xxl rounded-circle d-flex justify-content-center align-items-center text-white">
                                        <i class="ri-user-add-fill"></i>
                                    </span>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="fw-semibold mb-0">750</h6>
                                            <span
                                                class="bg-success-100 text-success-600 fw-semibold border border-success-300 rounded-pill px-4 text-sm">+200</span>
                                        </div>
                                        <span class="text-secondary-light mt-1">Total Users</span>
                                    </div>
                                </div>
                                <div class="mt-16">
                                    <div id="total-users-chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="px-16 py-12 rounded-3 border border-neutral-200 sass-card-gradient-bg-2">
                                <div class="d-flex align-items-center gap-12">
                                    <span
                                        class="bg-yellow w-48-px h-48-px text-xxl rounded-circle d-flex justify-content-center align-items-center text-white">
                                        <i class="ri-discount-percent-line"></i>
                                    </span>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="fw-semibold mb-0">240</h6>
                                            <span
                                                class="bg-danger-100 text-danger-600 fw-semibold border border-danger-300 rounded-pill px-4 text-sm">-200</span>
                                        </div>
                                        <span class="text-secondary-light mt-1">Total Orders</span>
                                    </div>
                                </div>
                                <div class="mt-16">
                                    <div id="total-order-chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="px-16 py-12 rounded-3 border border-neutral-200 sass-card-gradient-bg-3">
                                <div class="d-flex align-items-center gap-12">
                                    <span
                                        class="bg-purple w-48-px h-48-px text-xxl rounded-circle d-flex justify-content-center align-items-center text-white">
                                        <i class="ri-question-answer-line"></i>
                                    </span>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="fw-semibold mb-0">47.5%</h6>
                                            <span
                                                class="bg-success-100 text-success-600 fw-semibold border border-success-300 rounded-pill px-4 text-sm">+3.6%</span>
                                        </div>
                                        <span class="text-secondary-light mt-1">Conversion Rate</span>
                                    </div>
                                </div>
                                <div class="mt-16">
                                    <div id="upDownBarchart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="px-16 py-12 rounded-3 border border-neutral-200 sass-card-gradient-bg-4">
                                <div class="d-flex align-items-center gap-12">
                                    <span
                                        class="bg-success-500 w-48-px h-48-px text-xxl rounded-circle d-flex justify-content-center align-items-center text-white">
                                        <i class="ri-user-add-fill"></i>
                                    </span>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="fw-semibold mb-0">$2.7M</h6>
                                            <span
                                                class="bg-success-100 text-success-600 fw-semibold border border-success-300 rounded-pill px-4 text-sm">+3.6%</span>
                                        </div>
                                        <span class="text-secondary-light mt-1">Order Value</span>
                                    </div>
                                </div>
                                <div class="mt-16 pb-20">
                                    <div id="orderValue" class="margin-16-minus"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-6">
            <div class="card h-100 rounded-4 overflow-hidden border-0">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Daily Earnings</h6>
                        <select
                            class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                            <option>Yearly</option>
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Today</option>
                        </select>
                    </div>
                </div>

                <div class="card-body p-24">
                    <ul class="d-flex flex-wrap align-items-center justify-content-center gap-3">
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-8-px rounded-pill bg-primary-600"></span>
                            <span class="text-secondary-light text-sm fw-semibold line-height-1">Earning:
                                <span class="text-primary-light fw-bold text-xl ms-1">$15.5k</span>
                            </span>
                        </li>
                    </ul>
                    <div id="barChart" class="barChart"></div>
                </div>
            </div>
        </div>

        <div class="col-xxl-8">
            <div class="card h-100 rounded-4 overflow-hidden border-0">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">User Traffic</h6>
                        <select
                            class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                            <option>Yearly</option>
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Today</option>
                        </select>
                    </div>
                </div>

                <div class="card-body p-24">
                    <ul class="d-flex flex-wrap align-items-center justify-content-center gap-3">
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-8-px rounded-pill bg-purple"></span>
                            <span class="text-secondary-light text-sm fw-semibold line-height-1">Total Users:
                                <span class="text-primary-light fw-bold text-xl ms-1">10.5k</span>
                            </span>
                        </li>
                    </ul>
                    <div id="chart-timeline" class=""></div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4">
            <div class="card h-100 rounded-4 overflow-hidden border-0">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Referral Sources</h6>
                        <select
                            class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                            <option>Yearly</option>
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Today</option>
                        </select>
                    </div>
                </div>

                <div class="card-body p-24">
                    <img src="assets/images/home-seventeen/referral-chart.png" alt="Image">
                </div>
            </div>
        </div>

        <div class="col-xxl-4">
            <div class="card h-100 rounded-4 overflow-hidden border-0">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Transaction History</h6>
                        <a href="javascript:void(0)"
                            class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table mb-0 rounded-0 border-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="bg-transparent rounded-0">Customer</th>
                                    <th scope="col" class="bg-transparent rounded-0">Task</th>
                                    <th scope="col" class="bg-transparent rounded-0 text-center">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/user-grid/user-grid-img1.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Cameron Williamson</h6>
                                                <span
                                                    class="text-sm text-secondary-light fw-medium">osgoodwy@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>15</td>
                                    <td class="text-center">
                                        <div class="max-w-112 mx-auto">
                                            <div class="w-100">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-purple rounded-pill"
                                                        style="width: 30%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/user-grid/user-grid-img2.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Jenny Wilson</h6>
                                                <span
                                                    class="text-sm text-secondary-light fw-medium">jennywilson@mail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>27</td>
                                    <td class="text-center">
                                        <div class="max-w-112 mx-auto">
                                            <div class="w-100">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-yellow rounded-pill"
                                                        style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/user-grid/user-grid-img3.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Courtney Henry</h6>
                                                <span
                                                    class="text-sm text-secondary-light fw-medium">courtneyh@mail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>42</td>
                                    <td class="text-center">
                                        <div class="max-w-112 mx-auto">
                                            <div class="w-100">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-primary rounded-pill"
                                                        style="width: 80%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/user-grid/user-grid-img4.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Darrell Steward</h6>
                                                <span
                                                    class="text-sm text-secondary-light fw-medium">darrells@mail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>8</td>
                                    <td class="text-center">
                                        <div class="max-w-112 mx-auto">
                                            <div class="w-100">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success rounded-pill"
                                                        style="width: 20%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/user-grid/user-grid-img5.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Kathryn Murphy</h6>
                                                <span
                                                    class="text-sm text-secondary-light fw-medium">kathrynm@mail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>33</td>
                                    <td class="text-center">
                                        <div class="max-w-112 mx-auto">
                                            <div class="w-100">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-danger rounded-pill"
                                                        style="width: 50%;"></div>
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

        <div class="col-xxl-8">
            <div class="card h-100">
                <div
                    class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Recent Activity</h6>
                    <a href="javascript:void(0)"
                        class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                        View All
                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table mb-0 rounded-0 border-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="bg-transparent rounded-0">Users</th>
                                    <th scope="col" class="bg-transparent rounded-0">Transaction ID</th>
                                    <th scope="col" class="bg-transparent rounded-0">Amount</th>
                                    <th scope="col" class="bg-transparent rounded-0">Payment </th>
                                    <th scope="col" class="bg-transparent rounded-0">Date</th>
                                    <th scope="col" class="bg-transparent rounded-0 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user1.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Cameron Williamson</h6>
                                                <span
                                                    class="text-sm text-secondary-light fw-medium">osgoodwy@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>9562415412263</td>
                                    <td>$29.00</td>
                                    <td>Bank</td>
                                    <td>24 Jun 2024</td>
                                    <td class="text-center">
                                        <span
                                            class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">Paid</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user2.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Jenny Wilson</h6>
                                                <span
                                                    class="text-sm text-secondary-light fw-medium">jennywilson@mail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>8745963214785</td>
                                    <td>$120.50</td>
                                    <td>PayPal</td>
                                    <td>05 Jul 2024</td>
                                    <td class="text-center">
                                        <span
                                            class="bg-warning-focus text-warning-main px-32 py-4 rounded-pill fw-medium text-sm">Pending</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user3.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Courtney Henry</h6>
                                                <span
                                                    class="text-sm text-secondary-light fw-medium">courtneyh@mail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>6321457896521</td>
                                    <td>$75.99</td>
                                    <td>Credit Card</td>
                                    <td>18 Jul 2024</td>
                                    <td class="text-center">
                                        <span
                                            class="bg-danger-focus text-danger-main px-32 py-4 rounded-pill fw-medium text-sm">Failed</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user4.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Darrell Steward</h6>
                                                <span
                                                    class="text-sm text-secondary-light fw-medium">darrells@mail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>4578963258741</td>
                                    <td>$210.00</td>
                                    <td>Stripe</td>
                                    <td>30 Jul 2024</td>
                                    <td class="text-center">
                                        <span
                                            class="bg-info-focus text-info-main px-32 py-4 rounded-pill fw-medium text-sm">In
                                            Progress</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/users/user5.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0">Kathryn Murphy</h6>
                                                <span
                                                    class="text-sm text-secondary-light fw-medium">kathrynm@mail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>7896541239874</td>
                                    <td>$340.75</td>
                                    <td>Bank Transfer</td>
                                    <td>12 Aug 2024</td>
                                    <td class="text-center">
                                        <span
                                            class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">Paid</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-6">
            <div class="row gy-4 h-100">
                <div class="col-md-4">
                    <div
                        class="trail-bg h-100 text-center d-flex flex-column justify-content-between align-items-center p-16 radius-8">
                        <h6 class="text-white text-xl">Upgrade Your Plan</h6>
                        <div class="">
                            <p class="text-white">Your free trial expired in 7 days</p>
                            <a href="#" class="btn py-8 rounded-pill w-100 bg-gradient-blue-warning text-sm">Upgrade
                                Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card h-100 rounded-4 overflow-hidden border-0">
                        <div class="card-header">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                <h6 class="mb-2 fw-bold text-lg mb-0">Statistics</h6>
                                <a href="javascript:void(0)"
                                    class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                    View All
                                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                                </a>
                            </div>
                        </div>

                        <div class="card-body d-flex align-items-center gap-20 flex-sm-nowrap flex-wrap">
                            <div class="d-flex flex-column gap-12">
                                <div class="d-flex align-items-center gap-12">
                                    <div class="">
                                        <span
                                            class="w-20-px h-20-px bg-primary-600 rounded-circle position-relative">
                                            <span
                                                class="w-10-px h-10-px bg-primary-100 rounded-circle position-absolute top-50 start-50 translate-middle"></span>
                                        </span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">172</h6>
                                        <p class="text-secondary-light text-sm">Total Visitors</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-12">
                                    <div class="">
                                        <span
                                            class="w-20-px h-20-px bg-warning-600 rounded-circle position-relative">
                                            <span
                                                class="w-10-px h-10-px bg-warning-100 rounded-circle position-absolute top-50 start-50 translate-middle"></span>
                                        </span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">300</h6>
                                        <p class="text-secondary-light text-sm">Total Page Views </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-12">
                                    <div class="">
                                        <span class="w-20-px h-20-px bg-success rounded-circle position-relative">
                                            <span
                                                class="w-10-px h-10-px bg-green-light rounded-circle position-absolute top-50 start-50 translate-middle"></span>
                                        </span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">200</h6>
                                        <p class="text-secondary-light text-sm">Registrations</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-12">
                                    <div class="">
                                        <span class="w-20-px h-20-px bg-purple rounded-circle position-relative">
                                            <span
                                                class="w-10-px h-10-px bg-purple-30 rounded-circle position-absolute top-50 start-50 translate-middle"></span>
                                        </span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">500</h6>
                                        <p class="text-secondary-light text-sm">Registrations</p>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div id="userOverviewDonutChart" class="apexcharts-tooltip-z-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Sales by Countries</h6>
                        <select
                            class="form-select form-select-sm w-auto bg-base border text-secondary-light radius-8">
                            <option>This Month</option>
                            <option>This Week</option>
                            <option>This Year</option>
                        </select>
                    </div>

                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <div id="world-map" class="h-100 border radius-8"></div>
                        </div>

                        <div class="col-lg-6">
                            <div class="h-100 border p-16 pe-0 radius-8">
                                <div class="max-h-266-px overflow-y-auto scroll-sm pe-16">
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                        <div class="d-flex align-items-center w-100">
                                            <img src="assets/images/flags/flag1.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                            <div class="flex-grow-1">
                                                <h6 class="text-sm mb-0">USA</h6>
                                                <span class="text-xs text-secondary-light fw-medium">1,240
                                                    Users</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 w-100">
                                            <div class="w-100 max-w-66 ms-auto">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-label="Success example" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-primary-600 rounded-pill"
                                                        style="width: 80%;"></div>
                                                </div>
                                            </div>
                                            <span class="text-secondary-light font-xs fw-semibold">80%</span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                        <div class="d-flex align-items-center w-100">
                                            <img src="assets/images/flags/flag2.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                            <div class="flex-grow-1">
                                                <h6 class="text-sm mb-0">Japan</h6>
                                                <span class="text-xs text-secondary-light fw-medium">1,240
                                                    Users</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 w-100">
                                            <div class="w-100 max-w-66 ms-auto">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-label="Success example" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-orange rounded-pill"
                                                        style="width: 60%;"></div>
                                                </div>
                                            </div>
                                            <span class="text-secondary-light font-xs fw-semibold">60%</span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                        <div class="d-flex align-items-center w-100">
                                            <img src="assets/images/flags/flag3.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                            <div class="flex-grow-1">
                                                <h6 class="text-sm mb-0">France</h6>
                                                <span class="text-xs text-secondary-light fw-medium">1,240
                                                    Users</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 w-100">
                                            <div class="w-100 max-w-66 ms-auto">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-label="Success example" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-yellow rounded-pill"
                                                        style="width: 49%;"></div>
                                                </div>
                                            </div>
                                            <span class="text-secondary-light font-xs fw-semibold">49%</span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                        <div class="d-flex align-items-center w-100">
                                            <img src="assets/images/flags/flag4.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                            <div class="flex-grow-1">
                                                <h6 class="text-sm mb-0">Germany</h6>
                                                <span class="text-xs text-secondary-light fw-medium">1,240
                                                    Users</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 w-100">
                                            <div class="w-100 max-w-66 ms-auto">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-label="Success example" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success-main rounded-pill"
                                                        style="width: 100%;"></div>
                                                </div>
                                            </div>
                                            <span class="text-secondary-light font-xs fw-semibold">100%</span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                        <div class="d-flex align-items-center w-100">
                                            <img src="assets/images/flags/flag5.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                            <div class="flex-grow-1">
                                                <h6 class="text-sm mb-0">South Korea</h6>
                                                <span class="text-xs text-secondary-light fw-medium">1,240
                                                    Users</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 w-100">
                                            <div class="w-100 max-w-66 ms-auto">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-label="Success example" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-info-main rounded-pill"
                                                        style="width: 30%;"></div>
                                                </div>
                                            </div>
                                            <span class="text-secondary-light font-xs fw-semibold">30%</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between gap-3">
                                        <div class="d-flex align-items-center w-100">
                                            <img src="assets/images/flags/flag1.png" alt="Image"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                            <div class="flex-grow-1">
                                                <h6 class="text-sm mb-0">USA</h6>
                                                <span class="text-xs text-secondary-light fw-medium">1,240
                                                    Users</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 w-100">
                                            <div class="w-100 max-w-66 ms-auto">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-label="Success example" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-primary-600 rounded-pill"
                                                        style="width: 80%;"></div>
                                                </div>
                                            </div>
                                            <span class="text-secondary-light font-xs fw-semibold">80%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?> 
    