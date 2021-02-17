var requestOptions = {
    method: 'GET',
    redirect: 'follow'
};

fetch("https://api.covid19api.com/summary", requestOptions)
    .then(response => response.json().then(data => {
        // console.log(data.Global);
        // console.log(data.Global.TotalConfirmed);
        // for (var i = 0; i < data.Countries.length; i++) {
        //     // console.log(data.Countries[i].Country + " " + data.Global);
        // }
        let TotalConfirmed = data.Global.TotalConfirmed;
        let TotalDeaths = data.Global.TotalDeaths;
        let TotalRecovered = data.Global.TotalRecovered;
        let NewConfirmed = data.Global.NewConfirmed;
        let NewDeaths = data.Global.NewDeaths;
        let NewRecovered = data.Global.NewRecovered;
        

        var ctx = document.getElementById('Chart_Worl').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: ["ผู้ติดเชื้อทั้งหมด", "หายแล้วทั้งหมด", "เสียชีวิตทั้งหมด", "ผู้ติดเชื้อใหม่", "หายแล้วใหม่", "เสียชีวิตใหม่"],
                datasets: [{
                    label: 'ผู้ติดเชื้อ',
                    borderWidth: 1,
                    backgroundColor: 'rgb(255, 99, 132.5)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [TotalConfirmed, TotalRecovered, TotalDeaths, NewConfirmed, NewRecovered, NewDeaths],
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
                animation: {
                    dutation: 0
                },
                tooltips: {
                    mode: 'index'
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
                            fontColor: '#FFFFFF',
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }))
    .catch(error => console.log('error', error));