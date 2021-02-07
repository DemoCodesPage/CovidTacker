let NewConfirmed = document.getElementById('NewConfirmed');
let NewHospitalized = document.getElementById('NewHospitalized');
let NewRecovered = document.getElementById('NewRecovered');
let NewDeaths = document.getElementById('NewDeaths');

let Confirmed = document.getElementById('Confirmed');
let Hospitalized = document.getElementById('Hospitalized');
let Recovered = document.getElementById('Recovered');
let Deaths = document.getElementById('Deaths');
let Update= document.getElementById('Update');

let sConfirmed = document.getElementById('sConfirmed');
let sHospitalized = document.getElementById('sHospitalized');
let sRecovered = document.getElementById('sRecovered');
let sDeaths = document.getElementById('sDeaths');

fetch("https://covid19.th-stat.com/api/open/today")
.then(response => response.json().then(data => {
    console.log(data.NewConfirmed);
    Confirmed.innerHTML = comma(data.Confirmed);
    Hospitalized.innerHTML = comma(data.Hospitalized);
    Recovered.innerHTML = comma(data.Recovered);
    Deaths.innerHTML = comma(data.Deaths);
    Update.innerHTML = data.UpdateDate;

    NewConfirmed.innerHTML = Math.abs(comma(data.NewConfirmed));
    NewHospitalized.innerHTML = Math.abs(comma(data.NewHospitalized));
    NewRecovered.innerHTML = Math.abs(comma(data.NewRecovered));
    NewDeaths.innerHTML = Math.abs(comma(data.NewDeaths));

    status(data.NewConfirmed, sConfirmed)
    status(data.NewHospitalized, sHospitalized)
    status(data.NewRecovered, sRecovered)
    status(data.NewDeaths, sDeaths)

}))
.catch(err=>{
    console.log(err);
    
})

function status(value, doc){
    let up = "<i class='fas fa-angle-double-up'></i> เพิ่มขึ้น";
    let down = "<i class='fas fa-angle-double-down'></i> ลดลง";
    let equal = "<i class='fas fa-equals'></i> คงที่";
    (value != 0 ? (value > 0 ? doc.innerHTML = up : doc.innerHTML = down) : doc.innerHTML = equal)
}

function comma(x) {
    // (new Intl.NumberFormat('en-CA', {
    //     style: 'decimal'
    // }).format(x));
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}