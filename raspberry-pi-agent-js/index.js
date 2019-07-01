// Import environemental variables
require('dotenv').config();

const si = require('systeminformation');
const osUtils = require('os-utils');

const axios = require('axios')

axios.defaults.headers.post['Authorization'] = 'Bearer ' + process.env.ACCESS_TOKEN;

let vitals = {
    cpuReading: {},
    systemStats: {
        uptime: 0
    }
};

let systemInformation = {
    cpuInformation: {},
    hardwareInformation: {
        system: {},
        bios: {}
    },
    operatingSystemInformation: {},
}


// Initial System Information Retrieval

//getSystemInformation();

async function getSystemInformation() {
    try {
        const data = await si.getAllData();
        systemInformation.cpuInformation = data['cpu'];
        systemInformation.hardwareInformation.system = data['system'];
        systemInformation.hardwareInformation.bios = data['bios'];
        systemInformation.operatingSystemInformation =  data['os'];
        postSystemInformationToServer();
    } catch (e) {
        console.log(e);
    }
}

function postSystemInformationToServer() {
    axios.post('http://[::1]:8000/systeminformation', JSON.stringify(systemInformation))
        .then(response => {
            console.log(response.data);
        })
        .catch (error => {
            console.log(error);
        });
}

setInterval(function () {
    getSystemVitals();
}, 10000);

async function getSystemVitals() {
    try {
        const data = await si.getAllData();
        vitals.cpuReading.currentTemp = data['temp']['main'];
        vitals.cpuReading.currentClockspeed = data['cpu']['speed'];

        vitals.systemStats.uptime = data['time']['uptime'];

        getCPUUsage();
    } catch (e) {
        console.log(e);
    }
}

function getCPUUsage() {
    osUtils.cpuUsage(function(cpuUsage) {
        vitals.cpuReading.currentLoad = cpuUsage;
        postVitalsToServer();
    });
}

function postVitalsToServer() {
    axios.post('http://[::1]:8000/vitals', JSON.stringify(vitals))
        .then(response => {
            console.log(response.data);
        })
        .catch (error => {
            console.log(error);
        });
}

