import { Component, OnInit } from '@angular/core';
import { UserRoleService } from "../../../services/user-role.service";
import { RolesService } from "../../../services/roles.service";
import { MatSnackBar } from "@angular/material";

@Component({
    selector: 'app-user-role-overview',
    templateUrl: './user-role-overview.component.html',
    styleUrls: ['./user-role-overview.component.css']
})
export class UserRoleOverviewComponent implements OnInit {

    public usernameSearchValue: string = "";
    public usersWithRoles: object[];
    public roles: object[];

    constructor(private userRoleService: UserRoleService,
        private rolesService: RolesService,
        private matSnackBar: MatSnackBar) { }

    ngOnInit() {
        this.refresh();
    }

    public refresh() {
        this.getRoles();
    }

    public getRoles() {
        this.rolesService.getRoles().subscribe(response => {
            if (!response['error']) {
                this.roles = response['roles'];
            }
        });
    }

    public initiateUserSearch() {
        this.userRoleService.getRolesWithCapabilitiesByUsernameFuzzy(this.usernameSearchValue).subscribe(response => {
            if (!response['error']) {
                this.usersWithRoles = response['usersWithRoles'];
            }
        });
    }

    public isUserInRole(userId: number, roleId: number) {
        let role: Object;

        for (let i = 0; i < this.usersWithRoles.length; i++) {
            if (this.usersWithRoles[i]['user']['id'] == userId) {
                const userWithRoles = this.usersWithRoles[i];

                for (let j = 0; j < userWithRoles['roles'].length; j++) {
                    if (userWithRoles['roles'][j]['roleId'] == roleId)
                        return true;
                } 
            }
        }

        return false;
    }

    public toggleUserToRoleAssignement(userId: number, roleId: number) {
        if (this.isUserInRole(userId, roleId)) {
            this.userRoleService.removeUserFromRole(userId, roleId).subscribe(response => {
                this.initiateUserSearch();
            });
        } else {
            this.userRoleService.assignUserToRole(userId, roleId).subscribe(response => {
                this.initiateUserSearch();
            });
        }
    }

}
