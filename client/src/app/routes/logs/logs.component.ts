import { Component, OnInit } from '@angular/core';
import { LogsService } from "../../services/logs.service";
import { Log } from "../../models/log";
import { MatTableDataSource } from "@angular/material";

@Component({
    selector: 'app-logs',
    templateUrl: './logs.component.html',
    styleUrls: ['./logs.component.css']
})
export class LogsComponent implements OnInit {

    public logs: MatTableDataSource<Log>;
	public displayedColumnsLogs: string[] = ['loggingLevel', 'requestMethod', 'requestURI', 'message', 'ipAddress', 'createdAt'];

    constructor(private logsService: LogsService) { }

    ngOnInit() {
        this.refresh();
    }

    public refresh() {
        const logs: Log[] = [];

        this.logsService.getLogs().subscribe(response => {
            if (!response['error']) {
                for (let i = 0; i < response['logs'].length; i++) {
                    const temporaryLog = response['logs'][i];

                    logs.push(new Log(temporaryLog['logId'],
                        temporaryLog['loggingLevel'], 
                        temporaryLog['message'], 
                        temporaryLog['client'], 
                        temporaryLog['ipAddress'], 
                        temporaryLog['requestMethod'], 
                        temporaryLog['requestURI'], 
                        temporaryLog['createdAt']));
                }

                this.logs = new MatTableDataSource<Log>(logs);
            }
        });
    }

    public getLoggingLevelStyle(loggingLevel: string) {
        return loggingLevel.toLowerCase();
    }

}
