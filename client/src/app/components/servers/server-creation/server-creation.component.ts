import { Component, OnInit } from '@angular/core';
import { ServersService } from "../../../services/servers.service";
import { MatDialog, MatDialogRef } from '@angular/material/dialog';
import { FormGroup, FormControl, Validators } from "@angular/forms";
import { MatSnackBar } from "@angular/material";

@Component({
    selector: 'app-server-creation',
    templateUrl: './server-creation.component.html',
    styleUrls: ['./server-creation.component.css']
})
export class ServerCreationComponent implements OnInit {

    public serverFormGroup: FormGroup;

    constructor(private serversService: ServersService,
        public dialogRef: MatDialogRef<ServerCreationComponent>,
        private matSnackBar: MatSnackBar) { }

    ngOnInit() {
        this.createFormGroup();
    }

    public createFormGroup() {
        this.serverFormGroup = new FormGroup({
            friendlyName: new FormControl('', Validators.required),
            description: new FormControl('', Validators.required)
        });
    }

    public createServer() {
        const server = {
            friendlyName: this.serverFormGroup.value['friendlyName'],
            description: this.serverFormGroup.value['description']
        }

        this.serversService.createServer(server).subscribe(response => {
            if (response['message']) {
                this.dialogRef.close();
            }

            this.matSnackBar.open(response['message'] ? response['message'] : response['error'], 'Dismiss', {
                duration: 5000
            });
        });
    }
}
