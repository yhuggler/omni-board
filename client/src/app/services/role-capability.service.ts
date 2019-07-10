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
export class RoleCapabilityService {

    constructor(private httpClient: HttpClient,
        private matSnackBar: MatSnackBar,
        private router: Router) { }

    public getRolesWithCapabilities() {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'roles-capabilities', httpOptions);
    } 

    public assignCapabilityToRole(capabilityId: number, roleId: number) {
        const body = JSON.stringify({
            capabilityId: capabilityId,
            roleId: roleId
        });

        return this.httpClient.post(AppSettings.API_ENDPOINT + 'roles-capabilities', body, httpOptions);
    }

    public removeCapabilityFromRole(capabilityId: number, roleId: number) {
        const body = JSON.stringify({
            capabilityId: capabilityId,
            roleId: roleId
        });

        return this.httpClient.post(AppSettings.API_ENDPOINT + 'roles-capabilities/remove', body, httpOptions);

    }
}
