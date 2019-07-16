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
export class UserRoleService {
    
    constructor(private httpClient: HttpClient,
        private matSnackBar: MatSnackBar,
        private router: Router) { }

    public assignUserToRole(userId: number, roleId: number) {
        const body = {
            userId: userId,
            roleId: roleId
        }

        return this.httpClient.post(AppSettings.API_ENDPOINT + 'users-roles', body, httpOptions);
    }

    public getRolesWithCapabilitiesByUserId() {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'users-roles', httpOptions);
    } 
    
    public getRolesWithCapabilitiesByUsernameFuzzy(usernameSearchValue: string) {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'users-roles/' + usernameSearchValue, httpOptions);
    } 

    public removeUserFromRole(userId: number, roleId: number) {
        const body = {
            userId: userId,
            roleId: roleId
        }

        return this.httpClient.post(AppSettings.API_ENDPOINT + 'users-roles/revoke', body, httpOptions);
    }
}
