import { Component, OnInit, ViewChild } from '@angular/core';
import {MatPaginator} from '@angular/material/paginator';
import {MatTableDataSource} from '@angular/material/table';
import { RoleCapabilityService } from "../../../services/role-capability.service";
import { CapabilitiesService } from "../../../services/capabilities.service";
import { RolesService } from "../../../services/roles.service";

@Component({
    selector: 'app-role-capability-overview',
    templateUrl: './role-capability-overview.component.html',
    styleUrls: ['./role-capability-overview.component.css']
})
export class RoleCapabilityOverviewComponent implements OnInit {

    public rolesWithCapabilities: Object[];
    public capabilities: Object[];
    public roles: Object[];

    constructor(private roleCapabilityService: RoleCapabilityService,
        private rolesService: RolesService,
        private capabilitiesService: CapabilitiesService) { }

    ngOnInit() {
        this.refresh();
    }

    public refresh() {
        this.fetchRolesWithCapabilities();
        this.fetchRoles();
        this.fetchCapabilities();
    }

    private fetchRolesWithCapabilities() {
        this.roleCapabilityService.getRolesWithCapabilities().subscribe(response => {
            this.rolesWithCapabilities = response['roles'];
        });
    }
    
    private fetchRoles() {
        this.rolesService.getRoles().subscribe(response => {
            this.roles = response['roles'];
        });
    }
   
    private fetchCapabilities() {
        this.capabilitiesService.getCapabilities().subscribe(response => {
            this.capabilities = response['capabilities'];
        });
    }

    public isCapabilityInRole(capabilityId: number, roleId: number) {
        let role: Object;

        for (let i = 0; i < this.rolesWithCapabilities.length; i++) {
            if (this.rolesWithCapabilities[i]['roleId'] == roleId) {
                role = this.rolesWithCapabilities[i];
                break;
            }
        }

        if (role) {
            const capabilitiesInRole = role['capabilities'];

            for (let i = 0; i < capabilitiesInRole.length; i++) {
                if (capabilitiesInRole[i]['capabilityId'] == capabilityId)
                    return true;
            }

            return false;
        }

        return false;
    }

    public toggleCapabilityToRoleAssignement(capabilityId: number, roleId: number) {
        if (this.isCapabilityInRole(capabilityId, roleId)) {
            this.roleCapabilityService.removeCapabilityFromRole(capabilityId, roleId).subscribe(response => {
                console.log(response);
                this.refresh();
            });
        } else {
            this.roleCapabilityService.assignCapabilityToRole(capabilityId, roleId).subscribe(response => {
                console.log(response);
                this.refresh();
            });
        }
    }
}
