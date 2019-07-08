import { Component, OnInit, ChangeDetectorRef, ViewChild } from '@angular/core';
import { Router  } from '@angular/router';
import { MediaMatcher } from '@angular/cdk/layout';
import { MatSidenav } from '@angular/material';

@Component({
    selector: 'app-top-sidebar',
    templateUrl: './top-sidebar.component.html',
    styleUrls: ['./top-sidebar.component.css']
})
export class TopSidebarComponent implements OnInit {

    public mobileQuery: MediaQueryList;
    private _mobileQueryListener: () => void;

    @ViewChild(MatSidenav, {static: true}) snav: MatSidenav;

    constructor(private router: Router,
        private changeDetectorRef: ChangeDetectorRef, 
        private media: MediaMatcher) {

        this.mobileQuery = media.matchMedia('(max-width: 600px)');
        this._mobileQueryListener = () => changeDetectorRef.detectChanges();
        this.mobileQuery.addListener(this._mobileQueryListener);
    }

    ngOnInit() {
    }

    public isRouteActive(route: String) {
        return route == this.router.url;
    }

    public getActiveRoute(): string {
        const currentRoute = this.router.url.replace('/', '');
    
        return this.getUpperCaseWord(currentRoute);
    }

    public getUpperCaseWord(word: string) {
        return word.charAt(0).toUpperCase() + word.substring(1);
    }
}
