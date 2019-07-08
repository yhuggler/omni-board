import { Component, OnInit } from '@angular/core';
import { ServersService } from "../../../services/servers.service";
import { SystemStatsService } from "../../../services/system-stats.service";
import { CpuReadingsService } from "../../../services/cpu-readings.service";
import { SysteminformationService } from "../../../services/systeminformation.service";

@Component({
    selector: 'app-server-overview-widget',
    templateUrl: './server-overview-widget.component.html',
    styleUrls: ['./server-overview-widget.component.css']
})
export class ServerOverviewWidgetComponent implements OnInit {

    public servers: Object[];
    public cpuReadings: Object[];
    public systemStats: Object[];
    public systemInformation: Object[];


    constructor(private serversService: ServersService,
        private cpuReadingsService: CpuReadingsService,
        private systemStatsService: SystemStatsService,
        private systemInformationService: SysteminformationService) { }

    ngOnInit() {
        this.fetchServers();
        this.fetchCpuReadings();
        this.fetchSystemStats();
        this.fetchSystemInformation();

        setInterval(() => {
            this.fetchCpuReadings();
        }, 2000);
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

    public isServerActive(index: number) {
        

        // If there were no updated in the last minute, the server is shown as offline.
        const currentCpuReadings = this.cpuReadings[index]['cpuReadings'];

        let lastUpdate = currentCpuReadings[currentCpuReadings.length - 1]['createdAt'];
        const currentTimeInSeconds = (new Date).getTime() / 1000;

        return currentTimeInSeconds - lastUpdate < 60;
    }
}
