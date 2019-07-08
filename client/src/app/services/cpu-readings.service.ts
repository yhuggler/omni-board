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
export class CpuReadingsService {
    
    constructor(private httpClient: HttpClient,
        private matSnackBar: MatSnackBar,
        private router: Router) { }


    public getCpuReadings() {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'cpu-readings', httpOptions);
    }
    
    public getCpuReadingsByServerId(serverId: string) {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'cpu-readings/' + serverId, httpOptions);
    }

    public getArchivedCpuReadingsByServerId(serverId: string) {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'cpu-readings/archive/' + serverId, httpOptions);
    }
}
