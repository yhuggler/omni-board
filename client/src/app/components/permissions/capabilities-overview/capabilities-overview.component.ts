import { Component, OnInit, ViewChild } from '@angular/core';
import {MatPaginator} from '@angular/material/paginator';
import {MatTableDataSource} from '@angular/material/table';
import { CapabilitiesService } from "../../../services/capabilities.service";
import { MatDialog } from "@angular/material";
import { CapabilityCreationComponent } from "../capability-creation/capability-creation.component";
import { CapabilityOverviewComponent } from "../capability-overview/capability-overview.component";


@Component({
    selector: 'app-capabilities-overview',
    templateUrl: './capabilities-overview.component.html',
    styleUrls: ['./capabilities-overview.component.css']
})
export class CapabilitiesOverviewComponent implements OnInit {

    public capabilities: Object[];
    public capabilitiesDataSource: MatTableDataSource<Object>;

    public displayedColumnsCapabilities: string[] = ['capability', 'actions'];

    @ViewChild(MatPaginator, {static: true}) paginator: MatPaginator;

    constructor(private capabilitiesService: CapabilitiesService,
        private matDialog: MatDialog) { }

    ngOnInit() {
        this.refresh();
    }

    public refresh() {
        this.fetchCapabilities();
    }

    private fetchCapabilities() {
        this.capabilitiesService.getCapabilities().subscribe(response => {
            this.capabilities = response['capabilities'];
            this.capabilitiesDataSource = new MatTableDataSource(response['capabilities']);
            this.capabilitiesDataSource.paginator = this.paginator;
        });
    }

    public showCapabilityCreationDialog() {
        const dialogRef = this.matDialog.open(CapabilityCreationComponent);

        dialogRef.afterClosed().subscribe(() => {
            this.refresh();
        });
    }

    public showCapabilityOverview(capability: object) {
        const dialogRef = this.matDialog.open(CapabilityOverviewComponent, {
            data: {
                capability: capability
            }
        });

        dialogRef.afterClosed().subscribe(() => {
            this.refresh();
        });
    }
}
