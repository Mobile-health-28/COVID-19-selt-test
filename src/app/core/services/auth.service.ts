

import { IUser } from '../models/user';
import { IAuth } from '../models/auth';
import { of as observableOf, Observable, throwError, of } from 'rxjs';
import { Router } from '@angular/router';
import { catchError, map} from 'rxjs/operators';
import { HttpClient, HttpHeaders, HttpErrorResponse, HttpRequest } from '@angular/common/http';
import { Injectable, Inject, PLATFORM_ID } from '@angular/core';
import { isPlatformBrowser } from '@angular/common';
import { environment } from '../../../environments/environment';


@Injectable({
  providedIn: 'root'
})

export class AuthService {
  private baseUrl = environment.apiBaseUrl;
  private loginUrl = environment.login;
  private registerUrl = environment.register;
  private logoutUrl = environment.logout;

  constructor(private http: HttpClient,
              private router: Router,
              @Inject(PLATFORM_ID) private platformId: any) { }

  private handleError(error: HttpErrorResponse) {
    if (error.error instanceof ErrorEvent) {
      return throwError (error.error);
    } else {
      return throwError (error);
    }
  }

  login(payload: IAuth): Observable<any> {
    const url = this.baseUrl + this.loginUrl;
    return this.http.post<IAuth>(url, payload).pipe(
      map(success => {
        return success;
      }),
      catchError(this.handleError)
    );
  }

  register(payload: IUser): Observable<any> {
    const url = this.baseUrl + this.registerUrl;
    return this.http.post<IUser>(url, payload).pipe(
      map(success => {
        return success;
      }),
      catchError(this.handleError)
    );
  }

  logout(): Observable<any> {
    const url = this.baseUrl + this.logoutUrl;
    return this.http.post<any>(url, {}).pipe(
      map(success => {
        return success;
      }),
      catchError(this.handleError)
    );
  }

  logou(): void {
    // Removing token after logout
    if (isPlatformBrowser(this.platformId)) {
      localStorage.removeItem('jwt');
      localStorage.removeItem('user');
      // redirect to login
      this.router.navigate(['/auth/login']);
    }
  }

  getTokenHeader(request: HttpRequest<any>): HttpHeaders {
    const token = localStorage.getItem('jwt') !== null ? localStorage.getItem('jwt') : '';
    return token === '' ? new HttpHeaders({
      'Content-Type': request.headers.get('Content-Type') || 'application/json'
    }) : new HttpHeaders({
      'Content-Type': request.headers.get('Content-Type') || 'application/json',
      Authorization: `Bearer ${token}`
    });
  }

  setTokenInLocalStorage(token: any): void {
    if (isPlatformBrowser(this.platformId)) {
      localStorage.setItem('jwt', token);
    }
  }
}

