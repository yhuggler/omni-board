import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CapabilityCreationComponent } from './capability-creation.component';

describe('CapabilityCreationComponent', () => {
  let component: CapabilityCreationComponent;
  let fixture: ComponentFixture<CapabilityCreationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CapabilityCreationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CapabilityCreationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
