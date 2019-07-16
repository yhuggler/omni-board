import { Component, OnInit, Inject } from '@angular/core';
import { MatDialog, MatDialogRef } from '@angular/material/dialog';
import { FormGroup, FormControl, Validators } from "@angular/forms";
import { RolesService } from "../../../services/roles.service";
import { MatSnackBar } from "@angular/material";

@Component({
    selector: 'app-role-creation',
    templateUrl: './role-creation.component.html',
    styleUrls: ['./role-creation.component.css']
})
export class RoleCreationComponent implements OnInit {

    public roleFormGroup: FormGroup;

    constructor(public dialogRef: MatDialogRef<RoleCreationComponent>,
        private rolesService: RolesService,
        private matSnackBar: MatSnackBar) { }

    ngOnInit() {
        this.createFormGroup();
    }

    public createFormGroup() {
        this.roleFormGroup = new FormGroup({
            roleTitle: new FormControl('', Validators.required),
            roleDescription: new FormControl('', Validators.required)
        });
    }

    public createRole() {
        const role = {
            roleTitle: this.roleFormGroup.value['roleTitle'],
            roleDescription: this.roleFormGroup.value['roleDescription']
        };

        this.rolesService.createRole(role).subscribe(response => {
            if (response['message']) {
                this.dialogRef.close();
            }

            this.matSnackBar.open(response['message'] ? response['message'] : response['error'], 'Dismiss', {
                duration: 5000
            });
        });
    }
}
