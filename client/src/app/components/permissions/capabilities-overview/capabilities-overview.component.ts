import { Component, OnInit, ViewChild } from '@angular/core';
import {MatPaginator} from '@angular/material/paginator';
import {MatTableDataSource} from '@angular/material/table';
import { CapabilitiesService } from "../../../services/capabilities.service";


@Component({
    selector: 'app-capabilities-overview',
    templateUrl: './capabilities-overview.component.html',
    styleUrls: ['./capabilities-overview.component.css']
})
export class CapabilitiesOverviewComponent implements OnInit {

    public capabilities: Object[];
    public capabilitiesDataSource: MatTableDataSource<Object>;

    public displayedColumnsCapabilities: string[] = ['capability'];

    @ViewChild(MatPaginator, {static: true}) paginator: MatPaginator;

    constructor(private capabilitiesService: CapabilitiesService) { }

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

}
