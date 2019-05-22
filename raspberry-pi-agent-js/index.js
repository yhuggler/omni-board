// Import environemental variables
require('dotenv').config();

const si = require('systeminformation');


// Retrieve System Vitals
si.cpu()
    .then(data => console.log(data))
    .catch(error => console.log(error));

si.currentLoad()
    .then(data => console.log(data))
    .catch(error => console.log(error));


