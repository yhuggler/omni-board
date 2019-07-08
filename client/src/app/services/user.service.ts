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
export class UserService {

    constructor(private httpClient: HttpClient,
        private matSnackBar: MatSnackBar,
        private router: Router) { }

    public signin(user: Object) {
        const body = JSON.stringify(user);
        this.httpClient.post(AppSettings.API_ENDPOINT + 'user/signin', body, httpOptions).subscribe(response => {

            if (response['user']) {
                this.matSnackBar.open(response['message'], 'Dismiss', {
                    duration: 5000
                });
                
                localStorage.clear();
                localStorage.setItem('jwt', response['user']);

                this.router.navigateByUrl('/dashboard');
            } else if(response['error']) {
                this.matSnackBar.open(response['error'], 'Dismiss', {
                    duration: 5000
                });
            }
        });;
    }

    public isLoggedIn() {
        return localStorage.getItem('jwt') !== null;
    }

}
