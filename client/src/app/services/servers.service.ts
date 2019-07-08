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
export class ServersService {

    constructor(private httpClient: HttpClient,
        private matSnackBar: MatSnackBar,
        private router: Router) { }

    public createServer(server: Object) {

    }

    public getServers() {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'servers', httpOptions);
    } 

    public updateServer(server: Object) {

    }

    public deleteServer(serverId: string) {

    }
}
