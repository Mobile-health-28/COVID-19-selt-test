import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Iuser } from '../model/iuser';
import { apiEndPoint } from '../shared/app.config';


@Injectable({
  providedIn: 'root'
})
export class AuthService {
  constructor(private http:HttpClient) { }

  login(username,password) {
    return this.http.post(apiEndPoint.login,{username,password})
  }
  register(user:Iuser){
    return this.http.post(apiEndPoint.register,user);
  }
  logOut(){
    return this.http.post(apiEndPoint.logout,'').subscribe((res:Response)=>{
      return res.json()
    });
  }
}
