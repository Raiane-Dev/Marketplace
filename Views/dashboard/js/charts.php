<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


<script>
    /*
        - Count Clients
    */
    var options = {
        series: [{
        name: 'Receita',
        type: 'area',
        data: [100,200,30]
    }],
        chart: {
        toolbar: {
            show: false,
        },
        height: 100,
        type: 'line',
        foreColor: '#fff',
        fontFamily: 'Poppins, sans-serif'
    },
    stroke: {
        curve: 'smooth',
        colors: ['#377dff'],
        width: 2,
    },
    fill: {
        type:'solid',
    },
    xaxis: {
            categories: ["Jan", "Feb", "Mar"],
            position: 'top',
            labels: {
            show: false,
            },
            axisBorder: {
            show: false
            },
            axisTicks: {
            show: false
            },
        },
    grid: {
        show: true,
        borderColor: 'rgba(255, 255, 255, 0.171)',
        strokeDashArray: 0,
        position: 'back',
    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
        formatter: function (y) {
            if(typeof y !== "undefined") {
            return  y.toFixed(0) + " points";
            }
            return y;
        }
        }
    }


    };

    var chart = new ApexCharts(document.querySelector("#chart-clients"), options);
    chart.render();


/*--------------------------------------------------------------------------------------------------------------------*/
    
    /*
        - Count Sessions
    */
    var options = {
        series: [{
        name: 'Receita',
        type: 'area',
        data: [100,200,30]
    }],
        chart: {
        toolbar: {
            show: false,
        },
        height: 100,
        type: 'line',
        foreColor: '#fff',
        fontFamily: 'Poppins, sans-serif'
    },
    stroke: {
        curve: 'smooth',
        colors: ['#377dff'],
        width: 2,
    },
    fill: {
        type:'solid',
    },
    xaxis: {
            categories: ["Jan", "Feb", "Mar"],
            position: 'top',
            labels: {
            show: false,
            },
            axisBorder: {
            show: false
            },
            axisTicks: {
            show: false
            },
        },
    grid: {
        show: true,
        borderColor: 'rgba(255, 255, 255, 0.171)',
        strokeDashArray: 0,
        position: 'back',
    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
        formatter: function (y) {
            if(typeof y !== "undefined") {
            return  y.toFixed(0) + " points";
            }
            return y;
        }
        }
    }


    };

    var chart = new ApexCharts(document.querySelector("#chart-sessions"), options);
    chart.render();


/*--------------------------------------------------------------------------------------------------------------------*/


    /*
        - Count Orders
    */
    var options = {
        series: [{
        name: 'Receita',
        type: 'area',
        data: [100,200,30]
    }],
        chart: {
        toolbar: {
            show: false,
        },
        height: 100,
        type: 'line',
        foreColor: '#fff',
        fontFamily: 'Poppins, sans-serif'
    },
    stroke: {
        curve: 'smooth',
        colors: ['#377dff'],
        width: 2,
    },
    fill: {
        type:'solid',
    },
    xaxis: {
            categories: ["Jan", "Feb", "Mar"],
            position: 'top',
            labels: {
            show: false,
            },
            axisBorder: {
            show: false
            },
            axisTicks: {
            show: false
            },
        },
    grid: {
        show: true,
        borderColor: 'rgba(255, 255, 255, 0.171)',
        strokeDashArray: 0,
        position: 'back',
    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
        formatter: function (y) {
            if(typeof y !== "undefined") {
            return  y.toFixed(0) + " points";
            }
            return y;
        }
        }
    }


    };

    var chart = new ApexCharts(document.querySelector("#chart-orders"), options);
    chart.render();


/*--------------------------------------------------------------------------------------------------------------------*/

    /*
        - Coount Payments
    */
    var options = {
        series: [{
        name: 'Receita',
        type: 'area',
        data: [100,200,30]
    }],
        chart: {
        toolbar: {
            show: false,
        },
        height: 100,
        type: 'line',
        foreColor: '#fff',
        fontFamily: 'Poppins, sans-serif'
    },
    stroke: {
        curve: 'smooth',
        colors: ['#377dff'],
        width: 2,
    },
    fill: {
        type:'solid',
    },
    xaxis: {
            categories: ["Jan", "Feb", "Mar"],
            position: 'top',
            labels: {
            show: false,
            },
            axisBorder: {
            show: false
            },
            axisTicks: {
            show: false
            },
        },
    grid: {
        show: true,
        borderColor: 'rgba(255, 255, 255, 0.171)',
        strokeDashArray: 0,
        position: 'back',
    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
        formatter: function (y) {
            if(typeof y !== "undefined") {
            return  y.toFixed(0) + " points";
            }
            return y;
        }
        }
    }


    };

    var chart = new ApexCharts(document.querySelector("#chart-payments"), options);
    chart.render();


/*--------------------------------------------------------------------------------------------------------------------*/

    /*
        - Count 
    */

    var options = {
          series: [{
          name: 'Success',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Error',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }],
        chart: {
        toolbar: {
            show: false,
        },
        height: 300,
        type: 'bar',
        foreColor: '#8c98a4',
        fontFamily: 'Poppins, sans-serif'
    },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        fill: {
          opacity: 1,
          colors: ['#e7eaf3', '#377dff'],
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart-metrics"), options);
        chart.render();

/*--------------------------------------------------------------------------------------------------------------------*/

        /*
            - Count Amount
        */
      
        var options = {
          series: [{
          name: 'Marine Sprite',
          data: [25]
        }, {
          name: 'Striking Calf',
          data: [25]
        }, {
          name: 'Marine Sprite',
          data: [25]
        }, {
          name: 'Marine Sprite',
          data: [25]
        }],
        chart: {
        toolbar: {
            show: false,
        },
        height: 100,
        type: 'bar',
        foreColor: '#8c98a4',
        fontFamily: 'Poppins, sans-serif',
        stacked: true,
        stackType: '100%',
        },
        plotOptions: {
          bar: {
            horizontal: true,
          },
        },
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        xaxis: {
          categories: [2008],
          labels: {
            show: false,
            },
            axisBorder: {
            show: false
            },
            axisTicks: {
            show: false
            },
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + "K"
            }
          }
        },
        fill: {
          opacity: 1,
          colors: ['#377dff', '#377dffd1','#377dff9c','#377dff61'],
        },
        legend: {
          show:false,
        },
        grid: {
        show: false,
        },
        yaxis: {
          labels: {
            show: false,
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart-amount"), options);
        chart.render();
      
/*--------------------------------------------------------------------------------------------------------------------*/

        /*

        */

      
        var options = {
          series: [42, 47, 52, 58, 65],
          chart: {
          width: 380,
          type: 'polarArea',
          foreColor: '#8c98a4',
          fontFamily: 'Poppins, sans-serif',
        },
        labels: ['Rose A', 'Rose B', 'Rose C', 'Rose D', 'Rose E'],
        fill: {
          opacity: 1
        },
        stroke: {
          width: 1,
          colors: undefined
        },
        yaxis: {
          show: false
        },
        legend: {
          position: 'bottom'
        },
        plotOptions: {
          polarArea: {
            rings: {
              strokeWidth: 0
            },
            spokes: {
              strokeWidth: 0
            },
          }
        },
        theme: {
          monochrome: {
            enabled: true,
            shadeTo: 'light',
            shadeIntensity: 0.6
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart-bubble"), options);
        chart.render();
      
    
</script>