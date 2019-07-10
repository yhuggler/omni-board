import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CapabilitiesOverviewComponent } from './capabilities-overview.component';

describe('CapabilitiesOverviewComponent', () => {
  let component: CapabilitiesOverviewComponent;
  let fixture: ComponentFixture<CapabilitiesOverviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CapabilitiesOverviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CapabilitiesOverviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
