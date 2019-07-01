// Import environemental variables
require('dotenv').config();

const systemInformation = require('systeminformation');
const osUtils = require('os-utils');

const axios = require('axios')

let vitals = {
    cpuInformation: {},
    hardwareInformation: {
        system: {},
        bios: {}
    },
    operatingSystemInformation: {},
    cpuReading: {},
    systemStats: {
        uptime: 0
    }
};

getSystemVitals();

async function getSystemVitals() {
    try {
        const data = await systemInformation.getAllData();
        vitals.cpuInformation = data['cpu'];
        vitals.hardwareInformation.system = data['system'];
        vitals.hardwareInformation.bios = data['bios'];
        vitals.operatingSystemInformation =  data['os'];

        vitals.cpuReading.currentTemp = data['temp']['main'];
        vitals.cpuReading.currentSpeed = data['cpu']['speed'];

        vitals.systemStats.uptime = data['time']['uptime'];

        getCPUUsage();
    } catch (e) {
        console.log(e);
    }

}

function getCPUUsage() {
    osUtils.cpuUsage(function(cpuUsage) {
        vitals.cpuReading.currentLoad = cpuUsage;
        postData();
    });
}

function postData() {
    axios.post('http://[::1]:8000/vitals', JSON.stringify(vitals))
        .then(response => {
            console.log(response.data);
        })
        .catch (error => {
            console.log(error);
        });
}

