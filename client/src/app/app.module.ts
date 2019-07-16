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
import { ServerOverviewComponent } from './components/servers/server-overview/server-overview.component';
import { PermissionsComponent } from './routes/permissions/permissions.component';
import { NgxChartsModule } from '@swimlane/ngx-charts';
import { RolesOverviewComponent } from './components/permissions/roles-overview/roles-overview.component';
import { CapabilitiesOverviewComponent } from './components/permissions/capabilities-overview/capabilities-overview.component';
import { RoleCapabilityOverviewComponent } from './components/permissions/role-capability-overview/role-capability-overview.component';
import { RoleCreationComponent } from './components/permissions/role-creation/role-creation.component';
import { RoleOverviewComponent } from './components/permissions/role-overview/role-overview.component';
import { DeleteConfirmationComponent } from './dialogs/delete-confirmation/delete-confirmation.component';
import { CapabilityCreationComponent } from './components/permissions/capability-creation/capability-creation.component';
import { CapabilityOverviewComponent } from './components/permissions/capability-overview/capability-overview.component';

@NgModule({
    declarations: [
        AppComponent,
        TopSidebarComponent,
        DashboardComponent,
        ServerOverviewWidgetComponent,
        SigninComponent,
        ServerOverviewComponent,
        PermissionsComponent,
        RolesOverviewComponent,
        CapabilitiesOverviewComponent,
        RoleCapabilityOverviewComponent,
        RoleCreationComponent,
        RoleOverviewComponent,
        DeleteConfirmationComponent,
        CapabilityCreationComponent,
        CapabilityOverviewComponent
    ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        BrowserAnimationsModule,
        MaterialImports,
        ReactiveFormsModule,
        HttpClientModule,
        NgxGaugeModule,
        NgxChartsModule
    ],
    providers: [],
    entryComponents: [
        ServerOverviewComponent,
        RoleCreationComponent,
        RoleOverviewComponent,
        DeleteConfirmationComponent,
        CapabilityCreationComponent,
        CapabilityOverviewComponent
    ],
    bootstrap: [AppComponent]
})
export class AppModule { }
