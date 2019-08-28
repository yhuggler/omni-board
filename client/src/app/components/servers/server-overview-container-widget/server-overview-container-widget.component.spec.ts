import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ServerOverviewContainerWidgetComponent } from './server-overview-container-widget.component';

describe('ServerOverviewContainerWidgetComponent', () => {
  let component: ServerOverviewContainerWidgetComponent;
  let fixture: ComponentFixture<ServerOverviewContainerWidgetComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ServerOverviewContainerWidgetComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ServerOverviewContainerWidgetComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
