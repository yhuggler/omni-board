// Import environemental variables
require('dotenv').config();

const si = require('systeminformation');
const osUtils = require('os-utils');

const axios = require('axios')

axios.defaults.headers.post['Authorization'] = 'Bearer ' + process.env.ACCESS_TOKEN;

let cpuReading = {};

let systemStats = {
    uptime: 0
};

let systemInformation = {
    cpuInformation: {},
    hardwareInformation: {
        manufacturer: "",
        model: "",
        version: "",
        serial: "",
        uuid: "",
        sku: "",
        biosVendor: "",
        biosVersion: "",
        biosReleaseDate: "",
        obiosRevision: ""


    },
    operatingSystemInformation: {},

}


// Initial System Information Retrieval
getSystemInformation();

async function getSystemInformation() {
    try {
        const data = await si.getAllData();
        systemInformation.cpuInformation = data['cpu'];

        systemInformation.hardwareInformation.manufacturer = data['system']['manufacturer'];
        systemInformation.hardwareInformation.model = data['system']['model'];
        systemInformation.hardwareInformation.version = data['system']['version'];
        systemInformation.hardwareInformation.serial = data['system']['serial'];
        systemInformation.hardwareInformation.uuid = data['system']['uuid'];
        systemInformation.hardwareInformation.sku = data['system']['sku'];
        systemInformation.hardwareInformation.biosVendor = data['bios']['vendor'];
        systemInformation.hardwareInformation.biosVersion = data['bios']['version'];
        systemInformation.hardwareInformation.biosReleaseDate = data['bios']['releaseDate'];
        systemInformation.hardwareInformation.biosRevision = data['bios']['revision'];

        systemInformation.operatingSystemInformation =  data['os'];

        postSystemInformationToServer();
    } catch (e) {
        console.log(e);
    }
}

function postSystemInformationToServer() {
    axios.post(process.env.API_ENDPOINT + '/systeminformation', JSON.stringify(systemInformation))
        .then(response => {
            console.log(response.data);
        })
        .catch (error => {
            console.log(error);
        });
}

setInterval(function () {
    getSystemVitals();
}, 2500);

async function getSystemVitals() {
    try {
        const data = await si.getAllData();
        cpuReading.currentTemp = data['temp']['main'];
        cpuReading.currentClockspeed = data['cpu']['speed'];

        systemStats.uptime = data['time']['uptime'];

        getCPUUsage();
    } catch (e) {
        console.log(e);
    }
}

function getCPUUsage() {
    osUtils.cpuUsage(function(cpuUsage) {
        cpuReading.currentLoad = cpuUsage;
        postVitalsToServer();
    });
}

function postVitalsToServer() {
    const bodyCpuReading = {
        cpuReading: cpuReading
    };
    
    const bodySystemStats = {
        systemStats: systemStats
    };

    axios.post(process.env.API_ENDPOINT + '/cpu-readings', JSON.stringify(bodyCpuReading))
        .then(response => {
            console.log(response.data);
        })
        .catch (error => {
            console.log(error);
        });
    
    axios.post(process.env.API_ENDPOINT + '/system-stats', JSON.stringify(bodySystemStats))
        .then(response => {
            console.log(response.data);
        })
        .catch (error => {
            console.log(error);
        });
}

