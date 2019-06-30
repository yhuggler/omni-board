// Import environemental variables
require('dotenv').config();

const si = require('systeminformation');

let cpuReading = {
    "currentLoad": 0,
    "currentClockspeed": 0,
    "maxClockspeed": 0,
    "minClockspeed": 0,
    "currentTemp": 0,
    "tempLimitTdp": 0,
    "serverIdFk": 2
};


// Retrieve System Vitals
/*
si.cpu()
    .then(data => console.log(data))
    .catch(error => console.log(error));
    */
si.currentLoad()
    .then(data => {
        console.log(data);
        cpuReading.currentLoad = data['currentload'];
        console.log(cpuReading);
    })
    .catch(error => console.log(error));


