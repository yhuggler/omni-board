import { Component, OnInit, OnDestroy } from '@angular/core';
import { ServersService } from "../../../services/servers.service";
import { SystemStatsService } from "../../../services/system-stats.service";
import { CpuReadingsService } from "../../../services/cpu-readings.service";
import { SysteminformationService } from "../../../services/systeminformation.service";
import { MatDialog } from "@angular/material";
import { ServerOverviewComponent } from "../server-overview/server-overview.component";
import { secondsToDhms } from "../../../helpers/conversions";
import { ServerCreationComponent } from "../server-creation/server-creation.component";

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

    public thresholdConfigCpu = {
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
        // Intial fetching of data, berfore interval fetching starts.
        this.refresh();

        this.refreshInterval = setInterval(() => {
            if (this.isRefreshing) {
                this.fetchCpuReadings();
                this.fetchSystemStats();
            }
        }, 2000);
    }

    ngOnDestroy() {
        clearInterval(this.refreshInterval);
    }

    public toggleRefreshInterval() {
        this.isRefreshing = !this.isRefreshing;
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

    private hasReadings(index: number) {
        if (this.cpuReadings[index]['cpuReadings'].length == 0 || 
            this.systemStats[index]['systemStats'].length == 0) {
            return false;
        }

        return true;
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

        return secondsToDhms(uptimeInSeconds);
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

    public showServerCreationDialog() {
        this.isRefreshing = false;

        const dialogRef = this.matDialog.open(ServerCreationComponent);

        dialogRef.afterClosed().subscribe(() => {
            this.isRefreshing = true;
        });
    }
}
