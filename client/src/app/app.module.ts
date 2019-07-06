import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MaterialImports } from "./material-imports";
import { TopSidebarComponent } from './templates/top-sidebar/top-sidebar.component';

@NgModule({
    declarations: [
        AppComponent,
        TopSidebarComponent
    ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        BrowserAnimationsModule,
        MaterialImports
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule { }
