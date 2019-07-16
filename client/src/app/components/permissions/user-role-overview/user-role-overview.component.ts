import { Component, OnInit } from '@angular/core';
import { UserRoleService } from "../../../services/user-role.service";
import { RolesService } from "../../../services/roles.service";

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
        private rolesService: RolesService) { }

    ngOnInit() {
    }

    public initiateUserSearch() {
        this.userRoleService.getRolesWithCapabilitiesByUsernameFuzzy(this.usernameSearchValue).subscribe(response => {

        });
    }

}
