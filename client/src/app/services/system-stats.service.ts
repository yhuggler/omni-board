import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AppSettings } from '../settings/app-settings';
import { MatSnackBar, MatDialogRef } from '@angular/material';
import { Router } from '@angular/router';

const httpOptions = {
    headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('jwt')
    })
};

@Injectable({
  providedIn: 'root'
})
export class SystemStatsService {
    
    constructor(private httpClient: HttpClient,
        private matSnackBar: MatSnackBar,
        private router: Router) { }

    public getSystemStats() {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'system-stats', httpOptions);
    }
    
    public getSystemStatsByServerId(serverId: string) {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'system-stats/' + serverId, httpOptions);
    }

    public getArchivedSystemStatsByServerId(serverId: string) {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'system-stats/archive/' + serverId, httpOptions);
    }

}
