import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent, SignupComponent, StartedComponent,MenuComponent } from './shared/pages'
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import {IvyCarouselModule} from 'angular-responsive-carousel';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    SignupComponent,
    StartedComponent,
    MenuComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FontAwesomeModule,
    IvyCarouselModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
