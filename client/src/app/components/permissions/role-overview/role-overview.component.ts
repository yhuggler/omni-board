import { Component, OnInit, Inject } from '@angular/core';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { FormGroup, FormControl, Validators } from "@angular/forms";
import { RolesService } from "../../../services/roles.service";
import { MatSnackBar } from "@angular/material";
import { DeleteConfirmationComponent } from "../../../dialogs/delete-confirmation/delete-confirmation.component";

@Component({
    selector: 'app-role-overview',
    templateUrl: './role-overview.component.html',
    styleUrls: ['./role-overview.component.css']
})
export class RoleOverviewComponent implements OnInit {

    public role: object;
    public roleFormGroup: FormGroup;

    constructor(public dialogRef: MatDialogRef<RoleOverviewComponent>,
        @Inject(MAT_DIALOG_DATA) public data: object,
        private rolesService: RolesService,
        private matSnackBar: MatSnackBar,
        private matDialog: MatDialog) {

        this.role = data['role'];
    }

    ngOnInit() {
        this.createFormGroup();
    }

    public createFormGroup() {
        this.roleFormGroup = new FormGroup({
            roleTitle: new FormControl(this.role['roleTitle'], Validators.required),
            roleDescription: new FormControl(this.role['roleDescription'], Validators.required)
        });
    }

    public updateRole() {
        const role = {
            roleId: this.role['roleId'],
            roleTitle: this.roleFormGroup.value['roleTitle'],
            roleDescription: this.roleFormGroup.value['roleDescription']
        };

        this.rolesService.updateRole(role).subscribe(response => {
            if (response['message']) {
                this.dialogRef.close();
            }

            this.matSnackBar.open(response['message'] ? response['message'] : response['error'], 'Dismiss', {
                duration: 5000
            });
        });
    }

    public deleteRole() {
        const dialogRef = this.matDialog.open(DeleteConfirmationComponent, {
            data: {
                title: "Are you sure, you want to delete this role?",
                body: "Once you delete this role, all relations to users and capabilities will be purged aswell.",
                cancelButtonText: "No, I am not!",
                confirmButtonText: "Yes, I am sure!"
            }
        });

        dialogRef.afterClosed().subscribe(hasConfirmed => {
            if (hasConfirmed) {
                this.rolesService.deleteRole(this.role['roleId']).subscribe(response => {
                    if (response['message']) {
                        this.dialogRef.close();
                    }

                    this.matSnackBar.open(response['message'] ? response['message'] : response['error'], 'Dismiss', {
                        duration: 5000
                    });
                });
            } 
        });
    }
}
