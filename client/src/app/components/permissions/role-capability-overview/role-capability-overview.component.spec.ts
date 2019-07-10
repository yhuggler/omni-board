import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RoleCapabilityOverviewComponent } from './role-capability-overview.component';

describe('RoleCapabilityOverviewComponent', () => {
  let component: RoleCapabilityOverviewComponent;
  let fixture: ComponentFixture<RoleCapabilityOverviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RoleCapabilityOverviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RoleCapabilityOverviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
