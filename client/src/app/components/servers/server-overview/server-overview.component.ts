import { Component, OnInit, Inject } from '@angular/core';
import {MatDialog, MatDialogRef, MAT_DIALOG_DATA} from '@angular/material/dialog';
import { ServersService } from "../../../services/servers.service";
import { SystemStatsService } from "../../../services/system-stats.service";
import { CpuReadingsService } from "../../../services/cpu-readings.service";
import { SysteminformationService } from "../../../services/systeminformation.service";
import { secondsToDhms } from "../../../helpers/conversions";

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
    public cpuTempsForChart: Object[] = [];

    public refreshInterval = null;
    public isRefreshing: boolean = true;

    public thresholdConfigCpu = {
        '0': {color: 'green'},
        '50': {color: 'orange'},
        '75.5': {color: 'red'}
    };

    public showXAxis = false;
    public showYAxis = true;
    public gradient = false;
    public showLegend = false;
    public showXAxisLabel = true;
    public xAxisLabel = 'Time';
    public showYAxisLabel = true;
    public yAxisLabel = 'CPU-Usage in %';
    public enableAnimations = true;

    public colorScheme = {
        domain: ['#45A74B']
    };

    constructor(public dialogRef: MatDialogRef<ServerOverviewComponent>,
        @Inject(MAT_DIALOG_DATA) public data: Object,
        private serversService: ServersService,
        private cpuReadingsService: CpuReadingsService,
        private systemStatsService: SystemStatsService,
        private systemInformationService: SysteminformationService,
        private matDialog: MatDialog) {

        setTimeout(() => {
            this.server = data['server'];
            this.cpuReadings = data['cpuReadings'];
            this.systemStats = data['systemStats'];
            this.systemInformation = data['systemInformation'];

            this.prepareCpuReadingsForChart();
        }, 250);
    }

    ngOnInit() {
        this.refreshInterval = setInterval(() => {
            this.fetchCpuReadings();
            this.fetchSystemStats();
            this.prepareCpuReadingsForChart();
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

    public prepareCpuReadingsForChart() {
        this.cpuUsageForChart = [];
        this.cpuTempsForChart = [];

        for (let i = 0; i < this.cpuReadings.length; i++) {
            const cpuUsage = {
                name: this.cpuReadings[i]['createdAt'],
                value: this.cpuReadings[i]['currentLoad'] * 100
            }
            this.cpuUsageForChart.push(cpuUsage);
            
            const cpuTemp = {
                name: this.cpuReadings[i]['createdAt'],
                value: this.cpuReadings[i]['currentTemp']
            }
            this.cpuTempsForChart.push(cpuTemp);
        }
    }

    public secondsToDhms(d) {
        return secondsToDhms(d);
    }
}
