import { Component, OnInit } from '@angular/core';
import { MatDialog, MatDialogRef } from '@angular/material/dialog';
import { FormGroup, FormControl, Validators } from "@angular/forms";
import { MatSnackBar } from "@angular/material";
import { CapabilitiesService } from "../../../services/capabilities.service";

@Component({
  selector: 'app-capability-creation',
  templateUrl: './capability-creation.component.html',
  styleUrls: ['./capability-creation.component.css']
})
export class CapabilityCreationComponent implements OnInit {

  public capabilityFormGroup: FormGroup;

  constructor(public dialogRef: MatDialogRef<CapabilityCreationComponent>,
              private capabilitiesService: CapabilitiesService,
              private matSnackBar: MatSnackBar) { }

  ngOnInit() {
    this.createFormGroup();
  }

  public createFormGroup() {
    this.capabilityFormGroup = new FormGroup({
      capability: new FormControl('', Validators.required)
    });
  }

  public createCapability() {
    const capability = {
      capability: this.capabilityFormGroup.value['capability'],
    };

    this.capabilitiesService.createCapability(capability).subscribe(response => {
      if (response['message']) {
        this.dialogRef.close();
      }

      this.matSnackBar.open(response['message'] ? response['message'] : response['error'], 'Dismiss', {
        duration: 5000
      });
    });
  }
}
