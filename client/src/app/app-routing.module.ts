import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { DashboardComponent } from "./routes/dashboard/dashboard.component";
import { PermissionsComponent } from "./routes/permissions/permissions.component";
import { ServersComponent } from "./routes/servers/servers.component";
import { LogsComponent } from "./routes/logs/logs.component";


const routes: Routes = [
    { path: '', redirectTo: 'dashboard', pathMatch: "full" },
    { path: 'dashboard', component: DashboardComponent },
    { path: 'servers', component: ServersComponent },
    { path: 'logs', component: LogsComponent },
    { path: 'permissions', component: PermissionsComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
