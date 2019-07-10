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

    }

    public getCapabilities() {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'capabilities', httpOptions);
    } 

    public updateCapability(capability: Object) {

    }

    public deleteCapability(capabilityId: string) {

    }

}
