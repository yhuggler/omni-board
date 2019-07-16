import { Component, OnInit, Inject } from '@angular/core';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { FormGroup, FormControl, Validators } from "@angular/forms";
import { MatSnackBar } from "@angular/material";
import { CapabilitiesService } from "../../../services/capabilities.service";
import { DeleteConfirmationComponent } from "../../../dialogs/delete-confirmation/delete-confirmation.component";

@Component({
    selector: 'app-capability-overview',
    templateUrl: './capability-overview.component.html',
    styleUrls: ['./capability-overview.component.css']
})
export class CapabilityOverviewComponent implements OnInit {

    public capability: object;
    public capabilityFormGroup: FormGroup;

    constructor(public dialogRef: MatDialogRef<CapabilityOverviewComponent>,
        @Inject(MAT_DIALOG_DATA) public data: object,
        private capabilitiesService: CapabilitiesService,
        private matSnackBar: MatSnackBar,
        private matDialog: MatDialog) { 

        this.capability = data['capability'];
    }

    ngOnInit() {
        this.createFormGroup();
    }

    public createFormGroup() {
        this.capabilityFormGroup = new FormGroup({
            capability: new FormControl(this.capability['capability'], Validators.required)
        });
    }

    public updateCapability() {
        const capability = {
            capabilityId: this.capability['capabilityId'],
            capability: this.capabilityFormGroup.value['capability'],
        };

        this.capabilitiesService.updateCapability(capability).subscribe(response => {
            if (response['message']) {
                this.dialogRef.close();
            }

            this.matSnackBar.open(response['message'] ? response['message'] : response['error'], 'Dismiss', {
                duration: 5000
            });
        });
    }

    public deleteCapability() {
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
                this.capabilitiesService.deleteCapability(this.capability['capabilityId']).subscribe(response => {
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
