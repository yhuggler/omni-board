import { Component, OnInit, Inject } from '@angular/core';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { FormGroup, FormControl, Validators } from "@angular/forms";

@Component({
    selector: 'app-delete-confirmation',
    templateUrl: './delete-confirmation.component.html',
    styleUrls: ['./delete-confirmation.component.css']
})
export class DeleteConfirmationComponent implements OnInit {

    public title: string;
    public body: string;
    public cancelButtonText: string;
    public confirmButtonText: string;

    constructor(public dialogRef: MatDialogRef<DeleteConfirmationComponent>,
        @Inject(MAT_DIALOG_DATA) public data: object) {

        this.title = data['title'];
        this.body = data['body'];
        this.cancelButtonText = data['cancelButtonText'];
        this.confirmButtonText = data['confirmButtonText'];
    }

    ngOnInit() {
    }

}
