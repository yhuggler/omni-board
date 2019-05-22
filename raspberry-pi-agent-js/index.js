const si = require('systeminformation');

si.cpuCurrentspeed()
    .then(data => console.log(data))
    .catch(error => console.log(error));



