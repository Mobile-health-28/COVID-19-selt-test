import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { LoginComponent,SignupComponent ,StartedComponent} from './shared/pages';
import { routesName } from './shared/app.config';
 const routes: Routes = [

  { path: routesName.login.p, component: LoginComponent }, 
  { path: routesName.signup.p, component: SignupComponent }, 
  { path: routesName.started.p, component: StartedComponent },
  { path: '', redirectTo: routesName.started.p,  pathMatch: 'full'}
]; 

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
