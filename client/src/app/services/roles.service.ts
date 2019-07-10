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
export class RolesService {
    
    constructor(private httpClient: HttpClient,
        private matSnackBar: MatSnackBar,
        private router: Router) { }

    public createRole(role: Object) {

    }

    public getRoles() {
        return this.httpClient.get(AppSettings.API_ENDPOINT + 'roles', httpOptions);
    } 

    public updateRole(role: Object) {

    }

    public deleteRole(roleId: string) {

    }
}
