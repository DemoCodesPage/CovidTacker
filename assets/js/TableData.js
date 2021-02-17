var TableProvince = document.getElementById('TableProvince');

fetch("https://covid19.th-stat.com/api/open/cases/sum")
    .then(response => response.json().then(data => {
        // console.log(data.Province);
        let i = 77;
        for (const [key, value] of Object.entries(data.Province)) {
            // console.log(`${key}: ${value}`);
            // console.log(key);
            // Province.innerHTML = key;
            addTable(0, 0, 1, 2, i, key, value);
            i--;
        }

    }))
    .catch(err => {
        console.log(err);
    })

function addTable(tr, td1, td2, td3, number, key, value) {
    var row = TableProvince.insertRow(tr);
    var cell1 = row.insertCell(td1);
    var cell2 = row.insertCell(td2);
    var cell3 = row.insertCell(td3);
    cell1.innerHTML = number;
    cell2.innerHTML = key;
    cell3.innerHTML = value;
}