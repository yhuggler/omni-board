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
export class LogsService {

    constructor(private httpClient: HttpClient) {}

    public getLogs() {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'logs', httpOptions);
    } 

    public deleteLogs(roleId: string) {
        return this.httpClient.delete(AppSettings.API_ENDPOINT + 'logs', httpOptions);
    }
}
