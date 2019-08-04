import { Component, OnInit } from '@angular/core';
import { LogsService } from "../../services/logs.service";
import { Log } from "../../models/log";

@Component({
    selector: 'app-logs',
    templateUrl: './logs.component.html',
    styleUrls: ['./logs.component.css']
})
export class LogsComponent implements OnInit {

    public logs: Log[];
	public displayedColumnsLogs: string[] = ['logId', 'loggingLevel', 'message', 'client', 'ipAddress', 'requestMethod', 'requestURI', 'createdAt'];

    constructor(private logsService: LogsService) { }

    ngOnInit() {
        setTimeout(() => {
            this.refresh();
        }, 1000);
    }

    public refresh() {
        this.logs = [];

        this.logsService.getLogs().subscribe(response => {
            if (!response['error']) {
                for (let i = 0; i < response['logs'].length; i++) {
                    const temporaryLog = response['logs'][i];

                    this.logs.push(new Log(temporaryLog['logId'],
                        temporaryLog['loggingLevel'], 
                        temporaryLog['message'], 
                        temporaryLog['client'], 
                        temporaryLog['ipAddress'], 
                        temporaryLog['requestMethod'], 
                        temporaryLog['requestURI'], 
                        temporaryLog['createdAt']));
                }
            }
        });
    }

}
