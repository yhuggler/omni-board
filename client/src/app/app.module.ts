import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MaterialImports } from "./material-imports";
import { TopSidebarComponent } from './templates/top-sidebar/top-sidebar.component';
import { DashboardComponent } from './routes/dashboard/dashboard.component';
import { ServerOverviewWidgetComponent } from './components/servers/server-overview-widget/server-overview-widget.component';
import { SigninComponent } from './routes/signin/signin.component';
import { HttpClientModule } from "@angular/common/http/";
import { ReactiveFormsModule } from "@angular/forms/";
import { NgxGaugeModule } from 'ngx-gauge';

@NgModule({
    declarations: [
        AppComponent,
        TopSidebarComponent,
        DashboardComponent,
        ServerOverviewWidgetComponent,
        SigninComponent
    ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        BrowserAnimationsModule,
        MaterialImports,
        ReactiveFormsModule,
        HttpClientModule,
        NgxGaugeModule
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule { }
