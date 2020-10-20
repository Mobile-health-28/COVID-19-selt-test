import { HttpErrorResponse } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { routesName } from '../shared/app.config';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent implements OnInit {
  loginForm: any;
  constructor(private router: Router, private auth: AuthService) {
    this.loginForm = new FormGroup({
      email: new FormControl('firminapp@gmail.com', [
        Validators.email,
        Validators.required,
      ]),
      password: new FormControl('passepasse', [Validators.required]),
    });
  }

  ngOnInit(): void {}

  signUp() {
    this.router.navigate([routesName.signup.s]);
  }

  submit() {
    let values = this.loginForm.value;
    console.error(this.loginForm.valid, values);
    if (this.loginForm.valid) {
      this.auth.login(values.email, values.password).subscribe(
        (res) => {

          console.error(res);
        },
        (error: HttpErrorResponse) => {
          //to show error
          console.error(error);
        }
      );
    }
  }
}
