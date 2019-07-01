// Import environemental variables
require('dotenv').config();

const systemInformation = require('systeminformation');
const osUtils = require('os-utils');

let vitals = {
    "cpuReading": {},
    "gpuReading": {},
    "systemStats": {}
}

let cpuReading = {
    "currentLoad": 0,
    "currentClockspeed": 0,
    "maxClockspeed": 0,
    "minClockspeed": 0,
    "currentTemp": 0,
    "tempLimitTdp": 0
};


// For now, I'm getting the data in this sequential approach. It's not the prettiest thing ever, but it kinda works.

setTimeout(function () {
    getSystemVitals();
}, 4000);

function getSystemVitals() {
    systemInformation.getAllData()
        .then(data => {
            cpuReading.currentClockspeed = data['cpu']['speed'];
            cpuReading.maxClockspeed = data['cpu']['speedmax'];
            cpuReading.minClockspeed = data['cpu']['speedmin'];
            cpuReading.currentTemp = data['temp']['main'];

            getCPUUsage();
        })
        .catch(error => console.log(error));
}

function getCPUUsage() {
    osUtils.cpuUsage(function(cpuUsage) {
        cpuReading.currentLoad = cpuUsage; 
        console.log(cpuReading);
    });
}


