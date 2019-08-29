import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms';
import { MatSnackBar, MatDialogRef } from '@angular/material';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-signin',
  templateUrl: './signin.component.html',
  styleUrls: ['./signin.component.css']
})
export class SigninComponent implements OnInit {

public signinForm: FormGroup;

    constructor(private matSnackBar: MatSnackBar,
                private userService: UserService) { }

    ngOnInit() {
        this.createFormGroup();
    }

    public createFormGroup() {
        this.signinForm = new FormGroup({
            username: new FormControl('', Validators.required),
            password: new FormControl('', Validators.required)
        });
    }

    public signin() {
        const user = {
            username: this.signinForm.value.username,
            password: this.signinForm.value.password
        };

        this.userService.signin(user);
    }

}
