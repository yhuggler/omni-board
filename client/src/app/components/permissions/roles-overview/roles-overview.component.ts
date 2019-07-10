import { Component, OnInit, ViewChild } from '@angular/core';
import { RolesService } from "../../../services/roles.service";
import {MatPaginator} from '@angular/material/paginator';
import {MatTableDataSource} from '@angular/material/table';

@Component({
    selector: 'app-roles-overview',
    templateUrl: './roles-overview.component.html',
    styleUrls: ['./roles-overview.component.css']
})
export class RolesOverviewComponent implements OnInit {

    public roles: Object[];
    public rolesDataSource: MatTableDataSource<Object>;

    public displayedColumnsRoles: string[] = ['roleTitle', 'roleDescription'];

    @ViewChild(MatPaginator, {static: true}) paginator: MatPaginator;

    constructor(private rolesService: RolesService) { }

    ngOnInit() {
        this.refresh();
    }

    public refresh() {
        this.fetchRoles();
    }

    private fetchRoles() {
        this.rolesService.getRoles().subscribe(response => {
            this.roles = response['roles'];
            this.rolesDataSource = new MatTableDataSource(response['roles']);
            this.rolesDataSource.paginator = this.paginator;
        });
    }
}
