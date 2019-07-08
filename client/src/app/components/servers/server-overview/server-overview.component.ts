import { Component, OnInit, Inject } from '@angular/core';
import {MatDialog, MatDialogRef, MAT_DIALOG_DATA} from '@angular/material/dialog';
import { ServersService } from "../../../services/servers.service";
import { SystemStatsService } from "../../../services/system-stats.service";
import { CpuReadingsService } from "../../../services/cpu-readings.service";
import { SysteminformationService } from "../../../services/systeminformation.service";

@Component({
    selector: 'app-server-overview',
    templateUrl: './server-overview.component.html',
    styleUrls: ['./server-overview.component.css']
})
export class ServerOverviewComponent implements OnInit {

    public server: Object[];
    public cpuReadings: Object[];
    public systemStats: Object[];
    public systemInformation: Object[];
    
    public cpuUsageForChart: Object[] = [];

    public refreshInterval = null;
    public isRefreshing: boolean = true;

    thresholdConfigCpu = {
        '0': {color: 'green'},
        '50': {color: 'orange'},
        '75.5': {color: 'red'}
    };

    view: any[] = [700, 400];

    showXAxis = false;
    showYAxis = true;
    gradient = false;
    showLegend = false;
    showXAxisLabel = true;
    xAxisLabel = 'Time';
    showYAxisLabel = true;
    yAxisLabel = 'CPU-Usage';

    colorScheme = {
        domain: ['#45A74B']
    };
    


    constructor(public dialogRef: MatDialogRef<ServerOverviewComponent>,
        @Inject(MAT_DIALOG_DATA) public data: Object,
        private serversService: ServersService,
        private cpuReadingsService: CpuReadingsService,
        private systemStatsService: SystemStatsService,
        private systemInformationService: SysteminformationService,
        private matDialog: MatDialog) {

        this.server = data['server'];
        this.cpuReadings = data['cpuReadings'];
        this.systemStats = data['systemStats'];
        this.systemInformation = data['systemInformation'];


    }

    ngOnInit() {
            this.prepareCpuUsageForChart();
        this.refreshInterval = setInterval(() => {
            this.fetchCpuReadings();
            this.fetchSystemStats();
            this.prepareCpuUsageForChart();
        }, 2500);
    }

    ngOnDestroy() {
        clearInterval(this.refreshInterval);
    }

    private fetchCpuReadings() {
        this.cpuReadingsService.getCpuReadingsByServerId(this.server['serverId']).subscribe(response => {
            this.cpuReadings = response['cpuReadings'];
        });
    }

    private fetchSystemStats() {
        this.systemStatsService.getSystemStatsByServerId(this.server['serverId']).subscribe(response => {
            this.systemStats = response['systemStats'];
        });
    }

    public prepareCpuUsageForChart() {
        this.cpuUsageForChart = [];

        for (let i = 0; i < this.cpuReadings.length; i++) {
            const cpuReading = {
                name: this.cpuReadings[i]['createdAt'],
                value: this.cpuReadings[i]['currentLoad'] * 100
            }
            this.cpuUsageForChart.push(cpuReading);
        }
    }

    public isServerActive() {
        // If there were no updated in the last minute, the server is shown as offline.
        let lastUpdate = this.cpuReadings[this.cpuReadings.length - 1]['createdAt'];
        const currentTimeInSeconds = (new Date).getTime() / 1000;

        return currentTimeInSeconds - lastUpdate < 60;
    }

    public secondsToHms(d) {
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
        let secondDisplay = seconds > 0 ? seconds + (seconds == 1 ? " second, " : " seconds, ") : "";

        return dayDisplay + hourDisplay + minuteDisplay + secondDisplay; 
    }
}
