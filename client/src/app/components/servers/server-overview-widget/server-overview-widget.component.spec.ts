import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ServerOverviewWidgetComponent } from './server-overview-widget.component';

describe('ServerOverviewWidgetComponent', () => {
  let component: ServerOverviewWidgetComponent;
  let fixture: ComponentFixture<ServerOverviewWidgetComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ServerOverviewWidgetComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ServerOverviewWidgetComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
