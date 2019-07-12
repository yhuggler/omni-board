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
export class CapabilitiesService {
    
    constructor(private httpClient: HttpClient,
        private matSnackBar: MatSnackBar,
        private router: Router) { }

    public createCapability(capability: Object) {
        const body = JSON.stringify(capability);

        return this.httpClient.post(AppSettings.API_ENDPOINT + 'capabilities', body, httpOptions);
    }

    public getCapabilities() {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'capabilities', httpOptions);
    } 

    public updateCapability(capability: Object) {
        const body = JSON.stringify(capability);

        return this.httpClient.put(AppSettings.API_ENDPOINT + 'capabilities', body, httpOptions);
    }

    public deleteCapability(capabilityId: string) {
        return this.httpClient.delete(AppSettings.API_ENDPOINT + 'capabilities/' + capabilityId, httpOptions);
    }

}
