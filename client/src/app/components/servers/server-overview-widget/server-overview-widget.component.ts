import { Component, OnInit, OnDestroy } from '@angular/core';
import { ServersService } from "../../../services/servers.service";
import { SystemStatsService } from "../../../services/system-stats.service";
import { CpuReadingsService } from "../../../services/cpu-readings.service";
import { SysteminformationService } from "../../../services/systeminformation.service";
import { MatDialog } from "@angular/material";
import { ServerOverviewComponent } from "../server-overview/server-overview.component";

@Component({
    selector: 'app-server-overview-widget',
    templateUrl: './server-overview-widget.component.html',
    styleUrls: ['./server-overview-widget.component.css']
})
export class ServerOverviewWidgetComponent implements OnInit, OnDestroy {

    public servers: Object[];
    public cpuReadings: Object[];
    public systemStats: Object[];
    public systemInformation: Object[];

    public refreshInterval = null;
    public isRefreshing: boolean = true;

    thresholdConfigCpu = {
        '0': {color: 'green'},
        '50': {color: 'orange'},
        '75.5': {color: 'red'}
    };

    constructor(private serversService: ServersService,
        private cpuReadingsService: CpuReadingsService,
        private systemStatsService: SystemStatsService,
        private systemInformationService: SysteminformationService,
        private matDialog: MatDialog) { }

    ngOnInit() {
        this.fetchServers();
        this.fetchCpuReadings();
        this.fetchSystemStats();
        this.fetchSystemInformation();

        this.refreshInterval = setInterval(() => {
            if (this.isRefreshing) {
                this.fetchCpuReadings();
            }
        }, 2000);
    }

    ngOnDestroy() {
        clearInterval(this.refreshInterval);
    }

    public refresh() {
        this.fetchServers();
        this.fetchCpuReadings();
        this.fetchSystemStats();
        this.fetchSystemInformation();
    }

    private fetchServers() {
        this.serversService.getServers().subscribe(response => {
            this.servers = response['servers'];
        });
    }

    private fetchCpuReadings() {
        this.cpuReadingsService.getCpuReadings().subscribe(response => {
            this.cpuReadings = response['cpuReadings'];
        });
    }

    private fetchSystemStats() {
        this.systemStatsService.getSystemStats().subscribe(response => {
            this.systemStats = response['systemStats'];
        });
    }

    private fetchSystemInformation() {
        this.systemInformationService.getSystemInformation().subscribe(response => {
            this.systemInformation = response['systemInformation'];
        });
    }

    public getLatestCpuReading(index: number) {
        const cpuReadingsByServer = this.cpuReadings[index]['cpuReadings'];
        return cpuReadingsByServer[cpuReadingsByServer.length - 1];
    }
    
    public getLatestUptime(index: number) {
        const systemStatsByServer = this.systemStats[index]['systemStats'];
        const uptimeInSeconds = systemStatsByServer[systemStatsByServer.length - 1]['uptime'];

        return this.secondsToHms(uptimeInSeconds);
    }

    public showServerOverview(index: number) {
        this.isRefreshing = false;

        const dialogRef = this.matDialog.open(ServerOverviewComponent, {
            minWidth: '80%',
            data: {
                server: this.servers[index],
                cpuReadings: this.cpuReadings[index]['cpuReadings'],
                systemStats: this.systemStats[index]['systemStats'],
                systemInformation: {
                    cpuInformation: this.systemInformation[index]['cpuInformation'],
                    hardwareInformation: this.systemInformation[index]['hardwareInformation'],
                    operatingSystemInformation: this.systemInformation[index]['operatingSystemInformation']
                }
            }
        });

        dialogRef.afterClosed().subscribe(() => {
            this.isRefreshing = true;
        });
    }

    public isServerActive(index: number) {
        // If there were no updated in the last minute, the server is shown as offline.
        const currentCpuReadings = this.cpuReadings[index]['cpuReadings'];

        let lastUpdate = currentCpuReadings[currentCpuReadings.length - 1]['createdAt'];
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
