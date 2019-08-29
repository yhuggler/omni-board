import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { UserService } from "./services/user.service";

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {

    constructor(private router: Router,
        private userService: UserService) {
    }

    ngOnInit() {
        this.router.events.subscribe((val) => {
            if (this.userService.isJWTExpired()) {
                this.userService.expireSession();
            }
        });
    }

    public isLoggedIn() {
        return this.userService.isLoggedIn();
    }
}
