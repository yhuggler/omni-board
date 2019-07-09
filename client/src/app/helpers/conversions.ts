export function secondsToDhms(d) {
    let seconds = parseInt(d, 10);

    let days = Math.floor(seconds / (3600*24));
    seconds  -= days*3600*24;
    let hours   = Math.floor(seconds / 3600);
    seconds  -= hours*3600;
    let minutes = Math.floor(seconds / 60);
    seconds  -= minutes*60;

    let dayDisplay = days > 0 ? days + (days == 1 ? " day, " : " days, ") : "";
    let hourDisplay = hours > 0 ? hours + (hours == 1 ? " hour, " : " hours, ") : "";
    let minuteDisplay = minutes > 0 ? minutes + (minutes == 1 ? " minute, " : " minutes, ") : "";
    let secondDisplay = seconds > 0 ? seconds + (seconds == 1 ? " second" : " seconds") : "";

    return dayDisplay + hourDisplay + minuteDisplay + secondDisplay; 
}
