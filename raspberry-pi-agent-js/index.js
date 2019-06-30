// Import environemental variables
require('dotenv').config();

const systemInformation = require('systeminformation');
const osUtils = require('os-utils');

let cpuReading = {
    "currentLoad": 0,
    "currentClockspeed": 0,
    "maxClockspeed": 0,
    "minClockspeed": 0,
    "currentTemp": 0,
    "tempLimitTdp": 0
};

// Retrieve System Vitals
systemInformation.cpu()
    .then(data => {
        cpuReading.currentClockspeed = data['speed'];
        cpuReading.maxClockspeed = data['speedmax'];
        cpuReading.minClockspeed = data['speedmin'];
    })
    .catch(error => console.log(error));

systemInformation.cpuTemperature()
    .then(data => {
        cpuReading.currentTemp = data['main']
    })
    .catch(error => console.log(error));


// CPU Usage
osUtils.cpuUsage(function(cpuUsage) {
    cpuReading.currentLoad = cpuUsage; 
});

// Post the data to the server


