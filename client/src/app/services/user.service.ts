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

    private urlBase64Decode(str: string) {
        let output = str.replace(/-/g, '+').replace(/_/g, '/');
        switch (output.length % 4) {
            case 0:
                break;
            case 2:
                output += '==';
                break;
            case 3:
                output += '=';
                break;
            default:
                // tslint:disable-next-line:no-string-throw
                throw 'Illegal base64url string!';
        }
        return decodeURIComponent((<any>window).escape(window.atob(output)));
    }

    public getUser() {
        const token = localStorage.getItem('jwt');  

        if (token === null || token === '') { return { 'upn': '' }; }
        const parts = token.split('.');
        if (parts.length !== 3) {

            throw new Error('JWT must have 3 parts');
        }
        const decoded = this.urlBase64Decode(parts[1]);
        if (!decoded) {
            throw new Error('Cannot decode the token');
        }
        return JSON.parse(decoded)['user'];
    }

    public isJWTExpired() {
        const token = localStorage.getItem('jwt');  

        if (token === null || token === '') { return { 'upn': '' }; }
        const parts = token.split('.');
        if (parts.length !== 3) {

            throw new Error('JWT must have 3 parts');
        }
        const decoded = this.urlBase64Decode(parts[1]);

        if (!decoded) {
            throw new Error('Cannot decode the token');
        }

        const expirationTime = decoded['exp'];
        return expirationTime <= Date.now() / 1000;
    }

    public handleLogout() {
        localStorage.removeItem('jwt');

        this.matSnackBar.open('You successfully logged out.', 'Dismiss', {
            duration: 5000,
        });
    }

    public expireSession() {
        localStorage.removeItem('jwt');

        this.matSnackBar.open('Your session expired. Please signin again.', 'Dismiss', {
            duration: 5000,
        });
    }

}
