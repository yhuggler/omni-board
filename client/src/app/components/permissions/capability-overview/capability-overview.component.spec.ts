import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CapabilityOverviewComponent } from './capability-overview.component';

describe('CapabilityOverviewComponent', () => {
  let component: CapabilityOverviewComponent;
  let fixture: ComponentFixture<CapabilityOverviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CapabilityOverviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CapabilityOverviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
