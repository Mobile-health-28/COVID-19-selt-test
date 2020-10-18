import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { LoginComponent,SignupComponent ,StartedComponent} from './shared/pages';
import { routesName } from './shared/routes';
 const routes: Routes = [

  { path: routesName.login, component: LoginComponent }, 
  { path: routesName.signup, component: SignupComponent }, 
  { path: routesName.started, component: StartedComponent },
  { path: '', redirectTo: routesName.started,  pathMatch: 'full'}
]; 

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
