let ChartUpdate = document.getElementById('ChartUpdate');
let confirmed = [];
let hospitalized = [];
let recovered = [];
let deaths = [];
let strDate = [];
let dateSplit = [];
var thmonth = new Array("", "ม.ค.", "ก.พ.", "มี.ค.",
    "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.",
    "ต.ค.", "พ.ย.", "ธ.ค.");

fetch("https://covid19.th-stat.com/api/open/timeline")
    .then(response => response.json().then(data => {
        for (var i = 0; i < data.Data.length; i++) {
            confirmed.push(data.Data[i].Confirmed);
            hospitalized.push(data.Data[i].Hospitalized);
            recovered.push(data.Data[i].Recovered);
            deaths.push(data.Data[i].Deaths);

            var x = data.Data[i].Date;
            var dd = x.split("/");
            dateSplit.push(Number(dd[0]));
            strDate.push(dd[1] + " " + thmonth[dateSplit[i]]);
        }

        ChartUpdate.innerHTML = data.UpdateDate;

        var ctx = document.getElementById('Chart_TH').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: strDate,
                datasets: [{
                    label: 'ผู้ติดเชื้อ',
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                    borderWidth: 2,
                    backgroundColor: 'rgb(255, 99, 132.5)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: confirmed,
                },
                {
                    label: 'กำลังรักษา',
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                    borderWidth: 2,
                    backgroundColor: '#f2c94c',
                    borderColor: '#f2c94c',
                    data: hospitalized,
                },
                {
                    label: 'หายแล้ว',
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                    borderWidth: 2,
                    backgroundColor: '#039245',
                    borderColor: '#039245',
                    data: recovered,
                },
                {
                    label: 'เสียชีวิต',
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                    borderWidth: 2,
                    backgroundColor: '#d22d36',
                    borderColor: '#d22d36',
                    data: deaths,
                }

                ]
            },
            // Configuration options go here
            options: {
                legend: {
                    display: true,
                    labels: {
                        boxWidth: 15,
                    }
                },
                animation: {
                    dutation: 0
                },
                tooltips: {
                    mode: 'index',
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                }
            }
        });

    }))
    .catch(err => {
        console.log(err);

    })


fetch("https://covid19.th-stat.com/api/open/timeline")
    .then(response => response.json().then(data => {
        let confirmed = [];
        let hospitalized = [];
        let recovered = [];
        let deaths = [];
        let arrayDate = [];
        for (var i = 0; i < data.Data.length; i++) {
            arrayDate.push(data.Data[i].Date);
            confirmed.push(data.Data[i].Confirmed);
            hospitalized.push(data.Data[i].Hospitalized);
            recovered.push(data.Data[i].Recovered);
            deaths.push(data.Data[i].Deaths);
        }

        var ctx = document.getElementById('Chart_World').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: arrayDate,
                datasets: [{
                    label: 'ผู้ติดเชื้อ',
                    pointRadius: 0,
                    fill: false,
                    lineTension: 0,
                    borderWidth: 2,
                    backgroundColor: 'rgb(255, 99, 132.5)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: confirmed,
                },
                ]
            },
            // Configuration options go here
            options: {
                legend: {
                    display: true,
                    labels: {
                        fontColor: '#FFFFFF',
                        boxWidth: 15,
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: '#FFFFFF',
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            // type: 'time',
                            // time: {
                            //     displayFormats:{
                            //         quarter: 'MMM YYYY'
                            //     }
                            // },
                            // distribution: 'series',
                            fontColor: '#FFFFFF',
                            beginAtZero: true
                        }
                    }],
                }
            }
        });

    }))
    .catch(err => {
        console.log(err);

    })

