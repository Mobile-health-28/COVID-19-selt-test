import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { IAuth } from 'src/app/core/models/auth';
import { AuthService } from '../../core/services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent implements OnInit {
  form: FormGroup;
  payload: IAuth;
  loginError: {status: boolean, message: string} = {status: false, message: ''};

  constructor(
    private router: Router,
    private fb: FormBuilder,
    private auth: AuthService
    ) { }

    ngOnInit(): void {
      this.initForm(); // initialize reactive form on component init
    }

    // build form controls
    initForm(): void {
      this.form = this.fb.group({
        password: [null, Validators.required],
        username: [null, Validators.compose([Validators.required, Validators.email])]
      });
    }

    get formData() {
      return this.form.controls;
    }

    onSubmit(formPayload) {
      if (this.loginError.status === true){
        this.loginError = {
                            status: false,
                            message: ''
                          };
      }
      this.payload = {
                        email: formPayload.username.value,
                        password: formPayload.password.value,
                        persistent: true
                      };
      console.log('payload: ', this.payload);
      this.login(this.payload);
    }

    login(payload: IAuth) {
      this.auth.login(payload).subscribe(
        data => {
          if (data.user) {
            localStorage.setItem('user', JSON.stringify(data.user));
          }
        },
        error => {
          if (error.status === 422) {
            this.loginError = {
                                status: true,
                                message: error.error.message
                              };
          } else {
            this.loginError = {
                                status: true,
                                message: error.error.message
                              };
          }
        }
      );
    }

    // getUserInfo(){}
}
